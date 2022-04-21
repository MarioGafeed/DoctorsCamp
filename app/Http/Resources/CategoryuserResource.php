<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryuserResource extends JsonResource
{
    public function toArray($request)
    {
      return [
        'id'               => $this->id,
        'title'            => $this['title_' . request()->header('accept-language', 'en')],
        'posts_count'      => $this->posts()->count(),
        'courses_count'    => $this->courses_count ?? $this->courses()->count(),
        'images_count'     => $this->images_count ?? $this->images()->count(),
        'image'            => $this->getFirstMediaUrl(),        
      ];
    }
}
