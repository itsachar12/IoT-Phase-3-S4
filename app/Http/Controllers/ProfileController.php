<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile');
    }

    public function update(Request $request) 
    {
        // Validasi data yang dikirimkan
        $this->validate($request, [
            
            'username' => 'required|string|max:255',
            'password' => 'nullable|confirmed|min:6',
            'email' => 'required|email|max:255',
            'password_confirmation' => 'nullable'
        ]);

        $user = User::findOrFail(Auth::user()->id);

        if($request['password'] === $request['password_confirmation']){
            $request['password'] = bcrypt($request['password']);

            $user->update($request->all());
            return back()->with('sukses', 'Success changed profile');  
        } else {
            return back()->with('error', 'Failed to update profile!');  
            
        }
        return back()->with('error', 'Failed to update profile!');  

    }
}
