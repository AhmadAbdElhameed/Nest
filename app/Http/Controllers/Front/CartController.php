<?php

namespace App\Http\Controllers\Front;

use App\Basket\Basket;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
//        $basket = $this -> basket ;
        // Retrieve cart items
        // Initialize an empty array to hold the full product models
        $cartProducts = [];

        // Loop through each item in the cart
        foreach (Cart::content() as $item) {
            // Find the product by ID and load any necessary relationships
            $product = Product::with('images', 'translations') // Add other relationships as needed
            ->find($item->id);

            if ($product) {
                // Add the product to the cartProducts array, including quantity and other cart item details
                $cartProducts[] = [
                    'product' => $product,
                    'quantity' => $item->qty,
                    'rowId' => $item->rowId, // rowId is useful for cart operations like remove, update
                    'price' => $item->price,
                    'qty' => $item->qty,
                ];
            }
        }

        // Calculate the total price of the cart items
        $total = Cart::subtotal();

        return view('front.pages.cart',compact('categories','cartProducts','total'));
    }

    public function addToCart(Request $request) {
        $productId = $request->input('productId');
        $product = Product::findOrFail($productId);

        // Check if the product is already in the cart
        $cartItem = Cart::search(function ($cartItem) use ($productId) {
            return $cartItem->id == $productId;
        })->first();

        if ($cartItem) {
            // If the product is already in the cart, increase its quantity
            Cart::update($cartItem->rowId, ['qty' => $cartItem->qty + 1]); // Adjusted to use an array
        } else {
            // If the product is not in the cart, add it as a new item
            Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'qty' => 1, // 'quantity' should be 'qty'
                'weight' => 0, // Optional, only include if necessary for your application
            ]);
        }

        $cartCount = Cart::content()->count();
        return response()->json(['cartCount' => $cartCount]);
    }


    public function cartCount() {
        $cartItems = Cart::content();
        $totalQuantity = 0;

        foreach ($cartItems as $item) {
            $totalQuantity += $item->qty;
        }
        return response()->json(['cartCount' => $totalQuantity]);
    }

}
