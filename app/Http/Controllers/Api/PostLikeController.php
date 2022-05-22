<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
  public function action(Request $request, Post $post)
  {
    if ($post->liked()) {
      return $post->unlike();
    }else {
      return $post->like();
    }
  }
}
