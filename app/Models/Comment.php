<?php

namespace App\Models;

use BeyondCode\Comments\Comment as BaseComment;

class Comment extends BaseComment
{
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
