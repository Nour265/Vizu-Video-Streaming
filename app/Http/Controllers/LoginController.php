<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    if (Auth::attempt($credentials)) {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Welcome Admin!');
        }
        return redirect()->route('home')->with('success', 'Welcome back!');
    }

    return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
}
public function logout()
{
    Auth::logout();
    return redirect()->route('home')->with('success', 'Logged out successfully.');
}
}
