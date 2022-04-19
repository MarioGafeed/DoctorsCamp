<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserLessonsResource extends JsonResource
{
    public function toArray($request)
    {
      $user = $request->user();

      return [
        'id'                => $this->id,
        'name'              => $this->course->name,
        'image'             => $this->course->getFirstMediaUrl(),
        'progress'          => $user->lessons()->where('course_id', $this->course->id)->count() .' / '. $user->lessons()->count(),
        'due time'          => (string) $this->updated_at,
        // 'due time'          => $this->read_at?->diffForHumans(),
        ];
    }
}
