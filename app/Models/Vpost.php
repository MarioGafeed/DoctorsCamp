<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;


class Vpost extends Model
{
    protected $fillable = [
       'vcat_id', 'title', 'image', 'keyword', 'content', 'desc', 'active', 'user_id',
  ];

    public function vcategory()
    {
        return $this->belongsTo('App\Models\Vcategory', 'vcat_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function vtaqs()
    {
        return $this->belongsToMany('App\Models\Vtaq', 'vposts_taqs', 'vpost_id', 'vtaq_id');
    }
}
