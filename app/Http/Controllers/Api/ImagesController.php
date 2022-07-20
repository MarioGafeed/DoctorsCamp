<?php

namespace App\Http\Controllers\Api;

use App\Helpers\JsonResponder;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\ImageInterface;
use App\Http\Requests\ImagesRequest;
use App\Http\Resources\ImageResource;
use App\Http\Resources\ImageuserResource;
use App\Models\Image;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
  public function __construct(private ImageInterface $imageInterface)
  {
  }

  public function index(Request $request)
  {
    $images = Image::when($request->keyword, function ($query) use ($request){
          $query->orWhere('title_ar', 'LIKE', "%$request->keyword%")
          ->orWhere('title_en', 'LIKE', "%$request->keyword%")
          ->orWhere('desc', 'LIKE', "%$request->keyword%")
          ->get();
    })->whereNotNull('title_ar')
      ->with('user:id,name')
      ->paginate(10);

      return ImageResource::collection($images);
  }

  public function show(Image $image)
  {
      return new ImageResource($image);
  }

  public function destroy(Image $image)
  {
      $image->delete();

      return JsonResponder::make(trans('main.imgdelete'));
  }

  public function userfavoriteimages(Request $request)
  {
    $user = $request->user();

    $userfavoriteimages = Image::whereLikedBy($user->id)->get();

    return ImageuserResource::collection($userfavoriteimages);
  }
}
