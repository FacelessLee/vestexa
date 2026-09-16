<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class EnsureTwoFactorAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        
        // If 2FA is enabled for this user and the session doesn't have 2FA verification
        if ($user && $user->two_factor_enabled && !Session::has('two_factor_authenticated')) {
            // Generate a new 2FA code if one doesn't exist or is expired
            if (!$user->two_factor_code || 
                !$user->two_factor_expires_at || 
                now()->gt($user->two_factor_expires_at)) {
                
                // Generate a random verification code
                $code = mt_rand(100000, 999999);
                
                // Store the verification code and expiry in database
                $user->two_factor_code = $code;
                $user->two_factor_expires_at = now()->addMinutes(10);
                $user->save();
                
                // Send the notification with the code
                $user->notify(new \App\Notifications\TwoFactorCode($code));
            }
            
            return redirect()->route('two-factor.challenge');
        }
        
        return $next($request);
    }
}
