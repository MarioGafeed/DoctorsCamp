<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Interfaces\CourseInterface;
use App\Http\Resources\CourseResource;
use App\Http\Resources\UserCoursesResource;
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
      ->with('lessons')
      ->with('category:id,title_en,title_ar')
      ->paginate(10);

      return CourseResource::collection($courses);
  }

  public function usercompletecourses(Request $request)
  {
    $user = $request->user();

    if ($user !== null ) {
        $userCourses = $user->courses()->where('score', 100.0)->with('lessons:id')->get();

        if ( empty( $userCourses->toArray() ) ) {
          return response()->json([
            'message' => "No Courses Completed Found.."
          ]);
        }
        else {
          return UserCoursesResource::collection($userCourses);
        }
      }
  }

  public function useruncompletecourses(Request $request)
  {
    $user = $request->user();

    if ($user !== null) {
        $userCourses = $user->courses()->where('score', '!=', 100.0)->with('lessons:id')->get();

        if ( empty( $userCourses->toArray() ) ) {
          return response()->json([
            'message' => "No Courses UnCompleted Found.."
          ]);
        }
        else {
          return UserCoursesResource::collection($userCourses);
        }
      }
  }

  public function show(Course $course)
  {
      return new CourseResource($course);
  }

  public function enroll(Course $course, Request $request)
  {
    if (! $request->user()->courses->contains($course->id)) {
      $request->user()->courses()->attach($course->id);

      foreach ($course->lessons as $lesson) {
        if (! $request->user()->lessons->contains($lesson->id)) {
          $request->user()->lessons()->attach($lesson->id);
        }
      }

      return response()->json([
        'message' => "You enrolled course successfully"
      ]);
    }
    else {
      // $request->user()->courses()->updateExistingPivot($lessonId, [
      //   'status' => 'closed',
      // ]);
      return response()->json([
        'message' => "You enrolled this course before"
      ]);
    }
  }

}
