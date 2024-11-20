@extends('layout.appliences')

@section('title', 'Aplikasi GX DOJO')

@section('content')

<div class="flex h-screen w-screen flex-col bg-green-100 min-h-screen p-8 mt-20 ml-64">
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3 w-full max-w-screen-xl">

        <!-- Appliances Active -->
        <div class="bg-white rounded-lg shadow-md p-4 flex justify-between items-center lg:col-span-1">
            <div>
                <h2 class="text-lg font-semibold text-gray-700">Appliances Active</h2>
                <p class="text-sm text-gray-500">
                    <span class="text-green-500 font-bold">123</span> out of 654 Appliances in Active
                </p>
            </div>
            <div class="flex items-center">
                <i class="fa-solid fa-ellipsis-vertical text-gray-800"></i>
            </div>
        </div>

        <!-- Details (Power, Air Conditioner, Lightbulb) -->
        <div class="bg-white rounded-lg shadow-md p-4 flex justify-around items-center lg:col-span-2">
            <!-- Power -->
            <div class="flex items-center space-x-4">
                <i class="fa-solid fa-bolt text-3xl text-gray-800"></i>
                <span class="text-sm font-medium text-gray-700">400 Watts</span>
            </div>

            <!-- Air Conditioner Active -->
            <div class="flex items-center space-x-4">
                <img src="{{ url('/image/g3.png') }}" class="w-8 h-8 object-contain" alt="Air Conditioner">
                <span class="text-sm font-medium text-gray-700">
                    <span class="text-green-500 font-bold">12</span>/23 Actives
                </span>
            </div>

            <!-- Lightbulb Active -->
            <div class="flex items-center space-x-4">
                <i class="fa-solid fa-lightbulb text-gray-800 text-3xl"></i>
                <span class="text-sm font-medium text-gray-700">
                    <span class="text-green-500 font-bold">86</span>/89 Actives
                </span>
            </div>
        </div>

        <!-- Appliances List -->
        <div class="bg-white rounded-lg shadow-md p-6 lg:col-span-1">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Appliances Lists</h2>
            <p class="text-sm text-gray-500 mb-4">Daily Usage</p>

            <!-- Item: Air Conditioner -->
            <div class="flex items-center justify-between p-3 bg-gray-100 rounded-xl mb-3 hover:bg-gray-200 transition">
                <div class="flex items-center space-x-4">
                    <img src="{{ url('/image/g3.png') }}" class="w-8 h-8 object-contain" alt="Air Conditioner">
                    <div>
                        <p class="text-base font-medium text-gray-700">Air Conditioner</p>
                        <p class="text-xs text-gray-500">23 Units | 48kWh</p>
                    </div>
                </div>
                <a href="/ac" class="text-blue-500">
                    <i class="fa-solid fa-arrow-right text-blue-500 text-2xl"></i>
                </a>
            </div>

            <!-- Item: Lights -->
            <div class="flex items-center justify-between p-3 bg-gray-100 rounded-xl hover:bg-gray-200 transition">
                <div class="flex items-center space-x-4">
                    <i class="fa-solid fa-lightbulb text-3xl text-gray-800"></i>
                    <div>
                        <p class="text-base font-medium text-gray-700">Lights</p>
                        <p class="text-xs text-gray-500">100 Units | 15kWh</p>
                    </div>
                </div>
                <a href="/light" class="text-blue-500">
                    <i class="fa-solid fa-arrow-right text-blue-500 text-2xl"></i>
                </a>
            </div>
        </div>
       
        <!-- Schedule -->
        <div class="bg-white rounded-lg shadow-md p-6 lg:col-span-2">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Schedule</h2>

            <!-- Info Bar -->
            <div class="flex items-center bg-gray-200 p-4 rounded-lg mb-6">
                <svg class="w-8 h-8 text-green-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <p class="text-lg font-semibold ml-4">You Created 4 Schedule</p>
                <span class="text-sm text-gray-600 ml-auto">3 Appliances are in use</span>
            </div>

            <!-- Schedule Items -->
            <div class="space-y-4">
                <!-- Item 1 -->
                <div class="flex items-center justify-between bg-gray-100 p-4 rounded-lg hover:bg-gray-200 transition">
                    <div>
                        <p class="text-lg font-semibold">South AC, Main Room It 1</p>
                        <p class="text-sm text-gray-500">Active 07:00 AM - 11:30 AM</p>
                        <p class="text-sm text-gray-500">Daily</p>
                    </div>
                    <div class="flex space-x-6">
                        <a href="#" class="text-orange-600 font-semibold">Edit</a>
                        <a href="#" class="text-red-600 font-semibold">Delete</a>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="flex items-center justify-between bg-gray-100 p-4 rounded-lg hover:bg-gray-200 transition">
                    <div>
                        <p class="text-lg font-semibold">South AC, Main Room It 1</p>
                        <p class="text-sm text-gray-500">Active 07:00 AM - 11:30 AM</p>
                        <p class="text-sm text-gray-500">Once</p>
                    </div>
                    <div class="flex space-x-6">
                        <a href="#" class="text-orange-600 font-semibold">Edit</a>
                        <a href="#" class="text-red-600 font-semibold">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
