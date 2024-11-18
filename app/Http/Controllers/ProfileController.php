<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile');
    }

    public function update(Request $request)
    {
        // Validasi data yang dikirimkan
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'nullable|confirmed|min:6',
            'email' => 'required|email|max:255',
        ]);

        // Logika penyimpanan data (sesuaikan dengan database Anda)
        // Contoh: menyimpan ke sesi sebagai contoh sementara
        session(['username' => $validated['username'], 'email' => $validated['email']]);

        // Kembalikan respon ke halaman profil dengan pesan sukses
        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }
}
