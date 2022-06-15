<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageuserResource extends JsonResource
{
    public function toArray($request)
    {
      $user = $request->user();
      return [
          'id'         => $this->id,
          'title'      => $this['title_' . request()->header('accept-language', 'en')],
          'description'=> $this['desc_' . request()->header('accept-language', 'en')],
          'image'      => $this->getFirstMediaUrl(),
          'likes_count'=> $this->likes()->count(),
          'user_like?' => $this->liked($user->id),
          'data_time'  => (string) $this->updated_at,
      ];
    }
}
