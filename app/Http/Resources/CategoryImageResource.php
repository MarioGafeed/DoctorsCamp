<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryImageResource extends JsonResource
{
    public function toArray($request)
    {
      if ($this->images()->count() == null ) {
        return null;
      }else {
        return [
          'id'               => $this->id,
          'title'            => $this['title_' . request()->header('accept-language', 'en')],
          'keyword'          => $this->keyword,
          'summary'          => json_decode($this->summary, true)[request()->header('Accept-Language', 'ar')] ?? null,
          'description'      => json_decode($this->desc, true)[request()->header('Accept-Language', 'ar')] ?? null,
          'images_count'     => $this->images_count ?? $this->images()->count(),
          'images'           => ImageResource::collection($this->images),
          'image'            => $this->getFirstMediaUrl(),
          'icon'             => $this->icon,
        ];
      }
    }
}
