<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
          'id'          => $this->id,
          'name'        => $this->name,
          'desc'        => json_decode($this->desc, true),
          'active'      => $this->active,
          'category_ar' => $this->category->title_ar,
          'category_en' => $this->category->title_en,
          'lessons'     => $this->lessons->where('active', 1),
          'lessons_counts'     => $this->lessons->count(),
          'image'       => $this->getFirstMediaUrl(),
          'price'       => $this->price,
          'updated_at'  => $this->updated_at,
          ];
    }
}
