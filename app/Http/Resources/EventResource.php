<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    public function toArray($request)
    {
      $user = $request->user();
      if ($user != null) {
        return [
          'id'         => $this->id,
          'title'      => $this['title_' . request()->header('accept-language', 'en')],
          'country'    => $this->country->name,
          'location'   => $this->location,
          'desc'       => json_decode($this->description, true)[request()->header('Accept-Language', 'ar')] ?? null,
          'start_date' => $this->start_date,
          'end_date'   => $this->end_date,
          'likes_count'=> $this->likes()->count(),
          'user_like?' => $this->liked($user->id),
          'user_enroll?'  => (bool) $this->users()
                                            ->where('user_id', '=', $user->id)
                                            ->count(),
          'image'      => $this->getFirstMediaUrl(),
        ];
      }else {
        return [
          'id'         => $this->id,
          'title'      => $this['title_' . request()->header('accept-language', 'en')],
          'country'    => $this->country->name,
          'location'   => $this->location,
          'desc'       => json_decode($this->description, true)[request()->header('Accept-Language', 'ar')] ?? null,
          'start_date' => $this->start_date,
          'end_date'   => $this->end_date,
          'likes_count'=> $this->likes()->count(),
          'image'      => $this->getFirstMediaUrl(),
        ];
      }

    }
}
