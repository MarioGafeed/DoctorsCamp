<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
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
          'id' => $this->id,
          'title_en' => $this->title_en,
          'title_ar' => $this->title_ar,
          'user_id' => $this->user_id,
          'category_id' => $this->category_id,
          'image' => $this->getFirstMediaUrl(),
          'data_time' => $this->updated_at,
      ];
    }
}
