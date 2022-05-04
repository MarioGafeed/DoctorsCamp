<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
          'id'                    => $this->id,
          'title'                 => $this->data['title'][request()->header('Accept-Language', 'ar')],
          'description'           => $this->data['description'][request()->header('Accept-Language', 'ar')],
          'entity_type'           => $this->entity_type,
          'entity_id'             => $this->entity_id,
          'read_at'               => $this->read_at?->diffForHumans(),
      ];
    }
}
