<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Lesson;

class UserCoursesLessonsResource extends JsonResource
{
    public function toArray($request)
    {
      $user = $request->user();
      $userCourseRow = $user->courses()->where('course_id', $this->id)->first();

      $currentLesson = $user->lessons()->where('course_id', $this->id)->orderByDesc('lesson_id')->first();

       $currentLessonOrder = Lesson::where('id', $currentLesson->id)->select('myorder')->first();

      $nextLesson = Lesson::where('myorder',  $currentLessonOrder->myorder+1)->select('id', 'myorder')->first();

      return [
        'id'                            => $this->id,
        'name'                          => $this->name,
         'bar'                          => $userCourseRow->pivot->score,
        'user_complete_lessons_count'   => $user->lessons()->where('course_id', $this->id)->count(),
        'course_lessons_count'          => $this->lessons()->count(),
        'next_lesson'                   => "{$nextLesson?->id}",
        // 'next_lesson'                   => "http://doctorscamp.dwam4j.net/api/lessons/{$nextLesson?->id}",
        'user_enroll?'                  => (bool) $this->users()
                                        ->where('user_id', '=', $user->id)
                                        ->count(),        
        ];
    }
}
