@extends('layout.profile')

@section('title', 'Aplikasi GX DOJO')

@section('content')

<div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
    <!-- Profile Picture Section -->
    <div class="flex flex-col items-center space-y-4">
        <div class="w-32 h-32 bg-gray-300 rounded-full"></div> <!-- Placeholder Foto -->
        <div class="flex space-x-4">
            <button class="px-4 py-2 bg-green-100 text-green-600 border border-green-600 rounded-lg font-medium hover:bg-green-600 hover:text-white">
                Change Profile Picture
            </button>
            <button class="px-4 py-2 bg-red-100 text-red-600 border border-red-600 rounded-lg font-medium hover:bg-red-600 hover:text-white">
                Delete Profile Picture
            </button>
        </div>
    </div>

    <!-- Information Section -->
    <div class="mt-8 bg-gray-50 border border-gray-200 rounded-lg p-4">
        <h2 class="text-lg font-bold text-gray-700">Information</h2>
        <div class="mt-4 space-y-2">
            <div class="flex justify-between">
                <span class="font-medium text-gray-600">Username</span>
                <span class="text-gray-700">{{ session('username', 'Admin Mantap') }}</span>
            </div>
            <div class="flex justify-between">
                <span class="font-medium text-gray-600">Email</span>
                <span class="text-gray-700">{{ session('email', 'adminmantap@gmail.com') }}</span>
            </div>
        </div>
    </div>

    <!-- Edit Profile Section -->
    <div class="mt-8 bg-gray-50 border border-gray-200 rounded-lg p-4">
        <h2 class="text-lg font-bold text-gray-700">Edit Profile</h2>
        <form action="{{ route('profile.update') }}" method="POST" class="mt-4 space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="text" name="username" placeholder="New Username...." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                <input type="email" name="email" placeholder="New Email...." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                <input type="password" name="password" placeholder="New Password...." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <input type="password" name="password_confirmation" placeholder="Confirmation Password...." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <button type="submit" class="w-full px-4 py-2 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700">
                Edit
            </button>
        </form>

        @if(session('success'))
        <div class="mt-4 bg-green-100 text-green-700 border border-green-600 rounded-lg p-4">
            {{ session('success') }}
        </div>
        @endif
    </div>
</div>

@endsection
