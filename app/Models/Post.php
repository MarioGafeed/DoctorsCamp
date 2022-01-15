<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\App;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;

class Post extends Model implements HasMedia
{
    use InteractsWithMedia, HasTags;
    use \Conner\Likeable\Likeable;

    protected $fillable = [
     'title_en', 'title_ar', 'keyword', 'content', 'desc', 'active', 'user_id', 'category_id', 'youtubeURL', 'type',
  ];

    // public function categoryable()
    // {
    //     return $this->morphTo('App\Models\Category', 'categoryable');
    // }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    // public function title($lang = null)
  // {
  //   $lang = $lang ?? App::getLocale();
  //   return json_decode($this->title)->$lang;
  // }
}
