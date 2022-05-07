<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseuserResource extends JsonResource
{
    public function toArray($request)
    {
      $user = $request->user();

      return [
        'id'            => $this->id,
        'name'          => $this->name,
        'lessons_count' => $this->lessons()->count(),
        'users_count'   => $this->users()->count(),
        'image'         => $this->getFirstMediaUrl(),
        'price'         => $this->price,
        'user_enroll?'  => (bool) $this->users()
                                          ->where('user_id', '=', $user->id)
                                          ->count(),
        'user_like?'    => $this->liked($user->id),
        'login_url'     => route('user.login'),
        ];
    }
}
