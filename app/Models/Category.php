<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title_ar', 'title_en', 'slug',  'summary', 'keyword', 'desc',
    ];
    // public function categoryable()
    // {
    //   return $this->morphMany();
    // }

    public function posts()
    {
        return $this->hasMany(post::class, 'category_id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'category_id');
    }
}
