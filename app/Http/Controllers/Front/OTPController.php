<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
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


        return back()->with('status','Link sent to your inbox');
    }
}
