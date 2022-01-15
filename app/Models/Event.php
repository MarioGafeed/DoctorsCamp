<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use BeyondCode\Comments\Traits\HasComments;

class Event extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasComments;

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
}
