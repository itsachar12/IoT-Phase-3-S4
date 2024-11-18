@extends('layout.emissions')

@section('title', 'Aplikasi GX DOJO')

@section('content')

<div class="relative bg-green-50 min-h-screen w-screen">
    <div class="relative z-20 text-center py-8">
        <h1 class="text-4xl font-extrabold text-black">CARBON EMITTER</h1>
    </div>

    <!-- Content Section -->
    <div class="container mx-auto lg:pl-72 py-10 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-12 gap-x-8">
            <!-- Diesel Footprint -->
            <div class="bg-red-50 shadow-md rounded-lg p-6 text-center">
                <div class="relative flex flex-col items-center">
                    <div class="bg-red-400 rounded-full w-36 h-48 flex items-center justify-center shadow-lg">
                        <p class="text-white text-center font-semibold">Predicted<br>52.9 kg CO2e</p>
                    </div>
                    <div class="w-1 h-8 bg-gray-500"></div>
                    <p class="mt-4 text-sm">Used</p>
                    <p class="text-2xl font-bold">52.9 kg CO2e</p>
                    <p class="mt-2 text-gray-600">Total Energy Used: <span class="font-bold">3 kWh</span></p>
                </div>
            </div>

            <!-- Gas Engine Footprint -->
            <div class="bg-red-50 shadow-md rounded-lg p-6 text-center">
                <div class="relative flex flex-col items-center">
                    <div class="bg-red-400 rounded-full w-36 h-48 flex items-center justify-center shadow-lg">
                        <p class="text-white text-center font-semibold">Predicted<br>100 kg CO2e</p>
                    </div>
                    <div class="w-1 h-8 bg-gray-500"></div>
                    <p class="mt-4 text-sm">Used</p>
                    <p class="text-2xl font-bold">100 kg CO2e</p>
                    <p class="mt-2 text-gray-600">Total Energy Used: <span class="font-bold">10 kWh</span></p>
                </div>
            </div>

            <!-- PLN Footprint -->
            <div class="bg-red-50 shadow-md rounded-lg p-6 text-center">
                <div class="relative flex flex-col items-center">
                    <div class="bg-red-400 rounded-full w-36 h-48 flex items-center justify-center shadow-lg">
                        <p class="text-white text-center font-semibold">Predicted<br>22 kg CO2e</p>
                    </div>
                    <div class="w-1 h-8 bg-gray-500"></div>
                    <p class="mt-4 text-sm">Used</p>
                    <p class="text-2xl font-bold">22 kg CO2e</p>
                    <p class="mt-2 text-gray-600">Total Energy Used: <span class="font-bold">3 kWh</span></p>
                </div>
            </div>

            <!-- Panel Surya Footprint -->
            <div class="bg-green-50 shadow-md rounded-lg p-6 text-center">
                <div class="relative flex flex-col items-center">
                    <div class="bg-green-400 rounded-full w-36 h-48 flex items-center justify-center shadow-lg">
                        <p class="text-white text-center font-semibold">Predicted<br>0.1 kg CO2e</p>
                    </div>
                    <div class="w-1 h-8 bg-gray-500"></div>
                    <p class="mt-4 text-sm">Used</p>
                    <p class="text-2xl font-bold">0.1 kg CO2e</p>
                    <p class="mt-2 text-gray-600">Total Energy Used: <span class="font-bold">1 Watt</span></p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
