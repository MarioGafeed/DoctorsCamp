<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;

class Post extends Model Implements HasMedia
{
  use InteractsWithMedia, HasTags;

  protected $fillable = [
    'pcat_id', 'title', 'keyword', 'content', 'desc', 'active', 'user_id',
  ];

  public function pcategory()
  {
      return $this->belongsTo('App\Models\Pcategory', 'pcat_id');
  }

  public function user()
  {
      return $this->belongsTo('App\Models\User', 'user_id');
  }


  public function title($lang = null)
  {
    $lang = $lang ?? App::getLocale();
    return json_decode($this->title)->$lang;
  }
}
