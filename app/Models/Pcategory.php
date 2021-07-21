<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Pcategory extends Model
{
  protected $fillable = [
      'title','image', 'keyword', 'summary', 'desc'
  ];

  public function posts()
  {
    return $this->hasMany(Post::class, 'pcat_id');
  }
}
