<?php

namespace App\Http\Controllers\Api;

use App\Authorizable;
use App\Helpers\JsonResponder;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\ImageInterface;
use App\Http\Requests\ImagesRequest;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
  use Authorizable;

  public function __construct(private ImageInterface $imageInterface)
  {
  }

  public function index()
  {
      $images = Image::with('media')->paginate(10);

      return ImageResource::collection($images);
  }

  public function show(Image $image)
  {
      return new ImageResource($image);
  }

  public function destroy(Image $image)
  {
      $image->delete();

      return JsonResponder::make('Image deleted');
  }
}