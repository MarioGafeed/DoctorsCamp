<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'content', 'myorder', 'course_id', 'active', 'vcontent',
    ];

    public function course()
    {
        return $this->belongsTo('App\Models\Course', 'course_id');
    }

    public function users()
    {
      return $this->BelongsToMany(User::class)
      ->withPivot('score','time_mins','status')
      ->withTimestamps();
    }
}
