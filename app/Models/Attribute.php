<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory,Translatable;

    protected $guarded = [];

    protected $with = ['translations'];
    protected $translatedAttributes = ['name'];


    public function options(){
        return $this->hasMany(Option::class);
    }
}
