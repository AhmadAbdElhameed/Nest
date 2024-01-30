<?php

namespace App\Http\Repositories\Admin;

use App\Http\Interfaces\Admin\LoginInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FAQRCode\Google2FA;


class LoginRepository implements LoginInterface
{

    public function login()
    {
        return view('admin.auth.login');
    }

    public function store($request)
    {
        $remember_me = $request->has('remember_me');
        if(auth()->guard('admin')->attempt(['email' => $request->input('email'),
            'password' => $request->input('password')] , $remember_me)){
            $admin = auth()->guard('admin')->user();

            // Check if 2FA is enabled for the admin
            if ($admin->is_2fa_enabled) {
                // Redirect to the 2FA page
                return redirect()->route('admin.2fa');
            }

            toast(auth('admin')->user()->name . ' مرحبا','success');
            return redirect()->route('admin.dashboard');
        }
        toast('هناك خطا في بيانات الدخول','error');
        return redirect()->back()->with(['error' => 'هناك خطأ في البيانات']);
    }

    public function logout()
    {
        $guard = $this->getGuard();
        $guard->logout();

        // Clear the 2FA session flag
        session()->forget('admin_2fa_verified');

        return redirect()->route('admin.login');
    }

    private function getGuard()
    {
        return auth('admin');
    }



    public function twoFactor()
    {
        return view('admin.auth.2f');
    }

    public function twoFactorVerify($request)
    {
        $request->validate(['auth_2fa_secret' => 'required']);

        $admin = $this->getGuard()->user();
        $google2fa = new Google2FA();

        // Verify the 2FA code
        $valid = $google2fa->verifyKey($admin->auth_2fa_secret, $request->input('auth_2fa_secret'));

        if ($valid) {
            // Set a session flag indicating that 2FA verification is complete
            session(['admin_2fa_verified' => true]);

            toast($admin->name . ' مرحبا','success');

            // Redirect to the intended URL or the dashboard if no intended URL is set
            return redirect()->intended(route('admin.dashboard'));
        } else {
            // If the 2FA code is incorrect, redirect back with an error
            toast('الرمز غير صحيح','error');
            return redirect()->back()->withErrors(['2fa_code' => 'الرمز غير صحيح']);
        }
    }



}
