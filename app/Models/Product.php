<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, Translatable;

    const PATH = 'uploads/products';
    protected $fillable = [
                        'slug',
                        'price',
                        'special_price',
                        'special_price_type',
                        'special_price_start',
                        'special_price_end',
                        'selling_price',
                        'sku',
                        'manage_stock',
                        'qty',
                        'in_stock',
                        'viewed',
                        'status',
                        'brand_id'
    ];


    protected $with = ['translations'];

    protected $hidden = ['translations'];
    protected $casts = ['status' => "boolean",
                        'in_stock' => "boolean",
                        'manage_stock' => "boolean",
        ];


    protected $dates = [
        'special_price_start',
        'special_price_end',
        'deleted_at'
    ];

    protected $translatedAttributes = ['name','description','short_description'];


    public function scopeActive($query){
        return $query->where('status' , 1);
    }

    public function getActive(){
        return $this->status == 1 ? __('admin/category.status_active') : __('admin/category.status_inactive');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }


    public function brand(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Brand::class)->withDefault();
    }

    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function tags(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function options(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Option::class);
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }


}
