<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TagpostsResource extends JsonResource
{
    public function toArray($request)
    {      
        return [
            'id'           => $this->id,
            'title'        => $this['title_' . request()->header('accept-language', 'en')],
            'user_name'    => $this->user->name,
            'image'        => $this->getFirstMediaUrl(),
            'comments_count' => $this->comments()->count(),
            'updated_at'   => (string) $this->updated_at,
        ];
    }
}
