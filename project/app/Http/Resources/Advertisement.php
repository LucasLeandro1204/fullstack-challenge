<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Advertisement extends JsonResource
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
            'title' => $this->title,
            'thumbnail' => $this->thumbnail,
            'description' => $this->description,
            'category' => $this->category->name,
            'placeholder' => $this->category->icon,
            'fields' => FieldValue::collection($this->whenLoaded('fields')),
            'created_at' => $this->created_at,
        ];
    }
}
