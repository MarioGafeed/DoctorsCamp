<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Question extends Model
{
  use HasFactory;
  protected $fillable = [
      'title', 'q_order', 'lesson_id', 'desc'
  ];

  public function lesson()
  {
     return $this->belongsTo('App\Models\Lesson', 'lesson_id');
  }

  public function answers()
  {
      return $this->hasMany('App\Models\Answer', 'question_id');
  }
}
