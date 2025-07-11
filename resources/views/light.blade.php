@extends('layout.mainLayout')

@section('title', 'Lights')

@section('content')
    <div class="flex h-auto flex-col bg-green-100 min-h-screen p-8 mt-20 ml-64">
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
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold">List Lights</h2>

                    <!-- Mode Toggle Button -->
                    <form id="modeForm" method="POST" action="/mode/update" class="ml-auto">
                        @csrf
                        <input type="hidden" name="mode" id="modeInput" value="{{ $autoMode === 1 ? 'auto' : 'manual' }}">
                        <button type="button" class="flex items-center justify-center rounded-full p-1 w-28 h-10 transition-all duration-300 ease-[cubic-bezier(0.4,0,0.2,1)] overflow-hidden shadow-sm relative
                   {{ $autoMode === 1 ? 'bg-green-500' : 'bg-red-500' }}" id="modeToggleBtn">
                            <!-- Single text element that changes -->
                            <span class="text-sm font-medium text-white absolute transition-all duration-300 ease-[cubic-bezier(0.4,0,0.2,1)] transform
                        {{ $autoMode === 1 ? 'opacity-100 scale-100' : 'opacity-0 scale-90' }}" id="autoText">AUTO</span>
                            <span class="text-sm font-medium text-white absolute transition-all duration-300 ease-[cubic-bezier(0.4,0,0.2,1)] transform
                        {{ $autoMode === 0 ? 'opacity-100 scale-100' : 'opacity-0 scale-90' }}"
                                id="manualText">MANUAL</span>
                        </button>
                    </form>

                    <script>
                        document.getElementById('modeToggleBtn').addEventListener('click', function () {
                            const modeInput = document.getElementById('modeInput');
                            const isCurrentlyAuto = modeInput.value === 'auto';
                            const newMode = isCurrentlyAuto ? 'manual' : 'auto';

                            // Update UI immediately
                            if (isCurrentlyAuto) {
                                // Switch to manual
                                this.classList.remove('bg-green-500');
                                this.classList.add('bg-red-500');

                                // Animate text transition
                                document.getElementById('autoText').classList.remove('opacity-100', 'scale-100');
                                document.getElementById('autoText').classList.add('opacity-0', 'scale-90');

                                document.getElementById('manualText').classList.remove('opacity-0', 'scale-90');
                                document.getElementById('manualText').classList.add('opacity-100', 'scale-100');
                            } else {
                                // Switch to auto
                                this.classList.remove('bg-red-500');
                                this.classList.add('bg-green-500');

                                // Animate text transition
                                document.getElementById('manualText').classList.remove('opacity-100', 'scale-100');
                                document.getElementById('manualText').classList.add('opacity-0', 'scale-90');

                                document.getElementById('autoText').classList.remove('opacity-0', 'scale-90');
                                document.getElementById('autoText').classList.add('opacity-100', 'scale-100');
                            }

                            // Update input value
                            modeInput.value = newMode;

                            // Lock/unlock tombol lampu
                            document.querySelectorAll('.switchable').forEach(btn => {
                                btn.disabled = !isCurrentlyAuto;
                                btn.style.transition = 'opacity 0.3s ease, cursor 0.3s ease';
                                btn.style.opacity = !isCurrentlyAuto ? 0.4 : 1;
                                btn.style.cursor = !isCurrentlyAuto ? 'not-allowed' : 'pointer';
                            });

                            // Kirim ke server
                            fetch('/mode/update', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({ mode: newMode })
                            })
                                .then(res => {
                                    if (!res.ok) {
                                        throw new Error('Failed to update mode');
                                    }
                                    // Add visual feedback on success
                                    this.classList.add('ring-2', 'ring-offset-2', isCurrentlyAuto ? 'ring-red-300' : 'ring-green-300');
                                    setTimeout(() => {
                                        this.classList.remove('ring-2', 'ring-offset-2', 'ring-red-300', 'ring-green-300');
                                    }, 1000);
                                })
                                .catch(err => {
                                    console.error("Error:", err);
                                    // Revert changes if error
                                    if (isCurrentlyAuto) {
                                        // Revert to auto
                                        this.classList.add('bg-green-500');
                                        this.classList.remove('bg-red-500');

                                        document.getElementById('autoText').classList.add('opacity-100', 'scale-100');
                                        document.getElementById('autoText').classList.remove('opacity-0', 'scale-90');
                                        document.getElementById('manualText').classList.add('opacity-0', 'scale-90');
                                        document.getElementById('manualText').classList.remove('opacity-100', 'scale-100');
                                    } else {
                                        // Revert to manual
                                        this.classList.add('bg-red-500');
                                        this.classList.remove('bg-green-500');

                                        document.getElementById('manualText').classList.add('opacity-100', 'scale-100');
                                        document.getElementById('manualText').classList.remove('opacity-0', 'scale-90');
                                        document.getElementById('autoText').classList.add('opacity-0', 'scale-90');
                                        document.getElementById('autoText').classList.remove('opacity-100', 'scale-100');
                                    }
                                    modeInput.value = isCurrentlyAuto ? 'auto' : 'manual';
                                });
                        });
                    </script>

                </div>

                <div class="grid grid-cols-2 gap-4">
                    @foreach ($lightList as $item)
                        <div
                            class="flex justify-between items-center p-4 border-2 border-green-300 rounded-lg 
                                                    {{ $item->status === 'Active' ? 'bg-green-100 hover:bg-green-200' : 'bg-white hover:bg-gray-100' }}">

                            <div class="flex items-center gap-4">
                                <i class="fa-solid fa-lightbulb text-3xl text-gray-800"></i>
                                <div>
                                    <h3 class="font-semibold text-lg">{{ $item->name }}</h3>
                                    <p class="text-sm">
                                        @if ($item->status === 'Active')
                                            <span class="text-green-600">{{ $item->status }}</span>
                                        @else
                                            <span class="text-red-600">{{ $item->status }}</span>
                                        @endif
                                        |
                                        <span class="text-slate-600">{{ $item->electrical_power }}Wh</span>
                                    </p>
                                </div>
                            </div>

                            <!-- ON/OFF Button -->
                            <form action="/control" method="POST" class="ml-auto">
                                @csrf
                                <input type="hidden" name="id_appliances" value="{{ $item->id_appliances }}">
                                <input type="hidden" name="command" id="commandInput-{{ $item->id_appliances }}">

                                <button type="submit"
                                    class="flex items-center rounded-full border border-gray-300 bg-gray-100 p-1 w-28 switchable"
                                    onclick="toggleCommand(event, '{{ $item->id_appliances }}', '{{ $item->status }}', '{{ $item->mqtt_topic }}')"
                                    {{ $autoMode === 1 ? 'disabled style=opacity:0.4;cursor:not-allowed' : '' }}>
                                    <div
                                        class="flex-1 py-2 text-sm font-medium text-center rounded-full 
                                                                {{ $item->status === 'Active' ? 'bg-green-500 text-white' : 'bg-transparent' }}">
                                        ON
                                    </div>
                                    <div
                                        class="flex-1 py-2 text-sm font-medium text-center rounded-full 
                                                                {{ $item->status === 'Inactive' ? 'bg-red-500 text-white' : 'bg-transparent' }}">
                                        OFF
                                    </div>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Schedule -->
            <div class="mb-8 bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-bold text-center mb-4">Schedule</h2>
                <div class="mt-6 text-right">
                    <a href="{{ route('schedule.add') }}"
                        class="px-5 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
                        + Add Schedule
                    </a>
                </div>

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
                                <td
                                    class="p-3 border text-center {{ $item->status === 'Active' ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $item->status }}
                                </td>
                                <td class="p-3 border text-center">{{ $item->repeat_schedule }}</td>
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
                                            onclick="return confirm('Are You Sure Want to Delete this Schedule?')">
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

    <!-- Script ON/OFF Lampu -->
    <script>
        function toggleCommand(event, id, currentStatus, topic) {
            event.preventDefault();

            const nextCommand = currentStatus === "Active" ? topic + " off" : topic + " on";
            const nextStatus = nextCommand.includes("on") ? "Active" : "Inactive";

            document.getElementById('commandInput-' + id).value = nextCommand;

            event.target.closest("form").submit();

            fetch(`/appliances/${id}/status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: nextStatus })
            });
        }

        function toggleAutoMode() {
            const modeInput = document.getElementById('modeInput');
            const currentMode = modeInput.value;
            const isSwitchingToAuto = currentMode === 'manual';
            const newMode = isSwitchingToAuto ? 'auto' : 'manual';

            // Ganti style tombol
            document.getElementById('modeOn').className =
                isSwitchingToAuto ? 'flex-1 py-2 text-sm font-medium text-center rounded-full bg-green-500 text-white'
                    : 'flex-1 py-2 text-sm font-medium text-center rounded-full bg-transparent';
            document.getElementById('modeOff').className =
                isSwitchingToAuto ? 'flex-1 py-2 text-sm font-medium text-center rounded-full bg-transparent'
                    : 'flex-1 py-2 text-sm font-medium text-center rounded-full bg-red-500 text-white';

            // Disable tombol lampu kalau AUTO
            document.querySelectorAll('.switchable').forEach(btn => {
                btn.disabled = isSwitchingToAuto;
                btn.style.opacity = isSwitchingToAuto ? 0.4 : 1;
                btn.style.cursor = isSwitchingToAuto ? "not-allowed" : "pointer";
            });

            // Set input hidden
            modeInput.value = newMode;

            // Kirim ke server
            fetch('/mode/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ mode: newMode })
            });
        }
    </script>
@endsection