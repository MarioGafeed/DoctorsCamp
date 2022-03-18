<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{  
    public function toArray($request)
    {
        return [
          'id'         => $this->id,
          'title'      => $this['title_' . request()->header('accept-language', 'en')],
          'country'    => $this->country->name,
          'desc'       => json_decode($this->description, true)[request()->header('Accept-Language', 'ar')] ?? null,
          'date'       => $this->start_date,
          'likes_count'=> $this->likes()->count(),
          'image'      => $this->getFirstMediaUrl(),
        ];
    }
}
