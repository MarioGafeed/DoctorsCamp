<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','slug', 'desc', 'price', 'active', 'image'
    ];

    public function lessons()
    {
        return $this->HasMany(Lesson::class);
    }
}
