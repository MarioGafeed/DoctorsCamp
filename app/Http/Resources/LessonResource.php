<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
{
    public function toArray($request)
    {
      return [
          'id'           => $this->id,
          'title'        => $this->title,
          'content'      => $this->content,
          'active'       => $this->active,
          'course_id'    => $this->course_id,
          'course'       => $this->course->name,
          'question'     => $this->questions()->select('id','title','desc','op1','op2','op3','op4')->get(),
          'lesson_video' => $this->vcontent,
          'updated_at'   => (string) $this->updated_at,
      ];
    }
}
