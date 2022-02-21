<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class QuestionResource extends JsonResource
{

    public function toArray($request)
    {
      return [
        'id'           => $this->id,
        'title'        => $this->title,
        'desc'         => $this->desc,
        'lesson_id'    => $this->lesson_id,
        'lesson'       => new LessonResource($this->lesson),
        'answers'      => AnswersResource::collection($this->whenLoaded('answers')),
        'created_at'   => (string) $this->created_at,
        'updated_at'   => (string) $this->updated_at,
      ];
    }
}
