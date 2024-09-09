<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

        // Check if the user's account is expired
        if ($user->member && $user->member->additionalInfo) {
            if ($user->isExpired()) {
                Auth::logout(); // Log out the user
                return redirect()->route('login')->with("error", "Your account has expired. Please contact Pioneers SA.");
            }

            // If not expired, check if user is admin
            if ($user->role_id != 1) {
                // Redirect non-admin users to their specific member view page
                return redirect()->route('members.view-member', ['id' => $user->member_id])->with("success", "You have successfully logged in. Welcome back!");
            } else {
                // If the user is an admin, redirect to the homepage
                return redirect("/")->with("success", "You have successfully logged in. Welcome back!");
            }
        } else {
            // Handle the case where member or additionalInfo is missing

            if ($user->role_id != 1) {
                Auth::logout();
                return redirect()->route('login')->with("error", "Account details are incomplete. Please contact support.");
            }
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
