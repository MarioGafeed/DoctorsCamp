<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{

    public function toArray($request)
    {
        return [
          'id'             => $this->id,
          'comment'        => $this->comment,
          'comment_user'   => $this->user->name,
          'user_url'       => route('users.show', $this->user),
        ];
    }
}
