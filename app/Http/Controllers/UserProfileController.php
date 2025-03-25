<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user(); 
        return view('info.index', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('info.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|numeric',
            'birthday' => 'nullable|date',
            'gender' => 'nullable|string'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'gender' => $request->gender
        ]);

        return redirect()->route('profile.show')->with('success', 'Cập nhật thông tin thành công!');
    }
}
