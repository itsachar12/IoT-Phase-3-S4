@extends('layout.mainLayout')


@section('title', 'Aplikasi GX DOJO')

@section('content')

<div class="max-w-4xl mx-auto bg-green-100 shadow-md rounded-lg p-6 space-y-8 mt-32 ">
    <!-- Header Section -->
    <div class="text-center">
        <h1 class="text-2xl font-bold text-gray-700">Your Profile</h1>
        <p class="text-sm text-gray-500">Manage your personal information and settings.</p>
    </div>

    <!-- Profile Picture Section -->
    <div class="flex flex-col items-center space-y-4">
        <div class="w-32 h-32 bg-gray-300 rounded-full flex items-center justify-center">
            <span class="text-gray-400 text-sm">Photo</span>
        </div>
        <div class="flex space-x-4">
            <a  class="flex items-center px-4 py-2 bg-green-100 text-green-600 border border-green-600 rounded-lg font-medium hover:bg-green-600 hover:text-white hover:cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Change Picture
            </a>
            <a class="flex items-center px-4 py-2 bg-red-100 text-red-600 border border-red-600 rounded-lg font-medium hover:bg-red-600 hover:text-white hover:cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Delete Picture
            </a>
        </div>
    </div>

    <!-- Divider -->
    <div class="border-t border-gray-200"></div>

    <!-- Information Section -->
    <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
        <h2 class="text-lg font-bold text-gray-700">Information</h2>
        <div class="mt-4 space-y-4">
            <div class="flex justify-between items-center">
                <span class="font-medium text-gray-600">Username</span>
                <span class="text-gray-700">{{ Auth::user()->username }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="font-medium text-gray-600">Email</span>
                <span class="text-gray-700">{{ Auth::user()->email }}</span>
            </div>
        </div>
    </div>

    <!-- Divider -->
    <div class="border-t border-gray-200"></div>

    <!-- Edit Profile Section -->
    <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
        @if($errors->has('error'))
            <div class="error  text-red-600 bg-red-300 p-3 rounded-lg">{{ $errors->first('error') }}</div>
        @endif
        @if($errors->has('sukses'))
            <div class="error  text-red-600 bg-red-300 p-3 rounded-lg">{{ $errors->first('sukses') }}</div>
        @endif
        <h2 class="text-lg font-bold text-gray-700 ">Edit Profile</h2>
        <form action="{{ route('profile.update') }}" method="POST" class="mt-4 space-y-6" >
            @csrf
            @method('PATCH')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <input type="text" name="username" placeholder="New Username" class="w-full px-4 py-2 border border-gray-300 text-slate-400 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required value="{{ Auth::user()->username }}">
                <input type="email" name="email" placeholder="New Email..." class="w-full px-4 py-2 border border-gray-300 text-slate-400 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required value="{{ Auth::user()->email }}" >
                <input type="password" name="password" placeholder="New Password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" minlength="6" >
                <input type="password" name="password_confirmation" placeholder="Confirm Password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" minlength="6">
            </div>
            <button type="submit" class="w-1/2 mx-auto block px-4 py-2 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700">
                Update Profile
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
