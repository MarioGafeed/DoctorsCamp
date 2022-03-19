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
          'desc'        => json_decode($this->desc, true)[request()->header('Accept-Language', 'ar')] ?? null,
          'active'      => $this->active,
          'category'    => $this->category->id,
          'category_name' => $this->category['title_' . request()->header('accept-language', 'en')],
          'lessons'     => $this->lessons()->get(),
          'lessons_counts'     => $this->lessons()->count(),
          'image'       => $this->getFirstMediaUrl(),
          'price'       => $this->price,
          'updated_at'  => $this->updated_at,
          ];
    }
}
