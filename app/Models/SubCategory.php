<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory,Translatable;
//    use HasSlug;

    const PATH = 'uploads/sub-category';
    protected $fillable = ['category_id','name','slug','status','image'];

    protected $with = ['translations'];

    protected $hidden = ['translations'];
    protected $casts = ['status' => "boolean"];

    protected $translatedAttributes = ['name'];

    public function getActive(){
        return $this->status == 1 ? __('admin/category.status_active') : __('admin/category.status_inactive');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
