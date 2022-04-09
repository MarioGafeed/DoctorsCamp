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
        'category_name'     => $this->category['title_' . request()->header('accept-language', 'en')],
        // 'category_url'  => route('categories', $this->category->id),
        'progress'          => $user->lessons()->where('course_id', $this->id)->count() .' / '. $this->lessons()->count(),
        'image'             => $this->getFirstMediaUrl(),
        'bar'               => $userCourseRow->pivot->score,
        // 'instractor'    => $this->user,
        'updated_at'        => (string) $this->updated_at,
        ];
    }
}
