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
        'lesson'       => $this->lesson->title,
        'op1'          => $this->op1,
        'op2'          => $this->op2,
        'op3'          => $this->op3,
        'op4'          => $this->op4,
      ];
    }
}
