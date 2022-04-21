<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseuserResource extends JsonResource
{
    public function toArray($request)
    {
      return [
        'id'            => $this->id,
        'name'          => $this->name,        
        'lessons_count' => $this->lessons()->count(),
        'users_count'   => $this->users()->count(),
        'image'         => $this->getFirstMediaUrl(),
        'price'         => $this->price,
        'login_url'     => route('user.login'),
        ];
    }
}
