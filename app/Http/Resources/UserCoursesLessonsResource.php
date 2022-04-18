<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserCoursesLessonsResource extends JsonResource
{
    public function toArray($request)
    {
      $user = $request->user();
      $userCourseRow = $user->courses()->where('course_id', $this->id)->first();
      return [
        'id'                         => $this->id,
        'name'                       => $this->name,
         'bar'                       => $userCourseRow->pivot->score,
        'user_complete_lessons_count'=> $user->lessons()->where('course_id', $this->id)->count(),
        'course_lessons_count'       => $this->lessons()->count(),
        ];
    }
}
