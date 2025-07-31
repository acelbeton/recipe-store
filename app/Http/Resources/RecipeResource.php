<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecipeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'desc' => $this->desc,
            'tags' => json_decode($this->tags ?? []),
            'url' => $this->url,
            'prep_time' => $this->prep_time,
            'cook_time' => $this->cook_time,
            'image_url' => json_decode($this->image_url ?? null),
            'ingredients' => json_decode($this->ingredients ?? []),
            'instructions' => $this->instructions,
            'servings' => $this->servings,
            'created_by' => $this->created_by
        ];
    }
}
