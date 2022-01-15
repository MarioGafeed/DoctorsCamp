<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Course extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name', 'slug', 'desc', 'price', 'active', 'category_id'
    ];

    public function lessons()
    {
        return $this->HasMany(Lesson::class);
    }

    public function users()
    {
      return $this->belongsToMany(User::class)
       ->withPivot('score','active')
       ->withTimestamps();
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
}
