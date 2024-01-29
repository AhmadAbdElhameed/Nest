<?php

namespace App\Http\Services;



use Illuminate\Support\Facades\Log;
use Vonage\Client;
use Vonage\Client\Credentials\Basic;
use Vonage\SMS\Message\SMS;

class Vonage
{

    public function send($user){
        $basic  = new Basic(env('VONAGE_API_KEY'), env('VONAGE_API_SECRET'));
        $client = new Client($basic);

        try {
            $response = $client->sms()->send(
                new SMS($user->phone, env('BRAND_NAME'), "Hi, $user->name, Your OTP is $user->otp")
            );
        }catch (\Exception $e){
            Log::alert($e->getMessage());
        }
    }
}
