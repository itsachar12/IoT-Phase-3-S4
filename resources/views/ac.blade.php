@extends('layout.ac')

@section('title', 'Aplikasi GX DOJO')

@section('content')

    <div class="flex h-auto w-screen flex-col bg-green-100 min-h-screen p-8 mt-20 ml-64 ">
        <div class="grid gap-2 w-full max-w-5xl">
            <!-- Back Button -->
                <div class="mb-4">
                    <a href="/appliences"
                        class="text-blue-500 px-4 py-2 rounded-lg border border-blue-500 hover:bg-blue-500 hover:text-white transition">
                        Back
                    </a>
                </div>

            <!-- List Air Conditioner -->
            <div class="mb-8 bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-bold mb-4">List Air Conditioner</h2>
                <div class="grid grid-cols-2 gap-4">
                    <!-- ? card list ac -->
                    @foreach ($acList as $item)
                        <a href="{{ route('ac', ['id_appliances' => $item->id_appliances]) }}">
                            <div
                                class="flex items-center p-4 border rounded-lg 
                            {{ $selectedAc->id_appliances === $item->id_appliances ? ' shadow-lg bg-green-100' : '' }}   hover:bg-green-100 border-green-300">
                                <div class="mr-4">
                                    <img src="{{ url('/image/g3.png') }}" class="w-12 h-12 object-contain"
                                        alt="Air Conditioner">
                                </div>
                                <div>
                                    <h3 class="font-semibold text-lg">{{ $item->name }}</h3>
                                    <p class="text-sm font-medium">
                                        @php
                                            if ($item->status === 'Active') {
                                                echo '<span class="text-green-600">' . $item->status . '</span>';
                                            } else {
                                                echo '<span class="text-red-600">' . $item->status . '</span>';
                                            }
                                        @endphp
                                        |
                                        <span class="text-slate-600">{{ $item->electrical_power }}kWh</span>
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach

                </div>
            </div>


            <!-- AC Control -->
            <div class="mb-8 bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-bold text-center mb-6">AC Control</h2>

                <!-- Wrapper Flex untuk menyusun elemen horizontal -->
                <div class="flex justify-between items-center gap-5 p-4">
                    <!-- Temperature Control -->
                    <div class="flex justify-center items-center gap-2.5 p-4 border border-gray-300 rounded-lg bg-white">
                        <!-- Button Minus -->
                        <button
                            class="w-12 h-12 border border-gray-300 rounded-lg bg-gray-100 flex justify-center items-center cursor-pointer">
                            <i class="fa-solid fa-minus text-red-500 text-lg"></i>
                        </button>
                        <!-- Temperature Display -->
                        <span class="text-2xl font-bold text-gray-800 px-5">
                            {{ $selectedAc->degree }}°C
                        </span>
                        <!-- Button Plus -->
                        <button
                            class="w-12 h-12 border border-gray-300 rounded-lg bg-gray-100 flex justify-center items-center cursor-pointer">
                            <i class="fa-solid fa-plus text-green-500 text-lg"></i>
                        </button>
                    </div>

                    <!-- Speed Fan Control -->
                    <div class="text-center flex flex-col justify-center items-center">
                        <h2 class="text-lg font-medium mb-2">Speed Fan</h2>
                        <div class="flex gap-2.5">
                            <button
                                class="w-24 px-6 py-2 text-sm border rounded-lg 
                            {{ $selectedAc->speed_fan === 'SLOW' ? 'bg-gray-800 text-white' : 'bg-gray-100' }}
                            hover:bg-gray-200">
                                SLOW
                            </button>
                            <button
                                class="w-24 px-6 py-2 text-sm border rounded-lg 
                            {{ $selectedAc->speed_fan === 'NORMAL' ? 'bg-gray-800 text-white' : 'bg-gray-100' }} ">
                                NORMAL
                            </button>
                            <button
                                class="w-24 px-6 py-2 text-sm border rounded-lg  
                            {{ $selectedAc->speed_fan === 'FAST' ? 'bg-gray-800 text-white *:' : 'bg-gray-100' }} hover:bg-gray-200">
                                FAST
                            </button>
                        </div>
                    </div>

                    <!-- ON/OFF Button -->
                    <div class="flex items-center rounded-full border border-gray-300 bg-gray-100 p-1 w-36 ">
                        <!-- Tombol ON -->
                        <button
                            class="flex-1 py-2 text-sm font-medium   rounded-full 
                        {{ $selectedAc->status === 'Active' ? 'bg-green-500 text-white' : 'bg-transparent' }}">
                            ON
                        </button>
                        <!-- Tombol OFF -->
                        <button
                            class="flex-1 py-2 text-sm font-medium text-gray-700  rounded-full
                        {{ $selectedAc->status === 'Inactive' ? 'bg-red-500 text-white' : 'bg-transparent' }}">
                            OFF
                        </button>
                    </div>
                </div>
            </div>


            <!-- Schedule -->
            <div class="mb-8 bg-white p-6 rounded-lg shadow-md">
                <div>
                    <h2 class="text-xl font-bold text-center mb-4">Schedule</h2>
                    <!-- Tombol Add Schedule dengan jarak -->
                    @if (session('error'))
                        <div class="error  text-red-600 bg-red-300 p-3 rounded-lg">
                            {{ session('error') }}</div>
                    @endif
                    @if (session('sukses'))
                        <div class="error  text-green-800 bg-green-300 p-3 rounded-lg mb-2 font-bold ">
                            {{ session('sukses') }} !!</div>
                    @endif
                    <div class="mt-6 text-right">
                        <a href="{{ route('schedule.add') }}"
                            class="px-5 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
                            + Add Schedule
                        </a>
                    </div>
                    <!-- Tabel Schedule -->
                    <table class="w-full mt-4 text-sm border-collapse border border-gray-300">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="p-3 border">No</th>
                                <th class="p-3 border">Description</th>
                                <th class="p-3 border">Time</th>
                                <th class="p-3 border">Status</th>
                                <th class="p-3 border">Repeat</th>
                                <th class="p-3 border">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schList as $item)
                                <tr>
                                    <td class="p-3 border text-center">{{ 1 }}</td>
                                    <td class="p-3 border">{{ $item->name_appliance }}</td>
                                    <td class="p-3 border text-center">{{ $item->time_start }} to {{ $item->time_end }}
                                    </td>
                                    <td class="p-3 border text-center text-green-600">{{ $item->status }}</td>
                                    <td class="p-3 border text-center">{{ $item->repeat_schedule }}</td>
                                    <!-- Ikon Edit dan Hapus -->
                                    <td class="p-3 border text-center space-x-4">
                                        <button class="text-blue-500 hover:text-blue-700">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                        <form action="{{ route('schedule.delete', $item->id_schedule) }}" method="post"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-500 hover:text-red-700" type="submit"
                                                onclick="return confirm('Are You Sure Want to Delete this Schedule? ') ">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
