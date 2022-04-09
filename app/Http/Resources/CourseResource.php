<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    public function toArray($request)
    {
        return [
          'id'            => $this->id,
          'name'          => $this->name,
          'desc'          => json_decode($this->desc, true)[request()->header('Accept-Language', 'ar')] ?? null,
          // 'active'        => $this->active,
          'category'      => $this->category->id,
          'category_name' => $this->category['title_' . request()->header('accept-language', 'en')],
          'lessons'       => $this->lessons()->select('id', 'title', 'myorder')->get(),
          // 'lessons'       => LessonResource::collection($this->lessons),
          'lessons_count' => $this->lessons()->count(),
          'users_count'   => $this->users()->count(),
          'image'         => $this->getFirstMediaUrl(),
          'price'         => $this->price,
          'login_url'     => route('user.login'),
          'updated_at'    => (string) $this->updated_at,
          ];
    }
}
