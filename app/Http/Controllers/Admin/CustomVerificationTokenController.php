<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;

use Illuminate\Auth\Events\Verified;
use App\Http\Requests\Front\Verification\CustomEmailVerificationRequest;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomVerificationTokenController extends Controller
{
    public function notice(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
            ? redirect()->intended(RouteServiceProvider::HOME)
            : view('auth.verify-email');
    }

    public function verify(CustomEmailVerificationRequest $request)
    {
        $user = User::where('verification_token' , $request->token)->firstOrFail();
        if(now() < $user->verification_token_till){
            $user->verifyUsingVerificationToken();
            return to_route('dashboard');
        }

        abort(401);
    }

    public function store(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
