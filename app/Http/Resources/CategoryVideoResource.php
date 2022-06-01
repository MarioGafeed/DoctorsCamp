<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryVideoResource extends JsonResource
{
    public function toArray($request)
    {
      $videoPostsCounter = $this->posts->where('type', 'video')->where('active', 1)->count();
      if ($videoPostsCounter == 0) {
        return 0 ;
      }else {
        return [
          'id'               => $this->id,
          'title'            => $this['title_' . request()->header('accept-language', 'en')],
          'keyword'          => $this->keyword,
          'summary'          => json_decode($this->summary, true)[request()->header('Accept-Language', 'ar')] ?? null,
          'description'      => json_decode($this->desc, true)[request()->header('Accept-Language', 'ar')] ?? null,
          'videos_count'      => $this->posts->where('type', 'video')->where('active', 1)->count(),
          'videos'           => PostvideoResource::collection($this->posts->where('type', 'video')->where('active', 1)),
          'image'            => $this->getFirstMediaUrl(),
          'icon'             => $this->icon,
        ];
      }
    }
}
