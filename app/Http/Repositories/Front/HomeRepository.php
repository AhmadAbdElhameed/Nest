<?php

namespace App\Http\Repositories\Front;

use App\Http\Interfaces\Front\HomeInterface;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Support\Facades\Response;

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

    public function category($category)
    {
        $categories = Category::with(['subCategories' => function ($query) {
            $query->where('status',1)->select('id', 'category_id', 'slug','image');
        }, 'translations'])->where('status', 1)->select('id', 'slug','image')->get();
        return view('front.pages.category',compact('category','categories'));
    }

    public function productDetails($product)
    {
        $categories = Category::with(['subCategories' => function ($query) {
            $query->where('status',1)->select('id', 'category_id', 'slug','image');
        }, 'translations'])->where('status', 1)->select('id', 'slug','image')->get();

        // Get the IDs of the categories this product belongs to
        $categoryIds = $product->categories->pluck('id');
//        dd($categoryIds);
        // Find other products in the same categories, excluding the current product
        $relatedProducts = Product::whereHas('categories', function ($query) use ($categoryIds) {
            $query->whereIn('category_id', $categoryIds);
        })->where('id', '!=', $product->id)->take(4)->get();

        return view('front.pages.product-details',compact('product','categories','relatedProducts'));
    }

    public function showModalContent($id)
    {
        $product = Product::findOrFail($id);
        return view('front.includes.quick_view', compact('product'))->render();

    }
}
