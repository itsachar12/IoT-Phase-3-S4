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
                <h2 class="text-xl font-bold mb-4">List Lights</h2>
                <div class="grid grid-cols-2 gap-4">
                    @foreach ($lightList as $item)
                                <div class="flex justify-between items-center p-4 border-2 border-green-300 rounded-lg 
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
                                            class="flex items-center rounded-full border border-gray-300 bg-gray-100 p-1 w-28"
                                            onclick="toggleCommand(event, '{{ $item->id_appliances }}', '{{ $item->status }}', '{{ $item->mqtt_topic }}')">
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
                <div>
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
    </div>

    <!-- JS Script ON/OFF Logic per Lamp -->
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
            }).then(response => {
                if (response.ok) {
                    console.log('Status updated for Lamp ID: ' + id);
                } else {
                    console.error('Failed to update status for Lamp ID: ' + id);
                }
            });
        }
    </script>
@endsection