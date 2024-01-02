<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory,Translatable;


    protected $fillable = ['name','slug','status'];

    protected $with = ['translations'];

    protected $hidden = ['translations'];
    protected $casts = ['status' => "boolean"];

    protected $translatedAttributes = ['name'];
}
