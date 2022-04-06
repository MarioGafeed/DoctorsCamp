<?php

namespace App\Models;

use BeyondCode\Comments\Traits\HasComments;
use Conner\Likeable\Likeable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;

class Event extends Model implements HasMedia
{
    use HasComments;
    use HasTags;
    use InteractsWithMedia;
    use Likeable;

    protected $fillable = [
       'title_en', 'title_ar', 'country_id', 'location', 'start_date', 'end_date', 'user_id', 'description', 'active', 'city',
    ];

    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function users()
    {
      return $this->belongsToMany(User::class)
      ->withPivot('status')
      ->withTimestamps();
    }
}
