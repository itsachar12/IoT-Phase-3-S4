@extends('layout.usage_by_room')

@section('title', 'Aplikasi GX DOJO')

@section('content')

    <div class="flex bg-green-100 min-h-auto h-screen w-auto flex-col items-center mt-20 ml-52">
        <div class="grid gap-6 w-full max-w-5xl mb-20">

            <!-- Lights Room -->
            <div class="relative mt-6 rounded-lg overflow-hidden shadow-lg bg-white">
                <a href="/room_light">
                    <img src="{{ url('/image/g5.jpg') }}" class="w-full h-44 lg:h-56 object-cover" alt="Lights Room">
                </a>
                <div class="absolute top-4 left-4 space-y-2">
                    {{-- <div class="flex items-center text-white bg-gray-800 bg-opacity-80 rounded-full px-4 py-1 text-sm">
                    <span class="material-icons mr-2">thermostat</span> 25°C
                </div> --}}
                    <div class="flex items-center text-white bg-gray-800 bg-opacity-80 rounded-full px-4 py-1 text-sm">
                        <span class="material-icons mr-2">bolt</span> {{ $lamp_power }}kWh
                    </div>
                </div>
                <div class="absolute bottom-4 right-4 text-white text-2xl font-bold drop-shadow-md">
                    Lights Room
                </div>
            </div>

            <!-- AC Room -->
            <div class="relative rounded-lg overflow-hidden shadow-lg bg-white">
                <a href="/room_ac">
                    <img src="{{ url('/image/g4.jpg') }}" class="w-full h-44 lg:h-56 object-cover" alt="AC Room">
                </a>
                <div class="absolute top-4 left-4 space-y-2">
                    <div class="flex items-center text-white bg-gray-800 bg-opacity-80 rounded-full px-4 py-1 text-sm">
                        <span class="material-icons mr-2">thermostat</span> {{ $ac_degree }}°C
                    </div>
                    <div class="flex items-center text-white bg-gray-800 bg-opacity-80 rounded-full px-4 py-1 text-sm">
                        <span class="material-icons mr-2">bolt</span> {{ $ac_power }}kWh
                    </div>
                </div>
                <div class="absolute bottom-4 right-4 text-white text-2xl font-bold drop-shadow-md">
                    AC Room
                </div>
            </div>

            <!-- Emission Room -->
            <div class="relative rounded-lg overflow-hidden shadow-lg bg-white">
                <a href="/emissions">
                    <img src="{{ url('/image/g6.jpg') }}" class="w-full h-44 lg:h-56 object-cover" alt="Emission Room">
                </a>
                <div class="absolute top-4 left-4 space-y-2">
                    {{-- <div class="flex items-center text-white bg-gray-800 bg-opacity-80 rounded-full px-4 py-1 text-sm">
                    <span class="material-icons mr-2">thermostat</span> 25°C
                </div> --}}
                    <div class="flex items-center text-white bg-gray-800 bg-opacity-80 rounded-full px-4 py-1 text-sm">
                        <span class="material-icons mr-2">bolt</span> {{ $em_power }}kWh
                    </div>
                </div>
                <div class="absolute bottom-4 right-4 text-white text-2xl font-bold drop-shadow-md">
                    Emission Room
                </div>
            </div>
        </div>
    </div>

@endsection
