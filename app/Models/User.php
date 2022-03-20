<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail, HasMedia
{
    use HasFactory, Notifiable, HasRoles, InteractsWithMedia, HasApiTokens;

    public const SuperAdminRole = 'Admin';

    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'phone',
        'active',
        'country',
        'last_login_at',
        'last_login_ip',
        'country_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo('App\Models\Role', 'role_id');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id');
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class)
       ->withPivot('score', 'quizz_time', 'status')
       ->withTimestamps();
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class)
        ->withPivot('score', 'active')
        ->withTimestamps();
    }

    public function linkedSocialAccounts()
    {
        return $this->hasMany(LinkedSocialAccount::class);
    }
}
