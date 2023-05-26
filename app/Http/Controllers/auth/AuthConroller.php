<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthConroller extends Controller
{
    public function login_view() {
        return view('auth.login');
    }

    public function login_process(Request $request) {
        $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($request->except('_token'))) {
            return redirect()->route('admin.dashboard');
        } else {
            return back()->with(['failure' => 'Invalid Combination!']);
        }
    }

    public function logout () {
        Auth::logout();
        return redirect()->route('login');
    }
}
