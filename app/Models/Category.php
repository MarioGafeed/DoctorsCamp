<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'title_ar', 'title_en', 'slug',  'summary', 'keyword', 'desc'
    ];
    // public function categoryable()
    // {
    //   return $this->morphMany();
    // }

    public function posts()
    {
      return $this->hasMany(post::class, 'category_id');
    }

    public function vposts()
    {
      return $this->hasMany(Vpost::class, 'category_id');
    }

    public function courses()
    {
      return $this->hasMany(Course::class, 'category_id');
    }
}
