<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class OTPController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required','email','max:255'],
        ]);

        $user = User::where('email',$request->email)->first();

        if(!$user){
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        $user->generateOTP();

        // Send OTP


        return view('front.auth.verify-otp')->with(['email' => $request->email]);
    }

    public function verifyOTP(Request $request){
        $request->validate([
            'email' => ['required','email','max:255'],
            'otp' => ['required'],
        ]);

        $user = User::where('email',$request->email)->first();

        if(!$user){
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        if($user && $user->otp == $request->otp){
            if(now() < $user->otp_till){
                $user->resetOTP();
                Auth::guard('web')->login($user);
                return to_route('home');
            }else{
                throw ValidationException::withMessages([
                    'email' => 'Expired OTP',
                ]);
            }
        }

    }
}
