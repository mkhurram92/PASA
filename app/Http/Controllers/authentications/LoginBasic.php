<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\LoginLog;

class LoginBasic extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except(["logout"]);
    }

    public function index()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        // Attempt to authenticate the user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            // Ensure the member and additionalInfo relationships are loaded
            $user->load('member.additionalInfo');

            // Record login details
            LoginLog::create([
                'user_id' => $user->id,
                'ip_address' => $request->ip(),  // Capture IP address
                'user_agent' => $request->header('User-Agent'),  // Capture user agent (browser)
                'login_at' => now(),  // Capture login time
            ]);

            // Check if the user's account is fully expired
            if ($user->isExpired()) {
                Auth::logout(); // Log out the user
                return redirect()->route('login')->with("error", "Your account has expired. Please contact Pioneers SA.");
            }

            // Check if the user is in the grace period
            if ($user->inGracePeriod()) {
                return redirect()->route('members.view-member', ['id' => $user->member_id])
                    ->with("error", "You are logging in during the grace period. Please renew your membership.");
            }

            // Normal login process for non-expired users
            if ($user->role_id != 1) {
                return redirect()->route('members.view-member', ['id' => $user->member_id])
                    ->with("success", "You have successfully logged in. Welcome back!");
            } else {
                return redirect("/")->with("success", "You have successfully logged in. Welcome back!");
            }
        }

        // Redirect back with an error message if authentication fails
        return redirect()->back()->with("error", "Login failed. Please check your credentials and try again.")->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with("success", "You have been logged out. Please sign in again to continue.");
    }
}
