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

        $products = auth()->user()->products;
        return view('front.pages.wishlist',compact('categories','products'));
    }

    public function store(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['status' => 'unauthorized'], 401);
        }

        $user = auth()->user();
        $productId = $request->input('productId');

        // Check if the product is already in the user's wishlist
        if ($user->products()->where('product_id', $productId)->exists()) {
            return response()->json([
                'status' => 'exists',
                'wishlistCount' => $user->products()->count() // return the count even if it exists
            ]);
        }

        // Add the product to the wishlist
        $user->products()->attach($productId);
        return response()->json([
            'status' => 'success',
            'wishlistCount' => $user->products()->count() // return the updated count
        ]);
    }

    public function destroy($productId)
    {
        if (!auth()->check()) {
            return response()->json(['status' => 'unauthorized'], 401);
        }

        $user = auth()->user();
        $user->products()->detach($productId);

        return response()->json([
            'success' => 'Product removed from wishlist',
            'wishlistCount' => $user->products()->count() // return the updated count
        ]);
    }

    public function count(){
        if (!auth()->check()) {
            return response()->json(['wishlistCount' => 0]);
        }

        $wishlistCount = auth()->user()->products()->count();
        return response()->json(['wishlistCount' => $wishlistCount]);
    }

}
