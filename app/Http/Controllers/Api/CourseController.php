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
      $courses = Course::where([
        ['name', '!=', NULL],
        [function ($query) use ($request){
              $query->orWhere('name', 'LIKE', "%$request->keyword%")->get();
        }]
      ])
      ->where('active', 1)
      ->with('category', 'lessons')
      ->paginate(10);

      if( count($courses)==0 ){
            return Response::json(['message'=>'No Course match found !']);
        }else{
            return CourseResource::collection($courses);
        }
  }

  public function show(Course $course)
  {
      return new CourseResource($course);
  }
}
