<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Ensure2FACompleted
{
    public function handle(Request $request, Closure $next)
    {
        $admin = Auth::guard('admin')->user();

        // Check if 2FA is enabled and if the 2FA session flag is not set
        if ($admin->is_2fa_enabled && !$request->session()->get('admin_2fa_verified', false)) {
            // Redirect to the 2FA verification page
            return redirect()->route('admin.2fa');
        }

        return $next($request);
    }
}

