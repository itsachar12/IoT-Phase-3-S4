@extends('layout.mainLayout')


@section('title', 'Lights') <!-- Perbaikan di sini, lebih ringkas -->

@section('content')

    <div class="flex h-auto  flex-col bg-green-100 min-h-screen p-8 mt-20 ml-64">
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
                                        <span class="text-slate-600">{{ $item->electrical_power }}Wh</span>
                                    </p>
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

            </div>


            <!-- Light Control -->
            <div class="mb-8 bg-white p-6 rounded-lg shadow-md h-52
            ">
                <h2 class="text-xl font-bold text-center mb-6">Light Control</h2>

                <!-- Wrapper Flex untuk menyusun elemen horizontal -->
                <div class="flex justify-between items-center gap-5 p-4">
                    <!-- light Control -->
                    <div class="flex items-center justify-center w-full">
                        {{-- ? Kontainer bar lux --}}
                        <div class="relative w-full max-w-[700px] bg-gray-200 rounded-full h-12">
                            <!-- Bagian Kuning -->
                            <form action="{{ route('light.lux', $selectedLamp->id_appliances) }}" method="post">
                                @csrf
                                @method('PATCH')

                                <input type="range" name="lux" id="lux" min="0" max="100"
                                    value="{{ $selectedLamp->lux }}" oninput="updateLuxValue()"
                                    class="w-full h-12 bg-gradient-to-r from-yellow-100 via-yellow-300 to-yellow-400 rounded-full appearance-none focus:outline-none">
                                <div class="absolute flex justify-between inset-0  items-center px-2 pointer-events-none">
                                    <span class="text-sm font-medium text-gray-500">0%</span>
                                    <span class="text-sm font-medium text-gray-500">25%</span>
                                    <span class="text-sm font-medium text-gray-500">50%</span>
                                    <span class="text-sm font-medium text-gray-500">75%</span>
                                    <span class="text-sm font-medium text-gray-500">100%</span>
                                </div>
                                <div class="w-full flex justify-between items-center  absolute mt-3 px-5">
                                    <p class="text-lg text-slate-600 flex items-center">Current Lux :
                                        <span class="text-lg font-bold text-slate-700 items-center ml-2">
                                            {{ $selectedLamp->lux }}%</span>
                                    </p>
                                    <button type="submit"
                                        class=" p-1  font-semibold text-slate-600 hover:bg-green-300 text-lg border-2 rounded-lg shadow border-green-300 ">Change
                                    </button>
                                    <p class="text-lg text-slate-600 flex items-center">to Lux :
                                        <span id="luxpreview" class="text-lg font-bold text-slate-700 items-center ml-2">
                                            {{ $selectedLamp->lux }}%</span>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- ? Script ubah range lux --}}
                    <script>
                        function updateLuxValue() {
                            const nilaiLuxSlider = document.getElementById('lux');
                            const luxPreview = document.getElementById('luxpreview');
                            luxPreview.textContent = nilaiLuxSlider.value + "%";
                        }
                    </script>

                    <!-- ON/OFF Button -->
                    @if (session('sukses'))
                        <div>
                            <script>
                                alert(" {{ session('sukses') }} {{ $selectedLamp->status }} {{ $selectedLamp->name }} ")
                            </script>
                        </div>
                    @endif
                              <form action="/control" method="POST" id="controlForm">
                                @csrf
                                <input type="hidden" name="id_appliances" value="{{ $selectedLamp->id_appliances }}">
                                <input type="hidden" name="command" id="commandInput" value="">

                                <button 
                                    type="submit" 
                                    class="flex items-center rounded-full border border-gray-300 bg-gray-100 p-1 w-36"
                                    onclick="toggleCommand(event)"
                                >
                                    <div class="flex-1 py-2 text-sm font-medium rounded-full 
                                        {{ $selectedLamp->status === 'Active' ? 'bg-green-500 text-white' : 'bg-transparent' }}">
                                        ON
                                    </div>
                                    <div class="flex-1 py-2 text-sm font-medium text-gray-700 rounded-full
                                        {{ $selectedLamp->status === 'Inactive' ? 'bg-red-500 text-white' : 'bg-transparent' }}">
                                        OFF
                                    </div>
                                </button>
                            </form>

                            {{-- ✅ Taruh script di bawah form --}}
                            <script>
                                function toggleCommand(event) {
                                    event.preventDefault();

                                    const statusNow = "{{ $selectedLamp->status }}";
                                    const nextCommand = statusNow === "Active" ? "lampu 1 off" : "lampu 1 on";
                                    const nextStatus = nextCommand === "lampu 1 on" ? "Active" : "Inactive";

                                    // MQTT
                                    document.getElementById('commandInput').value = nextCommand;
                                    document.getElementById('controlForm').submit();

                                    // DB update
                                    fetch(`/appliances/{{ $selectedLamp->id_appliances }}/status`, {
                                        method: 'PATCH',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        body: JSON.stringify({ status: nextStatus })
                                    }).then(response => {
                                        if (response.ok) {
                                            console.log('Status DB updated');
                                        } else {
                                            console.error('Failed update DB');
                                        }
                                    });
                                }
                            </script>

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
                                    <td class="p-3 border text-center">{{ $item->time_start }} to {{ $item->time_end }}
                                    </td>
                                    <td
                                        class="p-3 border text-center 
                                    {{ $item->status === 'Active' ? 'text-green-600' : 'text-red-600' }}
                                    ">
                                        {{ $item->status }}</td>
                                    <td class="p-3 border text-center">{{ $item->repeat_schedule }}</td>
                                    <!-- Ikon Edit dan Hapus -->
                                    <td class="p-3 border text-center space-x-4">
                                        <a href="{{ route('schedule.edit', $item->id_schedule) }}"
                                            class="text-blue-500 hover:text-blue-700">
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
