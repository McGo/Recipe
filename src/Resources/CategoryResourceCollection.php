<?php

namespace McGo\Recipe\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryResourceCollection extends ResourceCollection
{
    public function toArray($request): object
    {
        return CategoryResource::collection($this->collection);
    }
}
