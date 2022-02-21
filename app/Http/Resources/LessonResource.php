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
          'course'       => new CourseResource($this->course),
          'questions'    => QuestionResource::collection($this->whenLoaded('questions')),
          'vcontent'     => $this->vcontent,
          'created_at'   => (string) $this->created_at,
          'updated_at'   => (string) $this->updated_at,
      ];
    }
}
