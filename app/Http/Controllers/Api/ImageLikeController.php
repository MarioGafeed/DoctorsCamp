<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageLikeController extends Controller
{
  public function store(Request $request, Image $image)
  {
    return $image->like();
  }

  public function destroy(Image $image)
  {
    if ($image->liked()) {
      return $image->unlike();
    }
  }
}
