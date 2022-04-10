<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
      'title', 'q_order', 'lesson_id', 'desc', 'op1', 'op2', 'op3', 'op4', 'right_ans'
  ];

    public function lesson()
    {
        return $this->belongsTo('App\Models\Lesson', 'lesson_id');
    }    
}
