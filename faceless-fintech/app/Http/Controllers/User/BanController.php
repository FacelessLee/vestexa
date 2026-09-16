<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings;

class BanController extends Controller
{
    /**
     * Show the banned user page
     */
    public function bannedPage()
    {
        $settings = Settings::where('id', 1)->first();
        
        // Get the ban details if user was just logged out due to ban
        $banMessage = session('ban_message', 'Your account has been suspended.');
        $bannedAt = session('banned_at');
        $banExpiresAt = session('ban_expires_at');
        
        return view('user.banned', compact('settings', 'banMessage', 'bannedAt', 'banExpiresAt'));
    }
}
