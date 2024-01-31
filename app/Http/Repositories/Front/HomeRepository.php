<?php

namespace App\Http\Repositories\Front;

use App\Http\Interfaces\Front\HomeInterface;
use App\Models\Slider;

class HomeRepository implements HomeInterface
{

    public function home()
    {
        $sliders = Slider::where('status',1)->select('id','slug','image')->get();
        return view('front.index',compact('sliders'));
    }
}
