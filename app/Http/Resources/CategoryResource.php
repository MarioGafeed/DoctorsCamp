<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
          'id'               => $this->id,
          'title'            => $this['title_' . request()->header('accept-language', 'en')],
          'keyword'          => $this->keyword,
          'summary'          => json_decode($this->summary, true)[request()->header('Accept-Language', 'ar')] ?? null,
          'description'      => json_decode($this->desc, true)[request()->header('Accept-Language', 'ar')] ?? null,
          'posts_count'      => $this->posts()->count(),
          'courses_count'    => $this->courses_count ?? $this->courses()->count(),
          'images_count'     => $this->images_count ?? $this->images()->count(),
          'videos'           => $this->posts->where('type', 'video')->where('active', 1),
          'articles'         => $this->posts->where('type', 'article')->where('active', 1),          
          'courses'          => $this->courses->where('active', 1),
          'images'           => $this->images,
          'image'            => $this->getFirstMediaUrl(),
          'icon'             => $this->icon,
        ];
    }
}
