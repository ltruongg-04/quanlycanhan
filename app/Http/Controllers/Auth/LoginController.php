<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['name' => $request->name, 'password' => $request->password])) {
            return redirect()->route('home')->with('success', 'Đăng nhập thành công!');
        }

        return back()->withErrors(['name' => 'Tên đăng nhập hoặc mật khẩu không đúng.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Bạn đã đăng xuất.');
    }
}