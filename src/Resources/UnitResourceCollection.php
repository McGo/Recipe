<?php

namespace McGo\Recipe\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UnitResourceCollection extends ResourceCollection
{
    public function toArray($request): object
    {
        return UnitResource::collection($this->collection);
    }
}
