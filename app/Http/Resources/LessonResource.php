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
          'description'  => $this->content,
          'course_id'    => $this->course_id,
          'course'       => $this->course->name,
          'question'     => $this->questions()->select('title')->get(),
          'video'        => $this->vcontent,
      ];
    }
}
