<?php

namespace McGo\Recipe\Actions;

use McGo\Recipe\Exceptions\NoIngredientFoundException;
use McGo\Recipe\Models\Ingredient;
use McGo\Recipe\Models\IngredientAlternative;
use McGo\Recipe\Models\Unit;
use McGo\Recipe\Schema\RecipeIngredient;


/**
 * Converts a given text to ingredients with unit, amount, ingredient and additional information.
 * @deprecated
 */
class ConvertIngredientText
{
    private $original;
    private $ingredientpart;

    public $amount = null;
    public $amount_length = 0;
    public $unit = null;
    public $unit_pos = null;
    public $unit_model = null;
    public $ingredient = null;
    public $ingredient_pos = null;
    public $ingredient_model = null;
    public $additions = [];
    public $addition = null;


    /**
     * @throws NoIngredientFoundException
     */
    public function execute($text)
    {
        $this->original = $text;
        $this->ingredientpart = $text;

        // Search for the ingredient
        $this->populateUnits();
        $this->populateAmount();
        $this->populateIngredient();

        $recipeIngredient = new RecipeIngredient();
        $recipeIngredient->amount = $this->amount;
        $recipeIngredient->addition = $this->addition;
        $recipeIngredient->setUnit($this->unit, $this->unit_model);
        $recipeIngredient->setIngredient($this->ingredient, $this->ingredient_model);

        return $recipeIngredient;
    }

    private function populateUnits()
    {
        $units = Unit::all();
        foreach ($units as $candidate) {
            $pos = strpos($this->original, ' '.$candidate->name.' ');
            if ($pos) {
                $this->unit = $candidate->name;
                $this->unit_model = $candidate;
                $this->unit_pos = $pos;
                return;
            }
        }
        $units_to_ignore = ['m.-große', '.-große', 'kleine', 'große', 'mittelgroße', 'Stk', 'Stück', 'Stk.', 'Spr', 'Spritzer', 'Spr.'];
        foreach ($units_to_ignore as $candidate) {
            $pos = strpos($this->original, ' '.$candidate.' ');
            if ($pos) {
                $this->unit = null;
                $this->unit_model = null;
                $this->unit_pos = $pos;
                return;
            }
        }
    }

    private function populateAmount()
    {
        if (is_null($this->unit_pos)) {
            // There is no unit. maybe there is an amount without a unit.
            $amount_candidate = substr($this->original, 0, strpos($this->original, ' '));
        } else {
            $amount_candidate = substr($this->original, 0, $this->unit_pos);
        }

        if (is_numeric($amount_candidate)) {
            $this->amount = $amount_candidate;
            $this->amount_length = strlen($amount_candidate);
        } else {
            if ($amount_candidate == '½') {
                $this->amount = 0.5;
                $this->amount_length = 2;
            }

            if (in_array($amount_candidate, ['etwas', 'n.B.', 'Schuss', 'wenig'])) {
                // Only set the length to ignore the unsuable amount candidates
                $this->amount_length = strlen($amount_candidate);
                $this->additions[] = $amount_candidate;
            }
        }
    }

    private function populateIngredient()
    {
        if (is_null($this->unit_pos)) {
            // If there is no unit but an amount, we reduce the string by that.
            $this->ingredient_pos = is_null($this->amount_length) ? 0 : $this->amount_length;
        } else {
            $this->ingredient_pos = $this->unit_pos + strlen($this->unit) + 2;
        }
        $ingredientpart_total = trim(substr($this->original, $this->ingredient_pos));
        $ingredientpart_only = $ingredientpart_total;

        // Are there any additions?
        $first_bracket = strpos($ingredientpart_total, '(');
        if ($first_bracket) {
            $candidate = trim(substr($ingredientpart_total, $first_bracket + 1,
                strpos($ingredientpart_total, ')', $first_bracket) - $first_bracket - 1));
            if (strlen($candidate) > 2) {
                $this->additions[] = $candidate;
            }
            $ingredientpart_only = trim(substr($ingredientpart_total, 0, $first_bracket));
        }
        $first_komma = strpos($ingredientpart_only, ',');
        if ($first_komma) {
            $this->additions[] = trim(substr($ingredientpart_only, $first_komma + 1));
            $ingredientpart_only = trim(substr($ingredientpart_only, 0, $first_komma));
        }

        // $ingredientpart_only now has a sanitized string of ingredients. Are there any other filling words?
        $this->ingredient = $this->sanitizeIngredientStopwords($ingredientpart_only);
        $this->addition = implode(',', $this->additions);

        // Get the model
        $this->ingredient_model = Ingredient::where('name', '=', $this->ingredient)->first();
        if (is_null($this->ingredient_model)) {
            $alternative = IngredientAlternative::with('ingredient')->where('name', '=', $this->ingredient)->first();
            if (!is_null($alternative)) {
                $this->ingredient_model = $alternative->ingredient;
            }
        }
    }

    private function sanitizeIngredientStopwords($text)
    {
        $stopwords = ['oder', '/', 'à'];
        foreach ($stopwords as $stopword) {
            $pos = strpos($text, ' '.$stopword. '');
            if ($pos) {
                $this->additions[] = trim(substr($text, $pos));
                return substr($text, 0, $pos);
            }
        }
        return $text;
    }
}