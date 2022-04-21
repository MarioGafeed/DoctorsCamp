<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Conner\Likeable\Likeable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;



class Category extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, Likeable;

    protected $fillable = [
        'title_ar', 'title_en', 'slug',  'summary', 'keyword', 'desc', 'icon'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'category_id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'category_id');
    }

}
