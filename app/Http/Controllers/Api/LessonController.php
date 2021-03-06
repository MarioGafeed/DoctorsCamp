<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\LessonInterface;
use App\Http\Requests\LessonsRequest;
use App\Http\Resources\LessonResource;
use App\Http\Resources\UserLessonResource;
use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Response;

class LessonController extends Controller
{
  public function __construct(private LessonInterface $lessonInterface)
  {
  }

  public function index(Request $request)
  {
      $user = $request->user();

      if ($user !== null ) {
          $userLessons = $user->lessons()->with('course:id,name')->get();

          if ( empty( $userLessons->toArray() ) ) {
            return response()->json([
              'message' => trans('main.nolesson'),
            ]);
          }
          else {
            return UserLessonResource::collection($userLessons);
          }
        }
  }

  public function show(Lesson $lesson, Request $request)
  {
    $lessonId = Lesson::select('id')->where('myorder', ($lesson->myorder)-1)->where('course_id', $lesson->course_id)->first();

    if (! $request->user()->lessons->contains($lessonId) && ! is_null($lessonId) ) {
      return response()->json([
        'message' => trans('prevlesson'),
      ]);
    }else {
      return new LessonResource($lesson);
    }
  }


  public function startQuiz($lessonId, Request $request)
  {
      if (! $request->user()->lessons->contains($lessonId)) {
        $request->user()->lessons()->attach($lessonId);
      }
      else {
        $request->user()->lessons()->updateExistingPivot($lessonId, [
          'status' => 'opened',
        ]);
      }

      return response()->json([
        'message' => trans('main.qstart'),

      ]);
  }

  public function submitQuiz(Lesson $lesson, Request $request)
  {
    // $courses = Course::select('id', 'name')->withCount('lessons')->get();
    // foreach ($courses as $course) {
    //   $userProgress = ( ($request->user()->lessons()->where('course_id', $course->id)->where('score', 100)->count() ) / ($course->lessons()->count()) ) * 100;
    //
    //   dd(round($userProgress,2));
    // }

    $validator = Validator::make($request->all(), [
      'answers'   => 'required|array',
      'answers.*' => 'required|in:0,1,2,3',
    ]);

     if ($validator->fails()) {
       return response()->json($validator->errors());
     }
     // Calculate Score..
     $points = 0;
     // $lesson = Lesson::findOrFail($lesson);
     $totalQcount = $lesson->questions->count();

     foreach ($lesson->questions as $question) {
       if(isset( $request->answers[$question->id] ) ){

         $userAns  = $request->answers[$question->id];
         $rightAns = $question->right_ans;
         if ($userAns == $rightAns) {
           $points += 1;
         }
       }
     }
     $score = ($points/$totalQcount) * 100;

     // Calculate Time
     $user = $request->user();
     $pivotRow = $user->lessons()->where('lesson_id', $lesson->id)->first();
     if ($pivotRow->pivot->updated_at) {
       $starttime =  $pivotRow->pivot->updated_at;
     }
     else {
       $starttime =  $pivotRow->pivot->created_at;
     }
     $submitTime = Carbon::now();

     $time_mins = $submitTime->diffInMinutes($starttime);

     if ($time_mins > $pivotRow->duration_mins) {
       $score = 0;
     }
     // Update lesson_user Pivot row
     $user->lessons()->updateExistingPivot($lesson->id, [
       'score'            => $score,
       'quizz_time'       => $time_mins,
       'status'           => 'opened',
     ]);
     if($score == 100)
     {
       $currentLesson      = $lesson->myorder;
       $nextLessonorder    = $currentLesson+1;


       if (! $request->user()->courses->contains($lesson->course_id)) {
         $request->user()->courses()->attach($lesson->course_id);
       }

       $lessonNextId = Lesson::where('myorder', $nextLessonorder)->first();

       if (! is_null($lessonNextId) ) {
         $user->lessons()->updateExistingPivot($lessonNextId->id, [
           'status'              => 'opened',
         ]);
       }

     $course = Course::select('id','name')->withCount('lessons')->findOrFail($lesson->course->id);

     $userCourseProgress = round(( ($request->user()->lessons()->where('course_id', $course->id)->where('score', 100)->count() ) / ($course->lessons()->count()) ) * 100 ,2);

     $lessonCourseName = $lesson->course->name;

     // Update Course_user Pivot row
     $user->courses()->updateExistingPivot($lesson->course_id, [
       'score'            => $userCourseProgress,
       'active'           => '1',
      ]);

     return response()->json([
       'message' => trans('main.quizscore'). $score ."%, " . trans('main.courseprogress'). $lessonCourseName . " is: ". $userCourseProgress,
     ]);
   }else {
     return response()->json([
       'message' => trans('main.quizscore'). $score ."%"
     ]);
   }
  }

  public function courseUserLessons($courseId, Request $request)
  {
    $user = $request->user();

    if ($user !== null) {
        $userLessons = $user->lessons()->where('course_id', $courseId)->with('questions:id,title')->get();
        if ( empty( $userLessons->toArray() ) ) {
          return response()->json([
            'message' => trans('main.lessonNo'),
          ]);
        }
        else {
          return UserCoursesResource::collection($userLessons);
        }
        }
  }

}
