<?php

namespace App\Http\Controllers;

use App\Models\LoginLog;

class LoginLogController extends Controller
{
    /**
     * Display the login logs view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('page.user-login-logs.index');
    }

    /**
     * Return login logs in JSON format for Tabulator.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function data()
    {
        // Fetch the login logs with user details
        $loginLogs = LoginLog::with('user')->orderBy('login_at', 'desc')->get();

        // Return the logs as a JSON response
        return response()->json($loginLogs);
    }
}
