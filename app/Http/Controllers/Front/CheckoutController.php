<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(){
    // Retrieve categories for the dropdown or other UI elements
    $categories = Category::with(['subCategories' => function ($query) {
        $query->where('status',1)->select('id', 'category_id', 'slug','image');
    }, 'translations'])->where('status', 1)->select('id', 'slug','image')->get();

    // Retrieve cart items for the current user
        $cartItems = Cart::content()->map(function ($item) {
            $product = Product::with('images')->find($item->id);
            return [
                'rowId' => $item->rowId,
                'id' => $item->id,
                'name' => $item->name,
                'qty' => $item->qty,
                'price' => $item->price,
                'subtotal' => $item->subtotal,
                'image' => $product->images->first()->image ?? 'default.png', // Assuming 'image' is the correct field
            ];
        });
    $cartSubtotal = Cart::subtotal(); // This gives you the subtotal without shipping
    $shippingFee = $this->calculateShippingFee(); // Implement this method based on your shipping logic
    $total = (float)str_replace(',', '', $cartSubtotal) + $shippingFee; // Convert subtotal to float and add shipping fee

    // Pass the cart items and totals to the checkout view
        return view('front.pages.checkout', [
            'categories' => $categories,
            'cartItems' => $cartItems,
            'cartSubtotal' => Cart::subtotal(),
            'shippingFee' => $this->calculateShippingFee(),
            'total' => $total
        ]);
}

    private function calculateShippingFee()
    {
        // Implement your logic here to calculate shipping fee based on cart items
        // For example, you might offer free shipping over a certain subtotal amount
        $subtotal = Cart::subtotal();
        return $subtotal > 1000 ? 0 : 30; // Free shipping for orders over $1000, else $10 fee
    }
}
