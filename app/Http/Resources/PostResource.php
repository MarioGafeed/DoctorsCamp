<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray($request)
    {
      // $postComments = $this->comments()->with('user')->approved()->get();
        return [
            'id'           => $this->id,
            'title'        => $this['title_' . request()->header('accept-language', 'en')],
            'keyword'      => $this->keyword,
            'content'      => json_decode($this->content, true)[request()->header('Accept-Language', 'ar')] ?? null,
            'description'  => json_decode($this->desc, true)[request()->header('Accept-Language', 'ar')] ?? null,
            'user_name'    => $this->user->name,
            'category_id'  => $this->category->id,
            'category_name'=> $this->category['title_' . request()->header('accept-language', 'en')],
            'youtubeURL'   => $this->youtubeURL,
            'image'        => $this->getFirstMediaUrl(),
            'likes_count'  => $this->likes()->count(),
            'comments_count' => $this->comments()->count(),
            // 'comments'     => CommentResource::collection($postComments),
            'comments'     => $this->comments()->approved()->select('id', 'comment', 'user_id','updated_at')->get(),
            'updated_at'   => (string) $this->updated_at,
        ];
    }
}
