<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PdfResource extends JsonResource
{
    public function toArray($request)
    {
        return [
          'id'               => $this->id,
          'name'             => $this->name,
          'type'             => $this->type,
          'size'             => $this->size. " KB",
          'created_at'       => $this->created_at,
        ];
    }
}
