<?php

namespace App\Http\Services;


use Illuminate\Support\Facades\Log;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class Twilio
{
    /**
     * @throws ConfigurationException
     */
    public function send($user){

        // Your Account SID and Auth Token from console.twilio.com
//        $sid = "";
//        $token = "";

        $sid = env('TWILIO_SID');
        $token = env('TWILIO_TOKEN');
        $client = new Client($sid, $token);

        try {
            // Use the Client to make requests to the Twilio REST API
            $client->messages->create(
            // The number you'd like to send the message to
                $user->phone,
                [
                    // A Twilio phone number you purchased at https://console.twilio.com
                    'from' => env('TWILIO_PHONE'),
                    // The body of the text message you'd like to send
                    'body' => "Hey $user->name! Your OTP is $user->otp"
                ]
            );
        }catch (TwilioException $e){
            Log::alert($e->getMessage());
        }

    }

    public function sendForRegister($user){

        // Your Account SID and Auth Token from console.twilio.com
//        $sid = "";
//        $token = "";

        $phone = $user['phone'];
        $otp = $user['otp'];
        $name = $user['name'];

        $sid = env('TWILIO_SID');
        $token = env('TWILIO_TOKEN');
        $client = new Client($sid, $token);

        try {
            // Use the Client to make requests to the Twilio REST API
            $client->messages->create(
            // The number you'd like to send the message to
                $phone,
                [
                    // A Twilio phone number you purchased at https://console.twilio.com
                    'from' => env('TWILIO_PHONE'),
                    // The body of the text message you'd like to send
                    'body' => "Hey $name! Your OTP is $otp"
                ]
            );
        }catch (TwilioException $e){
            Log::alert($e->getMessage());
        }

    }

}
