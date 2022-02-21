<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
          'id'         => $this->id,
          'title_en'   => $this->title_en,
          'title_ar'   => $this->title_ar,
          'country'    => $this->country->name,
          'desc'       => json_decode($this->description, true),
          'user_name'  => $this->user->name,
          'start_date' => $this->start_date,
          'end_date'   => $this->end_date,
          'image'      => $this->getFirstMediaUrl(),
        ];
    }
}
