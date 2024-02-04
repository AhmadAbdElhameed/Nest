<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\StripeSetting;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe\Stripe;

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

    $order_details = ['cartItems' => $cartItems ,'total' => $total];
    Session::put('order_details', $order_details);
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


    public function store(Request $request)
    {
        $order_details = Session::get('order_details');

        $checkoutDetails = [
          'user_id' => auth()->user()->id,
          "name" => $request->name,
          "email" => $request->email,
          "city" => $request->city,
          "phone" => $request->phone,
          "address" => $request->address,
          "notes" => $request->additional_info,
          "payment_method" => $request->payment_method,
          'total' => $order_details['total'],
          'cart_items' => $order_details['cartItems'],
        ];
//        dd($checkoutDetails);
        Session::put('checkout_details', $checkoutDetails);

        if($request->payment_method === 'stripe'){
            return $this->stripePayment($order_details['total']);
        }elseif ($request->payment_method === 'cod'){
            return $this->codPayment();
        }else{
            toast()->error('Something went wrong please try again later!');
            return redirect()->route('shop');
        }
    }


    private function stripePayment($total){
        $stripeSetting = StripeSetting::first();
        Stripe::setApiKey($stripeSetting->client_secret);

        $response = \Stripe\Checkout\Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Nest Mart',
                        ],
                        'unit_amount' => $total * 100, // $100 = 10000 cents
                    ],
                    'quantity' => 1,
                ]
            ],
            'mode' => 'payment',
            'success_url' => route('checkout.stripe.success'),
            'cancel_url' => route('checkout.stripe.cancel'),
        ]);
        return redirect()->away($response->url);

    }

    public function stripeSuccess(Request $request)
    {
        $checkout_details = Session::get('checkout_details');
//        dd($checkout_details,$checkout_details['payment_method']);
        $order = Order::create([
            'payment_method' => 'stripe',
            'phone' => $checkout_details['phone'],
            'user_id' =>$checkout_details['user_id'],
            'name' => $checkout_details['name'],
            'email' => $checkout_details['email'],
            'city' => $checkout_details['city'],
            'address' => $checkout_details['address'],
            'notes' => $checkout_details['notes'] ?? NULL,
            'payment_status' => 'success',
            'total_amount' => $checkout_details['total']
        ]);
        $cartProducts = $checkout_details['cart_items'];
        foreach ($cartProducts as $product){
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product['id'],
                'quantity' => $product['qty'],
                'price' => $product['price'],
            ]);
        }

//        OrderPlacedNotificationEvent::dispatch($order);
        Cart::destroy();

        toast()->success('Payment successful and order confirmed!');
        return redirect()->route('home');
    }

    public function stripeCancel()
    {
        toast()->error('Payment failed, Please try again.');
        return redirect()->route('checkout.index');
    }

    private function codPayment(){
        $checkout_details = Session::get('checkout_details');
        $order = Order::create([
            'payment_method' => 'cod',
            'phone' => $checkout_details['phone'],
            'user_id' =>$checkout_details['user_id'],
            'name' => $checkout_details['name'],
            'email' => $checkout_details['email'],
            'city' => $checkout_details['city'],
            'address' => $checkout_details['address'],
            'notes' => $checkout_details['notes'] ?? NULL,
            'payment_status' => 'pending',
            'total_amount' => $checkout_details['total']
        ]);
        $cartProducts = $checkout_details['cart_items'];
        foreach ($cartProducts as $product){
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product['id'],
                'quantity' => $product['qty'],
                'price' => $product['price'],
            ]);
        }

//        OrderPlacedNotificationEvent::dispatch($order);
        Cart::destroy();

        toast()->success('Order confirmed & our team will call you soon.');
        return redirect()->route('home');
    }
}
