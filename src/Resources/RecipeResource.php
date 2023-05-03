<?php

namespace McGo\Recipe\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RecipeResource  extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'status' => $this->status,
            'name' => $this->name,
            'description' => $this->description,
            'ingredients' => $this->whenLoaded('ingredients')
        ];
    }
}
