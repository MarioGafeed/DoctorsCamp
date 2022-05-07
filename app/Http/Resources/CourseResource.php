<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class CourseResource extends JsonResource
{
    public function toArray($request)
    {
        $user = $request->user();

        if ($user !== null){

          $userlessons = $user->lessons()->where('course_id', $this->id)->get();

          return [
          'id'            => $this->id,
          'name'          => $this->name,
          'desc'          => json_decode($this->desc, true)[request()->header('Accept-Language', 'ar')] ?? null,
          'category'      => $this->category->id,
          'category_name' => $this->category['title_' . request()->header('accept-language', 'en')],
          'lessons_count' => $this->lessons()->count(),
          'lessons'       => $this->lessons()->select('id', 'title', 'myorder', 'content', 'vcontent')->get(),
          'lessons'       => UserLessonResource::collection($userlessons),
          'students_count'=> $this->users()->count(),
          'image'         => $this->getFirstMediaUrl(),
          'price'         => $this->price,
          'user_enroll?'  => (bool) $this->users()
                                            ->where('user_id', '=', $user->id)
                                            ->count(),
          'user_like?'    => $this->liked($user->id),
          'login_url'     => route('user.login'),
          'updated_at'    => (string) $this->updated_at,
          ];
        }else {
          return [
            'id'            => $this->id,
            'name'          => $this->name,
            'desc'          => json_decode($this->desc, true)[request()->header('Accept-Language', 'ar')] ?? null,
            'category'      => $this->category->id,
            'category_name' => $this->category['title_' . request()->header('accept-language', 'en')],
            'lessons'       => $this->lessons()->select('id', 'title', 'myorder')->get(),
            'lessons_count' => $this->lessons()->count(),
            'students_count'=> $this->users()->count(),
            'image'         => $this->getFirstMediaUrl(),
            'price'         => $this->price,
            'language'      => 'عربي',
            'login_url'     => route('user.login'),
            'updated_at'    => (string) $this->updated_at,
            ];
        }
    }
}
