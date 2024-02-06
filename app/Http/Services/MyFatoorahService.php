<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;
use Exception;
use Illuminate\Support\Facades\Log;

class MyFatoorahService
{

    private $apiKey;
    private $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('myfatoorah.api_key');
        $this->baseUrl = config('myfatoorah.base_url');
        $this->apiUrl = $this->baseUrl . "/v2/SendPayment"; // for example, adjust the endpoint as needed
    }

    public function checkout($request, $checkoutDetails)
    {
        $payload = [

            'Invoicevalue' => number_format($checkoutDetails['total'], 2, '.', ''), // Formatting to two decimal places
            'CurrencyIso' => 'KWD',
            'NotificationOption' => 'LNK',
            'CustomerName' => $checkoutDetails['name'],
            'CustomerEmail' => $checkoutDetails['email'],
            'CallBackUrl' => route('checkout.myfatoorah.success'), // Ensure you have a route named 'payment.callback'
            'ErrorUrl' => route('checkout.myfatoorah.error'), // Ensure you have a route named 'payment.error'
            "Language"=> 'en',
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post($this->apiUrl, $payload);

        if ($response->successful()) {
            $data = $response->json();
            return redirect()->away($data['Data']['InvoiceURL']);
        } else {
            throw new Exception("Error processing payment: " . $response->body());
        }
    }

    public function handleCallback($paymentId)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post($this->baseUrl . '/v2/GetPaymentStatus', [
            'Key' => $paymentId,
            'KeyType' => 'PaymentId',
        ]);

        if (!$response->successful()) {
            // Log the error or handle it as appropriate
            throw new Exception("Error retrieving payment status: " . $response->body());
        }

        // Return the response data as an array or object
        return $response->json(); // Make sure this returns the expected data structure
    }


}
