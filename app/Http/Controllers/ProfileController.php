<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
            
            'username' => 'required|string|max:15|min:3|regex:/^[a-zA-Z0-9]+&/',
            'password' => 'nullable|confirmed|min:8|max:15',
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

    public function updatePic(Request $request){
        $request->validate([
            'picture' =>'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $user = User::findOrFail(Auth::user()->id);

        // hapus foto lama jika ada
        if ($user->picture && File::exists(public_path('ProfilePicture/' . $user->picture))) {
            File::delete(public_path('ProfilePicture/' . $user->picture));
        }

        $file = $request->file('picture');  
        $ext = $file->getClientOriginalExtension();
        $fileName = $user->username . $user->id . '_' . now()->format('dmY').'.'.$ext; // Buat nama unik
        $file->move(public_path('ProfilePicture'), $fileName);

        $user->update([
            'picture' => $fileName,
        ]);

        return redirect()->back()->with('success', 'Picture updated successfully.');
    }

    public function pictureDel(){

        $user = User::findOrFail(Auth::user()->id);
        $user->picture = null;
        $user->save();
        return redirect()->back()->with('success', 'Picture updated successfully.');
        
    }
}
