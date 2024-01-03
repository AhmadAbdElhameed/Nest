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

    protected $fillable = ['name','slug','status'];

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

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(function (Model $model) {
                return $model->translate('en')->name; // Assuming 'en' is one of the languages.
            })
            ->saveSlugsTo('slug');
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = $this->createSlug($value);
    }

    protected function createSlug($name)
    {
        // If the name is non-English, you may need to generate the slug differently
        if (!preg_match('/[\p{Latin}]/u', $name)) {
            // Handle the slug generation for non-Latin characters
            // This is just an example and might not cover all cases
            return Str::slug(transliterator_transliterate('Any-Latin; Latin-ASCII; Lower()', $name));
        }

        return Str::slug($name);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
