<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Interfaces\CourseInterface;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use Response;


class CourseController extends Controller
{

  public function __construct(private CourseInterface $courseInterface)
  {
  }

  public function index(Request $request)
  {
        $courses = Course::when($request->keyword, function ($query) use ($request){
              $query->orWhere('name', 'LIKE', "%$request->keyword%")->get();
        })->whereNotNull('name')
      ->where('active', 1)
      ->with('category:id,title_en,title_ar')
      ->with('lessons:id,title')
      ->paginate(10);

      return CourseResource::collection($courses);
  }

  public function show(Course $course)
  {
      return new CourseResource($course);
  }
}
