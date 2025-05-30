<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Show the user login form
    public function showLoginForm()
    {
        return view('fronts.user.login'); // Create this Blade view
    }

    // Handle user login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Add a role check (assuming role_id == 2 is for users)
        if (Auth::attempt(array_merge($credentials, ['role_id' => 2]), $request->filled('remember'))) {
            return redirect()->intended('/front/users');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials or unauthorized access.',
        ])->withInput($request->only('email'));
    }

    // Optional logout method
    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.login');
    }
}

