<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model
{
    use HasFactory,Translatable;
//    use HasSlug;

    const PATH = 'uploads/category';
    protected $fillable = ['name','slug','status','image'];

    protected $with = ['translations'];

    protected $hidden = ['translations'];
    protected $casts = ['status' => "boolean"];

    protected $translatedAttributes = ['name'];

    public function scopeParent($query){
        return $query->whereNull('parent_id');
    }

    public function getActive(){
       return $this->status == 1 ? __('admin/category.status_active') : __('admin/category.status_inactive');
     }


    public function scopeActive($query){
        return $query -> where('status',1) ;
    }

    /**
     * Get the options for generating the slug.
     */
//    public function getSlugOptions() : SlugOptions
//    {
//        return SlugOptions::create()
//            ->generateSlugsFrom(function (Model $model) {
//                return $model->translate('en')->name; // Assuming 'en' is one of the languages.
//            })
//            ->saveSlugsTo('slug');
//    }
//
//    public function setNameAttribute($value)
//    {
//        $this->attributes['name'] = $value;
//        $this->attributes['slug'] = $this->createSlug($value);
//    }
//
//    protected function createSlug($name)
//    {
//        // Check if the name contains non-Latin characters (like Arabic)
//        if (!preg_match('/[\p{Latin}]/u', $name)) {
//            // Handle slug generation for non-Latin characters
//            // You might use a library or custom logic here
//            return $this->arabicSlug($name);
//        }
//
//        // Default slug generation for Latin characters
//        return Str::slug($name);
//    }
//
//    private function arabicSlug($name)
//    {
//        // Custom logic to generate a slug for Arabic characters
//        // This is a simple example and might need to be adjusted
//        $slug = preg_replace('/\s+/u', '-', trim($name));
//        return $slug;
//    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
