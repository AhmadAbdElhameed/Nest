<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable ;


    protected $fillable = ['name','email','password','is_2fa_enabled','auth_2fa_secret','role_id'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }


}
