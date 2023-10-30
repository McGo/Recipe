<?php

namespace McGo\Recipe\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UnitResource  extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'in_g' => $this->in_g,
            '_type' => 'Unit',
        ];
    }
}
