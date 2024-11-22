<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


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
            // echo 'berhasil';
            $request->session()->regenerate();
            return redirect()->intended('/ ')->with('sukses', 'Login Successful');
        
        } else {

            return back()->withErrors([ 
                
                'loginGagal' => 'Invalid Username or Pssword!',
            ]);
        }

    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}

