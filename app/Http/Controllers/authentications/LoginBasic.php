<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

            // Check if the user's account is expired
            if ($user->isExpired()) {
                Auth::logout(); // Log out the user
                return redirect()->route('login')->with("error", "Your account has expired. Please contact Pioneers SA.");
            }

            // If not expired, redirect to the homepage with success message
            return redirect("/")->with("success", "You have successfully logged in. Welcome back!");
        }

        // If authentication fails, redirect back with an error message
        return redirect()->back()->with("error", "Login failed. Please check your credentials and try again.")->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with("success", "You have been logged out. Please sign in again to continue.");
    }
}
