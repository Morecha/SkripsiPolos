<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function authenticating(Request $request){

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            if(Auth::user()->status == 'aktif'){
                $request->session()->regenerate();
                return redirect()->intended('dashboard');
            }else{
                return back()->withErrors([
                   'email' => 'anggota tidak aktif'
                ]);
            }
        }
        return back()->withErrors([
            'email' => 'there is somethings wrong with your email or password',
        ])->onlyInput('email');
    }


    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

}
