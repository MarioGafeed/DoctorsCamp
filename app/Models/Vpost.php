<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;


class Vpost extends Model Implements HasMedia
{
    use InteractsWithMedia, HasTags;

    protected $fillable = [
       'vcat_id', 'title', 'keyword', 'content', 'desc', 'active', 'user_id',
  ];

    public function category()
    {
        return $this->belongsTo('App\Models\category', 'category_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

}
