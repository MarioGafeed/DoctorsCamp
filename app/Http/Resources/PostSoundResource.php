<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostSoundResource extends JsonResource
{
    public function toArray($request)
    {
      $user = $request->user();

      $postComments = $this->comments()->where('user_id', $this->user->id)->approved()->orderBy('created_at', 'desc')->get();
        if ($user !== null) {
          return [
              'id'           => $this->id,
              'title'        => $this['title_' . request()->header('accept-language', 'en')],
              'keyword'      => $this->keyword,
              'description'  => json_decode($this->desc, true)[request()->header('Accept-Language', 'ar')] ?? null,
              'user_name'    => $this->user->name,
              'category_id'  => $this->category->id,
              'category_name'=> $this->category['title_' . request()->header('accept-language', 'en')],
              'soundcloudURL'=> $this->soundcloudURL,
              'image'        => $this->getFirstMediaUrl(),
              'likes_count'  => $this->likes()->count(),
              'user_like?'   => $this->liked($user->id),
              'comments_count' => $this->comments()->count(),
              'comments'     => CommentResource::collection($postComments),
              'updated_at'   => (string) $this->updated_at,
          ];
        }else {
          return [
              'id'           => $this->id,
              'title'        => $this['title_' . request()->header('accept-language', 'en')],
              'keyword'      => $this->keyword,
              'description'  => json_decode($this->desc, true)[request()->header('Accept-Language', 'ar')] ?? null,
              'user_name'    => $this->user->name,
              'category_id'  => $this->category->id,
              'category_name'=> $this->category['title_' . request()->header('accept-language', 'en')],
              'soundcloudURL'=> $this->soundcloudURL,
              'image'        => $this->getFirstMediaUrl(),
              'likes_count'  => $this->likes()->count(),
              'comments_count' => $this->comments()->count(),
              'comments'     => CommentResource::collection($postComments),
              'updated_at'   => (string) $this->updated_at,
          ];
        }

    }
}
