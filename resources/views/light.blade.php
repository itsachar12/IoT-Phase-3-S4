@extends('layout.light')

@section('title', 'Aplikasi GX DOJO') <!-- Perbaikan di sini, lebih ringkas -->

@section('content')

    <div class="flex h-auto w-screen flex-col bg-green-100 min-h-screen p-8 mt-20 ml-64">
        <div class="grid gap-2 w-full max-w-5xl">
            <!-- Back Button -->
            <div class="mb-4">
                <a href="/appliences"
                    class="text-blue-500 px-4 py-2 rounded-lg border border-blue-500 hover:bg-blue-500 hover:text-white transition">
                    Back
                </a>
            </div>

            <!-- List Lights -->
            <div class="mb-8 bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-bold mb-4">List Lights</h2>
                <div class="grid grid-cols-2 gap-4">
                    <!-- Light Room 1 -->
                    @foreach ($lightList as $item)
                        <a href="{{ route('light', ['id_appliances' => $item->id_appliances]) }}">
                            <div
                                class="flex items-center p-4 border-2 border-green-300 rounded-lg  hover:bg-green-100 
                        {{ $selectedLamp->id_appliances === $item->id_appliances ? ' shadow-lg bg-green-100' : '' }}">
                                <div class="mr-4">
                                    <i class="fa-solid fa-lightbulb text-3xl text-gray-800"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-lg">{{ $item->name }}</h3>
                                    <p class="text-sm text-green-600 font-medium">
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
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

            </div>


            <!-- Light Control -->
            <div class="mb-8 bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-bold text-center mb-6">Light Control</h2>

                <!-- Wrapper Flex untuk menyusun elemen horizontal -->
                <div class="flex justify-between items-center gap-5 p-4">
                    <!-- light Control -->
                    <div class="flex items-center justify-center w-full">
                        <!-- Kontainer Progress Bar -->
                        <div class="relative w-full max-w-[700px] bg-gray-200 rounded-full h-12">
                            <!-- Bagian Kuning -->
                            <div class="absolute left-0 top-0 h-12 bg-yellow-300 rounded-l-full flex items-center px-4"
                                style="width: 85%;">
                                <!-- Teks dan Garis Vertikal -->
                                <div class="flex w-full justify-between items-center">
                                    <span class="text-sm font-medium text-gray-600">25%</span>
                                    <div class="h-8 border-l border-gray-400"></div>
                                    <span class="text-sm font-medium text-gray-600">50%</span>
                                    <div class="h-8 border-l border-gray-400"></div>
                                    <span class="text-sm font-medium text-gray-600">75%</span>
                                </div>
                            </div>
                            <!-- Bagian Abu-Abu -->
                            <div class="absolute right-0 top-0 h-12 bg-gray-300 rounded-r-full flex items-center justify-center"
                                style="width: 15%;">
                                <span class="text-sm font-medium text-gray-600">100%</span>
                            </div>
                        </div>
                    </div>

                    <!-- ON/OFF Button -->
                    <div class="flex items-center rounded-full border border-gray-300 bg-gray-100 p-1 w-36">
                        <!-- Tombol ON -->
                        <button
                            class="flex-1 py-2 text-sm font-medium   rounded-full 
                        {{ $selectedLamp->status === 'Active' ? 'bg-green-500 text-white' : 'bg-transparent' }}">
                            ON
                        </button>
                        <!-- Tombol OFF -->
                        <button
                            class="flex-1 py-2 text-sm font-medium text-gray-700  rounded-full
                        {{ $selectedLamp->status === 'Inactive' ? 'bg-red-500 text-white' : 'bg-transparent' }}">
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
                                    <td class="p-3 border text-center">1</td>
                                    <td class="p-3 border">{{ $item->name_appliance }}</td>
                                    <td class="p-3 border text-center">{{ $item->time_start }} to {{ $item->time_end }}</td>
                                    <td class="p-3 border text-center 
                                    {{ $item->status === 'Active' ? 'text-green-600' : 'text-red-600' }}
                                    ">{{ $item->status }}</td>
                                    <td class="p-3 border text-center">{{ $item->repeat_schedule }}</td>
                                    <!-- Ikon Edit dan Hapus -->
                                    <td class="p-3 border text-center space-x-4">
                                        <a href="{{ route('schedule.edit', $item->id_schedule) }}" class="text-blue-500 hover:text-blue-700">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
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
    @endsection
