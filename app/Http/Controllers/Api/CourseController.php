<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Interfaces\CourseInterface;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CourseResource;
use App\Http\Resources\UserCoursesResource;
use App\Http\Resources\CourseuserResource;
use App\Http\Resources\UserCoursesLessonsResource;
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

  public function indexcourseswithlikes(Request $request)
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
            'message' => trans('main.coursecomplete'),
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
            'message' => trans('main.courseuncomplete')
          ]);
        }
        else {
          return UserCoursesResource::collection($userCourses);
        }
      }
  }

  public function userallcourses(Request $request)
  {
    $user = $request->user();

    if ($user !== null) {
        $userCourses = $user->courses()->with('lessons:id')->get();

        if ( empty( $userCourses->toArray() ) ) {
          return response()->json([
            'message' => trans('main.courseallcomplete')
          ]);
        }
        else {
          return UserCoursesLessonsResource::collection($userCourses);
        }
      }
  }

  public function userCoursesEnroll(Request $request)
  {
    $user = $request->user();
    $allCoursesEnrolled = Course::with('lessons')
    ->with('category:id,title_en,title_ar')
    ->paginate(10);
    return CourseResource::collection($allCoursesEnrolled);
  }

  public function show(Course $course)
  {
      return new CourseResource($course);
  }

  public function showuser(Course $course, Request $request)
  {
    if (! $request->user()->courses->contains($course->id)) {
      $request->user()->courses()->attach($course->id);

      foreach ($course->lessons as $lesson) {
        if (! $request->user()->lessons->contains($lesson->id)) {
          $request->user()->lessons()->attach($lesson->id);
        }
      }
    }
      return new CourseResource($course);
  }

  public function enroll(Course $course, Request $request)
  {
    if (! $request->user()->courses->contains($course->id)) {
      $request->user()->courses()->attach($course->id);

      $request->user()->courses()->updateExistingPivot([
        'active' => 1,
      ]);

      foreach ($course->lessons as $lesson) {
        if (! $request->user()->lessons->contains($lesson->id)) {
          $request->user()->lessons()->attach($lesson->id);
        }
      }
      // $lessonFirst = $request->user()->lessons->where('course_id', $course->id)->first();
      // $lessonFirst->pivot->status => 'opened';

      return response()->json([
        'message' => trans('main.courseenroll')
      ]);
    }
    else {
      // $request->user()->courses()->updateExistingPivot($lessonId, [
      //   'status' => 'closed',
      // ]);
      return response()->json([
        'message' => trans('main.enrollbefore')
      ]);
    }
  }

  public function userfavoritecourses(Request $request)
  {
    $user = $request->user();

    $userfavoritecourses = Course::whereLikedBy($user->id)->get();

    return CourseuserResource::collection($userfavoritecourses);
  }

}
