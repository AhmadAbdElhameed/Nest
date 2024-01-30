<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\Twilio;
use App\Http\Services\Vonage;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('front.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request) // : RedirectResponse
    {
        if(config('verification.mode') != 'otp'){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'regex:/^\+?\d+$/', 'max:15', 'min:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'regex:/^\+?\d+$/', 'max:15','min:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'], // Make sure to specify the table name and column for the unique validation
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Generate OTP
        $otp = rand(100000, 999999); // This is a simple example, consider a more secure method
        $otp_till = now()->addMinutes(1); // OTP is valid for 10 minutes

        $user_data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'otp' => $otp,
            'otp_till' => $otp_till->toDateTimeString(), // Ensure this is a string
        ];

        Session::put('registration_data', $user_data);

        // Send OTP
        $user = [
            'phone' => $request->phone,
            'name' => $request->name,
            'otp' => $otp,
        ];

        if(config('verification.otp_provider') == 'twilio'){
            (new  Twilio())->sendForRegister($user);
        }
        if(config('verification.otp_provider') == 'vonage'){
            (new  Vonage())->sendForRegister($user);
        }

        // Return the view to enter the OTP
        return view('front.auth.register-verify-otp')->with(['email' => $request->email]);

    }

    public function verifyOTP(Request $request)
    {
        $registration_data = Session::get('registration_data');

        $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'otp' => ['required'],
        ]);

        if ($registration_data['otp'] != $request->otp) {
            Log::warning('OTP comparison failed.');
            return back()->withErrors(['otp' => 'The provided OTP is incorrect.']);
        }

        if (!$registration_data || $registration_data['email'] !== $request->email) {
            return back()->withErrors(['email' => 'The provided email does not match the registration data.']);
        }

        if (now()->gt($registration_data['otp_till'])) {
            return back()->withErrors(['otp' => 'The OTP has expired.']);
        }

        // OTP is correct and has not expired, proceed with user creation
        $user = User::create($registration_data);

        // Clear the registration data from the session
        $request->session()->forget('registration_data');

        // Dispatch registered event
        event(new Registered($user));

        // Login the user
        Auth::login($user);

        // Redirect to the home page
        return redirect(RouteServiceProvider::HOME);
    }

}
