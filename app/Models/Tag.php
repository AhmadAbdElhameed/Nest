<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory,Translatable;
//    use HasSlug;

    protected $fillable = ['slug'];

    protected $with = ['translations'];

    protected $hidden = ['translations'];

    protected $translatedAttributes = ['name'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
