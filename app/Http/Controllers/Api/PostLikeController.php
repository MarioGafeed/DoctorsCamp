<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
  public function store(Request $request, Post $post)
  {
      return $post->like();
  }

  public function destroy(Post $post)
  {
      if ($post->liked();) {      
        return $post->unlike();
      }
  }
}
