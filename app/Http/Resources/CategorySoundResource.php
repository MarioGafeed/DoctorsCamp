<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategorySoundResource extends JsonResource
{
    public function toArray($request)
    {
      $soundPostsCounter = $this->posts->where('type', 'sound')->where('active', 1)->count();
      
      if ($soundPostsCounter == 0) {
        return 0 ;
      }else {
        return [
          'id'               => $this->id,
          'title'            => $this['title_' . request()->header('accept-language', 'en')],
          'keyword'          => $this->keyword,
          'summary'          => json_decode($this->summary, true)[request()->header('Accept-Language', 'ar')] ?? null,
          'description'      => json_decode($this->desc, true)[request()->header('Accept-Language', 'ar')] ?? null,
          'sounds_count'     => $this->posts->where('type', 'sound')->where('active', 1)->count(),
          'sounds'           => PostSoundResource::collection($this->posts->where('type', 'sound')->where('active', 1)),
          'image'            => $this->getFirstMediaUrl(),
          'icon'             => $this->icon,
        ];
      }
    }
}
