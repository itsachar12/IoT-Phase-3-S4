<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Appliances; // Tambahin di atas



class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

   public function login(Request $request)
{
    $dataLogin = $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    if (Auth::attempt($dataLogin)) {
        $request->session()->regenerate();
        Appliances::query()->update(['status' => 'Inactive']);

        return redirect()->intended('/')->with('sukses', 'Login Successful');
    } else {
        return back()->withErrors([
            'loginGagal' => 'Invalid Username or Password!',
        ]);
    }
}


    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}

