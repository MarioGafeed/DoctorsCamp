<?php

namespace App\Models;

use BeyondCode\Comments\Traits\HasComments;
use Conner\Likeable\Likeable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;

class Post extends Model implements HasMedia
{
    use InteractsWithMedia, HasTags, HasComments, Likeable;

    protected $fillable = [
        'title_en', 'title_ar', 'keyword', 'content', 'desc', 'active', 'user_id', 'category_id', 'youtubeURL', 'type',
    ];

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
