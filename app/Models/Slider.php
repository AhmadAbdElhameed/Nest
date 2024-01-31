<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory,Translatable;

    CONST PATH = 'uploads/sliders';

    protected $fillable = ['slug','image','status'];

    protected $with = ['translations'];
    protected $casts = ['is_translatable' => "boolean"];
    protected $translatedAttributes = ['title','sub_title'];
    public function getActive(){
        return $this->status == 1 ? __('admin/category.status_active') : __('admin/category.status_inactive');
    }
}
