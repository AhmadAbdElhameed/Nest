<?php

namespace App\Http\Services;

use App\Models\StripeSetting;
use Stripe\Stripe;

class StripeService
{
    public function stripePayment($total){
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
            'success_url' => route('checkout.stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.stripe.cancel'),
        ]);
        return redirect()->away($response->url);

    }
}
