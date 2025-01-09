<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

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
            'username' => 'required|string|max:15|min:3|regex:/^[a-zA-Z0-9]+$/|unique:users,username,' . Auth::user()->id, // Pastikan username unik
            'email' => [
                'required',
                'email',
                'max:255',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', // Pastikan ada domain setelah '@'
                'unique:users,email,' . Auth::user()->id,
            ],
            'password' => 'nullable|confirmed|min:8|max:15', // Password optional, hanya diperlukan jika diubah
            'password_confirmation' => 'nullable' // Pastikan password_confirmation ada jika password diisi
        ]);

        $user = User::findOrFail(Auth::user()->id);

        // Update username dan email jika ada perubahan
        if ($request->has('username')) {
            $user->username = $request->username;
        }

        if ($request->has('email')) {
            $user->email = $request->email;
        }

        // Update password jika ada perubahan password dan konfirmasi yang valid
        if ($request->has('password') && $request->password === $request->password_confirmation) {
            $user->password = bcrypt($request->password); // Enkripsi password baru
        }

        // Simpan perubahan data
        $user->save();

        return back()->with('sukses', 'Profile updated successfully!');
    }

    public function updatePic(Request $request)
    {
        $request->validate([
            'picture' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $user = User::findOrFail(Auth::user()->id);

        // hapus foto lama jika ada
        if ($user->picture && File::exists(public_path('ProfilePicture/' . $user->picture))) {
            File::delete(public_path('ProfilePicture/' . $user->picture));
        }

        $file = $request->file('picture');  
        $ext = $file->getClientOriginalExtension();
        $fileName = $user->username . $user->id . '_' . now()->format('dmY') . '.' . $ext; // Buat nama unik
        $file->move(public_path('ProfilePicture'), $fileName);

        $user->update([
            'picture' => $fileName,
        ]);

        return redirect()->back()->with('sukses', 'Picture updated successfully.');
    }

    public function pictureDel()
    {
        $user = User::findOrFail(Auth::user()->id);
        $user->picture = null;
        $user->save();

        return redirect()->back()->with('sukses', 'Picture removed successfully.');
    }
}
