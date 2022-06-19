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
use App\Http\Resources\CourseResource;
use App\Http\Resources\PostvideoResource;
use App\Http\Resources\PostSoundResource;
use App\Http\Resources\ImageResource;
use App\Models\Category;
use App\Models\Course;
use App\Models\Post;
use App\Models\Image;
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
     ->paginate();

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

  public function showVideo(Category $category, Request $request)
  {
    $videos = Post::when($request->keyword, function ($query) use ($request){
          $query->orWhere('title_ar', 'LIKE', "%$request->keyword%")
          ->orWhere('title_en', 'LIKE', "%$request->keyword%")
          ->get();
    })->whereNotNull('title_ar')
  ->where('category_id', $category->id)
  ->where('type', 'video')
  ->with('comments')
  ->paginate(10);

    return PostvideoResource::collection($videos);
  }

  public function showCourse(Category $category, Request $request)
  {
      $courses = Course::when($request->keyword, function ($query) use ($request){
            $query->orWhere('name', 'LIKE', "%$request->keyword%")
            ->get();
      })->where('category_id', $category->id)
    ->with('lessons')
    ->paginate(10);

      return CourseResource::collection($courses);
  }

  public function showSound(Category $category, Request $request)
  {
    $sounds = Post::when($request->keyword, function ($query) use ($request){
          $query->orWhere('title_ar', 'LIKE', "%$request->keyword%")
          ->orWhere('title_en', 'LIKE', "%$request->keyword%")
          ->get();
    })->whereNotNull('title_ar')
  ->where('category_id', $category->id)
  ->where('type', 'sound')
  ->with('comments')
  ->paginate(10);

    return PostSoundResource::collection($sounds);
  }

  public function showImage(Category $category, Request $request)
  {
      $images = Image::when($request->keyword, function ($query) use ($request){
            $query->orWhere('title_ar', 'LIKE', "%$request->keyword%")
            ->orWhere('title_en', 'LIKE', "%$request->keyword%")
            ->get();
      })->whereNotNull('title_ar')
    ->where('category_id', $category->id)
    ->paginate(10);

      return ImageResource::collection($images);
  }

  public function userfavoritecategories(Request $request)
  {
    $user = $request->user();

    $userfavoritecategories = Category::whereLikedBy($user->id)->get();

    return CategoryuserResource::collection($userfavoritecategories);
  }
}
