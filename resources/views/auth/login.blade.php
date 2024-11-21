@extends('layout.login')

@section('title', 'Aplikasi GX DOJO')

@section('content')

<div class="flex h-screen w-screen items-center justify-center bg-white">
    <div class="flex shadow-md h-full w-full bg-gradient-to-r from-lime-900 to-green-700">
        
        <!-- Bagian Gambar -->
        <div class="w-1/2">
            <img src="{{ url('/image/g2.jpg') }}" alt="Side Image" class="object-cover h-full w-full">
        </div>
        
        <!-- Bagian Form Login -->
        <div class="w-1/2 p-8 flex items-center justify-center">
            <div class="p-8 rounded-lg w-full max-w-md">
                <div class="text-center mb-8">
                    <img src="{{ url('/image/g1.png') }}" class="mx-auto h-12 mb-4" alt="GX DOJO Logo">
                    <h1 class="text-4xl font-extrabold text-gray-900">GX DOJO</h1>
                    <p class="text-lg font-semibold text-white tracking-wide">Green Energy System</p>
                </div>

                <form action="{{ route('login.tes') }}" method="POST" >
                    @csrf
                    <div class="mb-6 font-semibold ">
                        @if($errors->has('loginGagal'))
                            <div class="error  text-red-600 bg-red-300 p-3 rounded-lg">{{ $errors->first('loginGagal') }}</div>
                        @endif
                    </div>
                    <div class="mb-6">
                        <label for="username" class="block font-semibold text-white mb-2">Username</label>
                        <input type="text" name="username" id="username" placeholder="Enter Username..." class="w-full px-4 py-2 rounded-lg shadow-md bg-white text-gray-600 font-semibold placeholder-gray-500 focus:outline-none border-none" required>
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block font-semibold text-white mb-2">Password</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" placeholder="Enter Password.." class="w-full px-4 py-2 rounded-lg shadow-md bg-white text-gray-600 font-semibold placeholder-gray-500 focus:outline-none border-none" required>
                            <button type="button" onclick="togglePassword()" class="absolute right-3 top-1/2 transform -translate-y-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center mb-6">
                        <input type="checkbox" id="remember" class="w-4 h-4 rounded shadow-md border-gray-300 bg-white text-green-600 focus:ring-green-500">
                        <label for="remember" class="ml-2 font-semibold text-white">Remember me</label>
                    </div>

                    <div class="flex items-center justify-center">
                        <button class="w-64 bg-gray-800 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg" type="submit">
                            LOGIN
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        var passwordInput = document.getElementById("password");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    }
</script>

@endsection
