<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Lesson extends Model
{
  use HasFactory;
    protected $fillable = [
        'title','image', 'content', 'myorder', 'course_id', 'active', 'vcontent'
    ];

    public function course()
    {
       return $this->belongsTo('App\Models\Course', 'course_id');
    }
}
