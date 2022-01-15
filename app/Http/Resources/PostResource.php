<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'keyword' => $this->keyword,
            'content' => json_decode($this->content, true),
            'desc' => json_decode($this->desc, true),
            'active' => $this->active,
            'user_id' => $this->user_id,
            'category_id' => $this->category_id,
            'youtubeURL' => $this->youtubeURL,
            'image' => $this->getFirstMediaUrl(),
        ];
    }
}
