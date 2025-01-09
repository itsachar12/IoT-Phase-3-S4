@extends('layout.mainLayout')

@section('title', 'Profile')

@section('content')

    <div class="max-w-4xl mx-auto bg-green-100 shadow-md rounded-lg p-6 space-y-8 mt-32">
        <!-- Header Section -->
        <div class="text-center">
            <h1 class="text-2xl font-bold text-gray-700">Your Profile</h1>
            <p class="text-sm text-gray-500">Manage your personal information and settings.</p>
        </div>

        <!-- Profile Picture Section -->
        <div class="flex flex-col items-center space-y-4">
            <div class="w-32 h-32 bg-gray-300 rounded-full flex items-center justify-center overflow-hidden shadow-lg">
                @if (Auth::user()->picture)
                    <img src="{{ asset('ProfilePicture/' . auth()->user()->picture) }}" alt="User Picture" class="w-full h-full object-cover">
                @else
                    <img src="{{ asset('ProfilePicture/' . 'default-profile-picture.jpg') }}" alt="User Picture">
                @endif
            </div>
            <div class="flex space-x-4">
                <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                    class="flex items-center px-4 py-2 bg-green-100 text-green-600 border border-green-600 rounded-lg font-medium hover:bg-green-600 hover:text-white hover:cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Change Picture
                </button>
                <a href="{{ route('profile.delete') }}" onclick="return confirm('Are you sure you want to delete your profile picture?')"
                    class="flex items-center px-4 py-2 bg-red-100 text-red-600 border border-red-600 rounded-lg font-medium hover:bg-red-600 hover:text-white hover:cursor-pointer">
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
            @if (session('sukses'))
                <div class="text-green-600 bg-green-300 p-3 rounded-lg">{{ session('sukses') }}</div>
            @endif

            @if ($errors->any())
                <div class="text-red-600 bg-red-300 p-3 rounded-lg">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <h2 class="text-lg font-bold text-gray-700 ">Edit Profile</h2>
            <form action="{{ route('profile.update') }}" method="POST" class="mt-4 space-y-6">
                @csrf
                @method('PATCH')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <input type="text" name="username" placeholder="New Username"
                        class="w-full px-4 py-2 border border-gray-300 text-slate-400 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none"
                        required value="{{ Auth::user()->username }}">
                    <input type="email" name="email" placeholder="New Email..."
                        class="w-full px-4 py-2 border border-gray-300 text-slate-400 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none"
                        required value="{{ Auth::user()->email }}">
                    <input type="password" name="password" placeholder="New Password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none"
                        minlength="8">
                    <input type="password" name="password_confirmation" placeholder="Confirm Password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none"
                        minlength="8">
                </div>
                <button type="submit"
                    class="w-1/2 mx-auto block px-4 py-2 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700">
                    Update Profile
                </button>
            </form>
        </div>
    </div>

    <!-- Change Picture Modal -->
    <div id="crud-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Change Profile Picture
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form class="p-4 md:p-5" action="{{ route('profile.picture') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="grid gap-4 mb-4">
                        <div class="col-span-1">
                            <label for="picture" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">File Picture</label>
                            <input type="file" name="picture" id="picture"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                required>
                        </div>
                        <button type="submit"
                            class="text-white w-1/2 mx-auto inline-flex  bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            Change Profile Picture
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
