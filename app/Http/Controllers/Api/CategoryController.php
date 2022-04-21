<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\CategoryInterface;
use App\Http\Requests\CategoriesRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryuserResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  public function __construct(private CategoryInterface $categoryInterface)
  {
  }

  public function index(Request $request)
  {
       $categories = Category::when($request->keyword, function ($query) use ($request){
             $query->orWhere('title_ar', 'LIKE', "%$request->keyword%")
             ->orWhere('title_en', 'LIKE', "%$request->keyword%")
             ->get();
       })->whereNotNull('title_ar')
     ->with('posts')
     ->with('courses')
     ->with('images')
     ->paginate(10);

      return CategoryResource::collection($categories);
  }

  public function show(Category $category)
  {
      return new CategoryResource($category);
  }

  public function userfavoritecategories(Request $request)
  {
    $user = $request->user();

    $userfavoritecategories = Category::whereLikedBy($user->id)->get();

    return CategoryuserResource::collection($userfavoritecategories);
  }
}
