<?php

namespace App\Models;

use BeyondCode\Comments\Traits\HasComments;
use Conner\Likeable\Likeable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;

class Image extends Model implements HasMedia
{
    use HasComments;
    use HasTags;
    use InteractsWithMedia;
    use Likeable;

    protected $fillable = [
        'category_id', 'user_id', 'title_en', 'title_ar', 'desc'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
