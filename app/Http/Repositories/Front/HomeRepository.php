<?php

namespace App\Http\Repositories\Front;

use App\Http\Interfaces\Front\HomeInterface;
use App\Models\Category;
use App\Models\Slider;

class HomeRepository implements HomeInterface
{

    public function home()
    {
        $sliders = Slider::where('status',1)->select('id','slug','image')->get();
        $categories = Category::with(['subCategories' => function ($query) {
            $query->where('status',1)->select('id', 'category_id', 'slug','image');
        }, 'translations'])->where('status', 1)->select('id', 'slug','image')->get();

        return view('front.index',compact('sliders','categories'));
    }
}
