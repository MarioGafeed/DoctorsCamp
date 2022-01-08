<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
     'answer', 'status', 'question_id',
 ];

    public function question()
    {
        return $this->belongsTo('App\Models\Question', 'question_id');
    }
}
