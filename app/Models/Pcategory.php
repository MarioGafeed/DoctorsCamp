<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Pcategory extends Model Implements HasMedia
{
  use InteractsWithMedia;
  
  protected $fillable = [
      'title', 'keyword', 'summary', 'desc'
  ];

  public function posts()
  {
    return $this->hasMany(Post::class, 'pcat_id');
  }
}
