<?php

namespace App\Http\Services;

class PaymentMethod
{
    const STRIPE = 'stripe';
    const CASH_ON_DELIVERY = 'cash_on_delivery';
    // Add any other constants for other payment methods you may have.

    /**
     * Get all the payment methods.
     *
     * @return array
     */
    public static function getAllMethods()
    {
        return [
            self::STRIPE,
            self::CASH_ON_DELIVERY,
            // Add any other payment methods here.
        ];
    }
}

