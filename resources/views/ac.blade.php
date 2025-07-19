@extends('layout.mainLayout')

@section('title', 'AC ')


@section('content')

    <div class="flex h-auto  flex-col bg-green-100 min-h-screen p-8 mt-20 ml-64 ">
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
                <h2 class="text-xl font-bold mb-4">List Fan</h2>
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
                <h2 class="text-xl font-bold text-center mb-6">Fan Control</h2>

                <!-- Wrapper Flex untuk menyusun elemen horizontal -->
                <div class="flex justify-between items-center  p-4  ">

                    <!-- Temperature Control -->
                    <!-- <div
                        class="flex justify-center flex-wrap items-center gap-2.5 p-4 border border-gray-300 rounded-lg bg-white max-w-52">
                        <button onclick="updateDegree(-1)"
                            class="w-10 h-10 border border-gray-300 rounded-lg bg-gray-100 flex justify-center items-center cursor-pointer ">
                            <i class="fa-solid fa-minus text-red-500 text-lg"></i>
                        </button>
                        <span class="text-xl font-bold text-gray-800 px-1" id="displayDegree">
                            {{ $selectedAc->degree }}°C
                        </span>
                        <button onclick="updateDegree(+1)"
                            class="w-10 h-10 border border-gray-300 rounded-lg bg-gray-100 flex justify-center items-center cursor-pointer">
                            <i class="fa-solid fa-plus text-green-500 text-lg"></i>
                        </button>


                        <form action="{{ route('ac.degree', $selectedAc->id_appliances) }}" id="acDegree" method="post">
                            @csrf
                            @method('PATCH')
                            <input class="hidden" type="number" name="degree" id="inputDegree"
                                value="{{ $selectedAc->degree }}">
                            <button type="submit"
                                class="p-1 font-semibold text-slate-500  hover:bg-green-300 text-sm border-2 rounded-lg shadow border-green-300  ">Change
                            </button>
                        </form>

                    </div> -->

                    {{-- ? SCRIPT SUHU AC --}}
                    <!-- <script>
                        let degree = {{ $selectedAc->degree }}; // Suhu awal dari server

                        function updateDegree(angka) {
                            degree += angka; // Tambah atau kurangi suhu
                            document.getElementById('displayDegree').innerText = degree + "°C"; // Perbarui tampilan
                            document.getElementById('inputDegree').value = degree; // Perbarui nilai input hidden
                        }
                    </script> -->

                    <!-- Speed Fan Control -->
                    <div class="text-center flex flex-col justify-center items-center ">
                        <h2 class="text-lg font-medium mb-2">Speed Fan</h2>
                        <div class="flex gap-2">

                            <form action="{{ route('ac.speed', $selectedAc->id_appliances) }}" method="post">
                                @csrf
                                @method('PATCH')

                                <button type="submit" name="speed_fan" value="SLOW"
                                    class="w-20 p-2 text-sm border rounded-lg 
                                {{ $selectedAc->speed_fan === 'SLOW' ? 'bg-gray-800 text-white' : 'bg-gray-100' }}
                                hover:bg-gray-200">
                                    SLOW
                                </button>
                                <button type="submit" name="speed_fan" value="NORMAL"
                                    class="w-20 p-2 text-sm border rounded-lg 
                                {{ $selectedAc->speed_fan === 'NORMAL' ? 'bg-gray-800 text-white' : 'bg-gray-100' }} ">
                                    NORMAL
                                </button>
                                <button type="submit" name="speed_fan" value="FAST"
                                    class="w-20 p-2 text-sm border rounded-lg  
                                {{ $selectedAc->speed_fan === 'FAST' ? 'bg-gray-800 text-white *:' : 'bg-gray-100' }} hover:bg-gray-200">
                                    FAST
                                </button>


                            </form>
                             
                        </div>
                    </div>

                    <!-- ON/OFF Button -->
                    @if (session('suksesAlert'))
                        <div>
                            <script>
                                alert(" {{ session('suksesAlert') }} ")
                            </script>
                        </div>
                    @endif
                   <form action="/control-kipas" method="POST" id="controlkipas">
                    @csrf
                    {{-- Ganti status kipas --}}
                    <input type="hidden" name="status" id="statusKipasInput" value="">
                    {{-- Command untuk MQTT --}}
                    <input type="hidden" name="command" id="commandKipasInput" value="">
                    <input type="hidden" name="id_appliances" value="{{ $selectedAc->id_appliances }}">

                    <button 
                        type="submit" 
                        class="flex items-center rounded-full border border-gray-300 bg-gray-100 p-1 w-36"
                        onclick="toggleKipasCommand(event)"
                    >
                        <div class="flex-1 py-2 text-sm font-medium rounded-full 
                            {{ $selectedAc->status === 'Active' ? 'bg-green-500 text-white' : 'bg-transparent' }}">
                            ON
                        </div>
                        <div class="flex-1 py-2 text-sm font-medium text-gray-700 rounded-full
                            {{ $selectedAc->status === 'Inactive' ? 'bg-red-500 text-white' : 'bg-transparent' }}">
                            OFF
                        </div>
                    </button>
                </form>

                <script>
                    function toggleKipasCommand(event) {
                        event.preventDefault();

                        const statusNow = "{{ $selectedAc->status }}";
                        const nextCommand = statusNow === "Active" ? "kipas off" : "kipas on";
                        const nextStatus = nextCommand === "kipas on" ? "Active" : "Inactive";

                        // Set nilai input hidden
                        document.getElementById('commandKipasInput').value = nextCommand;
                        document.getElementById('statusKipasInput').value = nextStatus;

                        // Submit form
                        document.getElementById('controlkipas').submit();

                        // Update ke DB (opsional kalau form udah ngurusin)
                        fetch(`/appliances/{{ $selectedAc->id_appliances }}/status`, {
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
                                    <td class="p-3 border text-center">{{ $item->time_start }} to
                                        {{ $item->time_end }}
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
    </div>
@endsection
