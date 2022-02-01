<?php

namespace App\Http\Controllers\Api;

use App\Authorizable;
use App\Http\Controllers\Controller;
use App\Helpers\JsonResponder;
use App\Http\Interfaces\CategoryInterface;
use App\Http\Requests\CategorysRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Response;

class CategoryController extends Controller
{
  use Authorizable;

  public function __construct(private CategoryInterface $categoryInterface)
  {
  }

  public function index()
  {
      $categories = Category::with('media')->paginate(10);

      return CategoryResource::collection($categories);
  }

  public function show(Category $category)
  {
      return new CategoryResource($category);
  }

  public function searchCategory(Request $request)
  {
        $categories = Category::where('title_ar','LIKE','%'.$request->keyword.'%')
                      ->orWhere('title_en','LIKE','%'.$request->keyword.'%')
                      ->orWhere('slug','LIKE','%'.$request->keyword.'%')
                      ->get();

        if(count($categories)==0)
        {
            return Response::json(['message'=>'No category match found !']);
        }else{
            return Response::json($categories);
        }
    }
}
