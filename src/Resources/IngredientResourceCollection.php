<?php

namespace McGo\Recipe\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class IngredientResourceCollection extends ResourceCollection
{
    public function toArray($request): object
    {
        return IngredientResource::collection($this->collection);
    }
}
