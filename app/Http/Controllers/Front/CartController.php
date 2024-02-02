<?php

namespace App\Http\Controllers\Front;

use App\Basket\Basket;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $basket;
    protected $id;

    public function __construct(Basket $basket)
    {
        $this->basket = $basket;
    }

    public function index(){

        $categories = Category::with(['subCategories' => function ($query) {
            $query->where('status',1)->select('id', 'category_id', 'slug','image');
        }, 'translations'])->where('status', 1)->select('id', 'slug','image')->get();
        $basket = $this -> basket ;
        return view('front.pages.cart',compact('categories','basket'));
    }

    public function addToCart(){

    }
}
