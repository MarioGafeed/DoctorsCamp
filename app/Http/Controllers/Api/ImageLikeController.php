<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageLikeController extends Controller
{
  public function action(Request $request, Image $image)
  {
    if ($image->liked()) {
      return $image->unlike();
    }else {
      return $image->like();
    }
  }  
}
