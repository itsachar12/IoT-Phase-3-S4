@extends('layout.mainLayout')


@section('title', 'Emissions')

@section('content')

<div class="relative bg-green-100 min-h-screen w-screen">
    <!-- Judul Utama -->
    <div class="relative z-20 text-center py-8">
        <h1 class="text-4xl font-extrabold text-black">CARBON EMITTER</h1>
    </div>

    <!-- Content Section -->
    <div class="container mx-auto lg:pl-72 py-10 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-12 gap-x-8">

            <!-- Diesel Footprint -->

            @foreach ($emissions as $i)
            <div class="bg-white shadow-md rounded-lg p-6 text-center ">
                <h2 class="text-xl font-bold mb-4">{{ $i->name }}</h2>
                <div class="relative flex flex-col items-center">
                    <div class="relative {{ $i->status === 'Active' ? 'bg-green-500' : 'bg-red-500' }} rounded-full w-40 h-52 flex items-center justify-center shadow-lg">
                        <p class="text-white text-center font-semibold absolute top-5">Predicted<br>
                            {{ $i->predicted_emission }} kg CO2e</p>
                        <p class="text-white text-center font-bold">Used<br>{{ $i->emission }} kg CO2e</p>
                    </div>
                    <div class="w-1 h-8 bg-gray-500"></div>
                    <p class="mt-4 text-gray-600">Total Energy Used: <span class="font-bold">{{ $i->power }} kWh</span></p>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>

@endsection
