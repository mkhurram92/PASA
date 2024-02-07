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
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect("/")->with("success", "Logged in");
        }
        return redirect()->back()->with("error", "Invalid login")->withInput();
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with("success", "Logged out");
    }
}
