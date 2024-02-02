<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index(){

        $categories = Category::with(['subCategories' => function ($query) {
            $query->where('status',1)->select('id', 'category_id', 'slug','image');
        }, 'translations'])->where('status', 1)->select('id', 'slug','image')->get();
        return view('front.pages.wishlist',compact('categories'));
    }

    public function store(){
        if (! auth()->user()->wishlistHas(request('productId'))) {
            auth()->user()->products()->attach(request('productId'));
            return response() -> json(['status' => true , 'wished' => true]);
        }
        return response() -> json(['status' => true , 'wished' => false]);  // added before we can use enumeration here
    }

    public function destroy($productId)
    {
        $user = auth()->user();
        $user->products()->detach($productId);

        return response()->json(['success' => 'Product removed from wishlist']);
    }

}
