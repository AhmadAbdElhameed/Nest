<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;


    public function getActive(){
        return $this->status == 1 ? __('admin/category.status_active') : __('admin/category.status_inactive');
    }
}
