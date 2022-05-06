<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserCoursesResource extends JsonResource
{
    public function toArray($request)
    {
      $user = $request->user();
      $userCourseRow = $user->courses()->where('course_id', $this->id)->first();
      return [
        'id'                => $this->id,
        'name'              => $this->name,
        'category_id'       => $this->category_id,
        'category_name'     => $this->category['title_' . request()->header('accept-language', 'en')],
        // 'category_url'  => route('categories', $this->category->id),
        'progress'          => $user->lessons()->where('course_id', $this->id)->count() .' / '. $this->lessons()->count(),
        'image'             => $this->getFirstMediaUrl(),
        'bar'               => $userCourseRow->pivot->score,
        'user_enroll?'  => (bool) $this->users()
                                          ->where('user_id', '=', $user->id)
                                          ->count(),
        'user_like?'    => $this->liked($user->id),
        'updated_at'        => (string) $this->updated_at,
        ];
    }
}
