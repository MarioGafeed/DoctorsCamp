<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray($request)
    {
      $user = $request->user();
      $mypost = 0 ;

      if ($request->user() != null) {
        if ($this->user_id == $request->user()->id) {
          $mypost = 1 ;
        }
      }


      $postComments = $this->comments()->approved()->orderBy('created_at', 'desc')->get();

      $tagNames = $this->tags()->pluck('name');

      if ($tagNames->toArray() != null) {
        foreach ($tagNames as $tagName) {
          $tag =  \Spatie\Tags\Tag::where('name->en', $tagName)->first();

            if ($tag != null) {
              $tagPosts = \App\Models\Post::withAnyTags([$tag])->get();
              if ($user !== null) {
                return [
                    'id'           => $this->id,
                    'title'        => $this['title_' . request()->header('accept-language', 'en')],
                    'keyword'      => $this->keyword,
                    'content'      => json_decode($this->content, true)[request()->header('Accept-Language', 'ar')] ?? null,
                    'description'  => json_decode($this->desc, true)[request()->header('Accept-Language', 'ar')] ?? null,
                    'user_name'    => $this->user->name,
                    'category_id'  => $this->category->id,
                    'category_name'=> $this->category['title_' . request()->header('accept-language', 'en')],
                    // 'youtubeURL'   => $this->youtubeURL,
                    'image'        => $this->getFirstMediaUrl(),
                    'likes_count'  => $this->likes()->count(),
                    'user_like?'   => $this->liked($user->id),
                    'comments_count' => $this->comments()->count(),
                    'comments'     => CommentResource::collection($postComments),
                    'tag_posts'    => TagpostsResource::collection($tagPosts),
                    'mypost'       => $mypost,
                    'updated_at'   => (string) $this->updated_at,
                ];
              }else{
                return [
                    'id'           => $this->id,
                    'title'        => $this['title_' . request()->header('accept-language', 'en')],
                    'keyword'      => $this->keyword,
                    'content'      => json_decode($this->content, true)[request()->header('Accept-Language', 'ar')] ?? null,
                    'description'  => json_decode($this->desc, true)[request()->header('Accept-Language', 'ar')] ?? null,
                    'user_name'    => $this->user->name,
                    'category_id'  => $this->category->id,
                    'category_name'=> $this->category['title_' . request()->header('accept-language', 'en')],
                    'image'        => $this->getFirstMediaUrl(),
                    'likes_count'  => $this->likes()->count(),
                    'comments_count' => $this->comments()->count(),
                    'comments'     => CommentResource::collection($postComments),
                    'tag_posts'    => TagpostsResource::collection($tagPosts),
                    'mypost'       => $mypost,
                    'updated_at'   => (string) $this->updated_at,
                ];
              }
            }else {
              if ($user !== null ) {
                return [
                    'id'           => $this->id,
                    'title'        => $this['title_' . request()->header('accept-language', 'en')],
                    'keyword'      => $this->keyword,
                    'content'      => json_decode($this->content, true)[request()->header('Accept-Language', 'ar')] ?? null,
                    'description'  => json_decode($this->desc, true)[request()->header('Accept-Language', 'ar')] ?? null,
                    'user_name'    => $this->user->name,
                    'category_id'  => $this->category->id,
                    'category_name'=> $this->category['title_' . request()->header('accept-language', 'en')],
                    // 'youtubeURL'   => $this->youtubeURL,
                    'image'        => $this->getFirstMediaUrl(),
                    'likes_count'  => $this->likes()->count(),
                    'user_like?'   => $this->liked($user->id),
                    'comments_count' => $this->comments()->count(),
                    'comments'     => CommentResource::collection($postComments),
                    'mypost'       => $mypost,
                    'updated_at'   => (string) $this->updated_at,
                ];
              }else {
                return [
                    'id'           => $this->id,
                    'title'        => $this['title_' . request()->header('accept-language', 'en')],
                    'keyword'      => $this->keyword,
                    'content'      => json_decode($this->content, true)[request()->header('Accept-Language', 'ar')] ?? null,
                    'description'  => json_decode($this->desc, true)[request()->header('Accept-Language', 'ar')] ?? null,
                    'user_name'    => $this->user->name,
                    'category_id'  => $this->category->id,
                    'category_name'=> $this->category['title_' . request()->header('accept-language', 'en')],
                    'image'        => $this->getFirstMediaUrl(),
                    'likes_count'  => $this->likes()->count(),
                    'comments_count' => $this->comments()->count(),
                    'comments'     => CommentResource::collection($postComments),
                    'mypost'       => $mypost,
                    'updated_at'   => (string) $this->updated_at,
                ];
              }
              return [
                  'id'           => $this->id,
                  'title'        => $this['title_' . request()->header('accept-language', 'en')],
                  'keyword'      => $this->keyword,
                  'content'      => json_decode($this->content, true)[request()->header('Accept-Language', 'ar')] ?? null,
                  'description'  => json_decode($this->desc, true)[request()->header('Accept-Language', 'ar')] ?? null,
                  'user_name'    => $this->user->name,
                  'category_id'  => $this->category->id,
                  'category_name'=> $this->category['title_' . request()->header('accept-language', 'en')],
                  // 'youtubeURL'   => $this->youtubeURL,
                  'image'        => $this->getFirstMediaUrl(),
                  'likes_count'  => $this->likes()->count(),
                  'user_like?'   => $this->liked($this->user->id),
                  'comments_count' => $this->comments()->count(),
                  'comments'     => CommentResource::collection($postComments),
                  'mypost'       => $mypost,
                  // 'comments'     => $this->comments()->approved()->select('id', 'comment', 'user_id','updated_at')->get(),
                  // 'comment_author' => $this->comments()->approved()->pivot->user->name,
                  'updated_at'   => (string) $this->updated_at,
              ];
            }
         }
       }else {
         return [
             'id'           => $this->id,
             'title'        => $this['title_' . request()->header('accept-language', 'en')],
             'keyword'      => $this->keyword,
             'content'      => json_decode($this->content, true)[request()->header('Accept-Language', 'ar')] ?? null,
             'description'  => json_decode($this->desc, true)[request()->header('Accept-Language', 'ar')] ?? null,
             'user_name'    => $this->user->name,
             'category_id'  => $this->category->id,
             'category_name'=> $this->category['title_' . request()->header('accept-language', 'en')],
             // 'youtubeURL'   => $this->youtubeURL,
             'image'        => $this->getFirstMediaUrl(),
             'likes_count'  => $this->likes()->count(),             
             'comments_count' => $this->comments()->count(),
             'comments'     => CommentResource::collection($postComments),
             'mypost'       => $mypost,
             // 'comments'     => $this->comments()->approved()->select('id', 'comment', 'user_id','updated_at')->get(),
             // 'comment_author' => $this->comments()->approved()->pivot->user->name,
             'updated_at'   => (string) $this->updated_at,
         ];
       }
    }
}
