<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class Vcategory extends Model Implements HasMedia
{
  use InteractsWithMedia;

  protected $fillable = [
      'title', 'keyword', 'summary', 'desc'
  ];

  public function vposts()
  {
    return $this->hasMany(Vpost::class, 'vcat_id');
  }
}
