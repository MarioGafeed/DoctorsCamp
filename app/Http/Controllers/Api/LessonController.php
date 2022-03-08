<?php

namespace App\Http\Controllers\Api;

use App\Authorizable;
use App\Helpers\JsonResponder;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\LessonInterface;
use App\Http\Requests\LessonsRequest;
use App\Http\Resources\LessonResource;
use App\Models\Lesson;
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
    // dd($request->user()->lessons->contains(($lesson->id)-1) );
// dd($request->user()->lessons[($lesson->myorder)-1]->pivot->status);
    if (! $request->user()->lessons->contains($lessonId) && ! is_null($lessonId) ) {
      return response()->json([
        'message' => "Plz you should finish the prev lesson"
      ]);
    }else {
      return new LessonResource($lesson);
    }

//  $prevLessonOrder = ($lesson->myorder)-1;
// $prevLesson  = Lesson::where('myorder', $prevLessonOrder)->where('course_id', $lesson->course_id)->first();
//  dd($prevLesson->pivot->status);
//     dd($lesson->myorder);
//     dd($request->user()->lessons[$lesson-1]->myorder);
//
//
//     if (!is_null($request->user()->last_lesson) && $lesson = Lesson::find($request->user()->last_lesson)) {
//        return new LessonResource($lesson);
//     }else {
//       return response()->json([
//         'message' => "Plz you should finish the prev lesson"
//       ]);
//     }
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

  public function submitQuiz($lessonId, Request $request)
  {
    $validator = Validator::make($request->all(), [
      'answers'   => 'required|array',
      'answers.*' => 'required|in:1,2,3,4',
    ]);
     if ($validator->fails()) {
       return response()->json($validator->errors());
     }
     // Calculate Score..
     $points = 0;
     $lesson = Lesson::findOrFail($lessonId);
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
     $pivotRow = $user->lessons()->where('lesson_id', $lessonId)->first();
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
     // Update Pivot row
     $user->lessons()->updateExistingPivot($lessonId, [
       'score'            => $score,
       'quizz_time'       => $time_mins,
       'status'           => 'closed',
     ]);
     if($score == 100)
     {
       $user->lessons()->updateExistingPivot($lessonId, [
         'status'              => 'opened',
       ]);
     }    
     return response()->json([
       'message' => "You submitted exam successfully your score is: $score%"
     ]);
  }
}
