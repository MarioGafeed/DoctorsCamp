<?php

namespace App\Http\Controllers\Api;

use App\Authorizable;
use App\Http\Controllers\Controller;
use App\Helpers\JsonResponder;
use App\Http\Interfaces\CategoryInterface;
use App\Http\Requests\CategoriesRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  use Authorizable;

  public function __construct(private CategoryInterface $categoryInterface)
  {
  }

  public function index(Request $request)
  {
      $categories = Category::query()->with('media')->with('posts');

        $categories->when(
                $request->keyword,
                fn ($q) => $q->where('title_ar', 'LIKE', "%$request->keyword%")
                              ->where('title_en', 'LIKE', "%$request->keyword%")
                              ->orWhere('slug','LIKE','%'.$request->keyword.'%')
       );

      return CategoryResource::collection($categories->get());
  }

  public function show(Category $category)
  {
      return new CategoryResource($category);
  }
}
