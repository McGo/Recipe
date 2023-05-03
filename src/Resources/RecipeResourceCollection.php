<?php

namespace McGo\Recipe\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RecipeResourceCollection extends ResourceCollection
{
    public function toArray($request): object
    {
        return RecipeResource::collection($this->collection);
    }
}
