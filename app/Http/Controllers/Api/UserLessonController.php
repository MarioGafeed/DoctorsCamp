<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserLessonsResource;

class UserLessonController extends Controller
{
    public function userquizzes(Request $request)
    {
      $user = $request->user();

      if ($user !== null) {
          $userLessons = $user->lessons()->with('course:id,name')->get();

          if ( empty( $userLessons->toArray() ) ) {
            return response()->json([
              'message' => trans('main.lessonall')
            ]);
          }

          else {
            return UserLessonsResource::collection($userLessons);
          }
        }



    }
}
