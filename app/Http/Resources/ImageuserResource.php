<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageuserResource extends JsonResource
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
          'id'         => $this->id,
          'title'      => $this['title_' . request()->header('accept-language', 'en')],
          'description'=> $this['desc_' . request()->header('accept-language', 'en')],          
          'image'      => $this->getFirstMediaUrl(),
          'likes_count'=> $this->likes()->count(),
          'data_time'  => (string) $this->updated_at,
      ];
    }
}
