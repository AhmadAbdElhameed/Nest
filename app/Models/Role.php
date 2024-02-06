<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name','permissions'];

    public function users(){
        $this->hasMany(User::class);
    }

    protected $casts = [
        'permissions' => 'array',
    ];

    public function getPermissionAttribute($permissions){
        return json_decode($permissions,true);
    }
}
