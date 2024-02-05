<?php

namespace App\Http\Services;

use App\Models\Order;
use App\Models\OrderItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;

class CashOnDeliveryService
{
    public function codPayment()
    {
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
