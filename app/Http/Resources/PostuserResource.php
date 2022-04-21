<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostuserResource extends JsonResource
{
    public function toArray($request)
    {
      return [
          'id'           => $this->id,
          'title'        => $this['title_' . request()->header('accept-language', 'en')],
          'content'      => json_decode($this->content, true)[request()->header('Accept-Language', 'ar')] ?? null,
          'description'  => json_decode($this->desc, true)[request()->header('Accept-Language', 'ar')] ?? null,
          'user_name'    => $this->user->name,
          'youtubeURL'   => $this->youtubeURL,
          'image'        => $this->getFirstMediaUrl(),
          'likes_count'  => $this->likes()->count(),
          'comments_count' => $this->comments()->count(),
          'updated_at'   => (string) $this->updated_at,
      ];
    }
}
