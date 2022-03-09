<?php

namespace App\Http\Controllers\Api;

use App\Authorizable;
use App\Helpers\JsonResponder;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\LessonInterface;
use App\Http\Requests\LessonsRequest;
use App\Http\Resources\LessonResource;
use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Response;

class LessonController extends Controller
{
  use Authorizable;

  public function __construct(private LessonInterface $lessonInterface)
  {
  }

  public function index()
  {
      $lessons = Lesson::with('course:id,name', 'questions')->paginate(10);

      return LessonResource::collection($lessons);
  }

  public function show(Lesson $lesson, Request $request)
  {
    $lessonId = Lesson::select('id')->where('myorder', ($lesson->myorder)-1)->where('course_id', $lesson->course_id)->first();

    if (! $request->user()->lessons->contains($lessonId) && ! is_null($lessonId) ) {
      return response()->json([
        'message' => "Plz you should finish the prev lesson"
      ]);
    }else {
      return new LessonResource($lesson);
    }
  }

  public function showQuestion($id)
  {
      $lesson = Lesson::with('questions')->findOrFail($id);

      return new LessonResource($lesson);
  }

  public function startQuiz($lessonId, Request $request)
  {
      if (! $request->user()->lessons->contains($lessonId)) {
        $request->user()->lessons()->attach($lessonId);
      }
      else {
        $request->user()->lessons()->updateExistingPivot($lessonId, [
          'status' => 'closed',
        ]);
      }

      return response()->json([
        'message' => "You start Quiz"
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
      'answers.*' => 'required|in:1,2,3,4',
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
       'status'           => 'closed',
     ]);
     if($score == 100)
     {
       if (! $request->user()->courses->contains($lesson->course_id)) {
         $request->user()->courses()->attach($lesson->course_id);
       }
       $user->lessons()->updateExistingPivot($lesson->id, [
         'status'              => 'closed',
       ]);

     $course = Course::select('id','name')->withCount('lessons')->findOrFail($lesson->course->id);

     $userCourseProgress = round(( ($request->user()->lessons()->where('course_id', $course->id)->where('score', 100)->count() ) / ($course->lessons()->count()) ) * 100 ,2);

     $lessonCourseName = $lesson->course->name;

     // Update Course_user Pivot row
     $user->courses()->updateExistingPivot($lesson->course_id, [
       'score'            => $userCourseProgress,
       'active'           => '1',
      ]);

     return response()->json([
       'message' => "You submitted Quiz successfully your score is: $score%, Congratulation your progress in course: $lessonCourseName is: $userCourseProgress"
     ]);
   }else {
     return response()->json([
       'message' => "You submitted Quiz successfully your score is: $score%"
     ]);
   }
  }
}
