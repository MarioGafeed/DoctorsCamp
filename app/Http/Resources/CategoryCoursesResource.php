<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryCoursesResource extends JsonResource
{
    public function toArray($request)
    {
       if ($this->courses()->count() == null ) {
         return null;
       }else {
         return [
           'id'               => $this->id,
           'title'            => $this['title_' . request()->header('accept-language', 'en')],
           'keyword'          => $this->keyword,
           'summary'          => json_decode($this->summary, true)[request()->header('Accept-Language', 'ar')] ?? null,
           'description'      => json_decode($this->desc, true)[request()->header('Accept-Language', 'ar')] ?? null,
           'courses_count'    => $this->courses_count ?? $this->courses()->count(),
           'courses'          => CourseResource::collection($this->courses->where('active', 1)),
           'image'            => $this->getFirstMediaUrl(),
           'icon'             => $this->icon,
         ];
     }

    }
}
