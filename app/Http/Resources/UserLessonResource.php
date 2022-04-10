<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserLessonResource extends JsonResource
{
    public function toArray($request)
    {
      return [
          'id'           => $this->id,
          'title'        => $this->title,
          'course_id'    => $this->course_id,
          'course'       => $this->course->name,
          'description'  => $this->content,
          // 'lesson_id'    => $this->$user->lessons()->lesson_id,
          'status'       => $this->pivot->status,
          // 'question'     => $this->questions()->select('id','title')->get(),
          'video'        => $this->vcontent,
      ];
    }
}
