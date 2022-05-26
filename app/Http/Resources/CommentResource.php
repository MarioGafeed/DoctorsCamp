<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;

class CommentResource extends JsonResource
{
    public function toArray($request)
    {
        $user = User::findOrFail($this->user_id);

        return [
          'id'             => $this->id,
          'comment'        => $this->comment,
          'author'         => $user->name,
          'author_image'   => $user->getFirstMediaUrl(),
          'commentable_id' => $this->commentable_id,          
        ];
    }
}
