<?php

namespace McGo\Recipe\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * @var CategoryResource|mixed|object|null
     */
    public mixed $parent;

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'parent' => $this->whenLoaded('parent'),
            'parent_id' => $this->parent_id,
            'ingredients' => $this->whenLoaded('ingredients'),
        ];
    }
}
