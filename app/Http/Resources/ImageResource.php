<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
{
    public function toArray($request)
    {
      return [
          'id'         => $this->id,
          'title'      => $this['title_' . request()->header('accept-language', 'en')],
          'user_id'    => $this->user_id,
          'category_id'=> $this->category_id,
          'category_name' => $this->category['title_' . request()->header('accept-language', 'en')],
          'image'      => $this->getFirstMediaUrl(),
          'likes_count'=> $this->likes()->count(),
          'data_time'  => (string) $this->updated_at,
      ];
    }
}
