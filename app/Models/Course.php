<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'desc', 'price', 'active',
    ];

    public function lessons()
    {
        return $this->HasMany(Lesson::class);
    }

    public function users()
    {
      return $this->BelongsToMany(User::class)
       ->withPivot('score','active')
       ->withTimestamps();
    }

    public function category()
    {
        return $this->belongsTo('App\Models\category', 'category_id');
    }
}
