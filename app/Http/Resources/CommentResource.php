<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;

class CommentResource extends JsonResource
{
    public function toArray($request)
    {
        $user = User::findOrFail($this->user_id);

        $mycomment = 0 ;

        if ($request->user() != null) {
          if ($this->user_id == $request->user()->id) {
            $mycomment = 1 ;
          }
        }

        return [
          'id'             => $this->id,
          'comment'        => $this->comment,
          'author'         => $user->name,
          'author_image'   => $user->getFirstMediaUrl(),
          'mycomment'      => $mycomment,
          'commentable_id' => $this->commentable_id,
        ];
    }
}
