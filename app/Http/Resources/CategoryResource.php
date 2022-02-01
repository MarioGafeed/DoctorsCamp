<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
          'summary' => $this->summary,
          'desc' => json_decode($this->desc, true),
          'posts_count' => $this->posts_count ?? $this->posts()->count(),
          'videos'         => $this->posts->where('type', '=', 'video'),
          'articles'       => $this->posts->where('type', '=', 'article'),          
          'image' => $this->getFirstMediaUrl(),
          'icon' =>  $this->icon,
        ];
    }
}
