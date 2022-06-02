<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\CategoryInterface;
use App\Http\Requests\CategoriesRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryCoursesResource;
use App\Http\Resources\CategoryImageResource;
use App\Http\Resources\CategoryVideoResource;
use App\Http\Resources\CategorySoundResource;
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
     ->paginate(10);

      return CategoryResource::collection($categories);
  }

  public function indexVideos(Request $request)
  {
       $categories = Category::when($request->keyword, function ($query) use ($request){
             $query->orWhere('title_ar', 'LIKE', "%$request->keyword%")
             ->orWhere('title_en', 'LIKE', "%$request->keyword%")
             ->get();
       })->whereNotNull('title_ar')
     ->with('posts')
     ->paginate(10);

      return CategoryVideoResource::collection($categories);
  }

  public function indexSounds(Request $request)
  {
       $categories = Category::when($request->keyword, function ($query) use ($request){
             $query->orWhere('title_ar', 'LIKE', "%$request->keyword%")
             ->orWhere('title_en', 'LIKE', "%$request->keyword%")
             ->get();
       })->whereNotNull('title_ar')
     ->with('posts')
     ->paginate(10);

      return CategorySoundResource::collection($categories);
  }

  public function indexCourses(Request $request)
  {
       $categories = Category::when($request->keyword, function ($query) use ($request){
             $query->orWhere('title_ar', 'LIKE', "%$request->keyword%")
             ->orWhere('title_en', 'LIKE', "%$request->keyword%")
             ->get();
       })->whereNotNull('title_ar')
     ->with('courses')
     ->paginate(10);

      return CategoryCoursesResource::collection($categories);
  }

  public function indexImages(Request $request)
  {
       $categories = Category::when($request->keyword, function ($query) use ($request){
             $query->orWhere('title_ar', 'LIKE', "%$request->keyword%")
             ->orWhere('title_en', 'LIKE', "%$request->keyword%")
             ->get();
       })->whereNotNull('title_ar')
     ->with('images')
     ->paginate(10);

      return CategoryImageResource::collection($categories);
  }

  public function show(Category $category)
  {
      return new CategoryResource($category);
  }

  public function showVideo(Category $category)
  {
      return new CategoryVideoResource($category);
  }

  public function showCourse(Category $category)
  {
      return new CategoryCoursesResource($category);
  }

  public function showSound(Category $category)
  {
      return new CategorySoundResource($category);
  }

  public function showImage(Category $category)
  {
      return new CategoryImageResource($category);
  }

  public function userfavoritecategories(Request $request)
  {
    $user = $request->user();

    $userfavoritecategories = Category::whereLikedBy($user->id)->get();

    return CategoryuserResource::collection($userfavoritecategories);
  }
}
