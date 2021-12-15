<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;



class Vpost extends Model Implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
       'vcat_id', 'title', 'keyword', 'content', 'desc', 'active', 'user_id',
  ];

    public function vcategory()
    {
        return $this->belongsTo('App\Models\Vcategory', 'vcat_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    
}
