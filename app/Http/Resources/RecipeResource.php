<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RecipeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => new UserResource($this->user),
            'category' => new CategoryResource($this->category),
            'name' => $this->name,
            'description' => $this->description,
            'guide' => $this->guide,
            'photo' => $this->photo,
            'tags' => TagResource::collection($this->recipeTags),
            'reviews' => ReviewResource::collection($this->reviews),
        ];
    }
}
