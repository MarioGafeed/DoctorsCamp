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
        'description'  => $this->desc,
        'lesson_id'    => $this->lesson_id,
        'lesson'       => $this->lesson->title,              
      ];
    }
}
