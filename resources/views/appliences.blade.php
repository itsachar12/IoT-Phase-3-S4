@extends('layout.appliences')

@section('title', 'Aplikasi GX DOJO')

@section('content')

    <div class="flex h-auto w-auto flex-col bg-green-100 min-h-screen p-8 mt-20 ml-64">
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3 w-full max-w-screen-xl">
            
            <!-- Appliances Active -->
            <div class="bg-white rounded-lg shadow-md p-4 flex justify-between items-center lg:col-span-1">
                <div>
                    <h2 class="text-lg font-semibold text-gray-700">Appliances Active</h2>
                    <p class="text-sm text-gray-500">
                        <span class="text-green-500 font-bold">{{ $total_act->count() }}</span> out of {{ $appliances->count() }} Appliances in Active
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
                    <span class="text-sm font-medium text-gray-700">{{ $total_power }} Watts</span>
                </div>

                <!-- Air Conditioner Active -->
                <div class="flex items-center space-x-4">
                    <img src="{{ url('/image/g3.png') }}" class="w-8 h-8 object-contain" alt="Air Conditioner">
                    <span class="text-sm font-medium text-gray-700">
                        <span class="text-green-500 font-bold">{{ $total_act_ac->count() }}</span>/{{ $total_ac->count() }} Actives
                    </span>
                </div>

                <!-- Lightbulb Active -->
                <div class="flex items-center space-x-4">
                    <i class="fa-solid fa-lightbulb text-gray-800 text-3xl"></i>
                    <span class="text-sm font-medium text-gray-700">
                        <span class="text-green-500 font-bold">{{ $total_act_lamp->count() }}</span>/{{ $total_lamp->count() }} Actives
                    </span>
                </div>
            </div>

            <!-- Appliances List -->
            <div class="bg-white rounded-lg shadow-md p-6 lg:col-span-1">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Appliances Lists</h2>
                <p class="text-sm text-gray-500 mb-4">Daily Usage</p>

                <!-- Item: Air Conditioner -->
                <a href="/ac">

                    <div
                        class="flex items-center justify-between p-3 bg-gray-100 rounded-xl mb-3 hover:bg-gray-200 transition">
                        <div class="flex items-center space-x-4">
                            <img src="{{ url('/image/g3.png') }}" class="w-8 h-8 object-contain" alt="Air Conditioner">
                            <div>
                                <p class="text-base font-medium text-gray-700">Air Conditioner</p>
                                <p class="text-xs text-gray-500">{{ $total_ac->count() }} Units | {{ $total_power_ac }}kWh</p>
                            </div>
                        </div>
                        <i class="fa-solid fa-arrow-right text-blue-500 text-2xl"></i>
                    </div>
                </a>

                <!-- Item: Lights -->
                <a href="/light">

                    <div class="flex items-center justify-between p-3 bg-gray-100 rounded-xl hover:bg-gray-200 transition">
                        <div class="flex items-center space-x-4">
                            <i class="fa-solid fa-lightbulb text-3xl text-gray-800"></i>
                            <div>
                                <p class="text-base font-medium text-gray-700">Lights</p>
                                <p class="text-xs text-gray-500">{{ $total_lamp->count() }} Units | {{ $total_power_lamp }}kWh</p>
                            </div>
                        </div>
                        <i class="fa-solid fa-arrow-right text-blue-500 text-2xl"></i>
                    </div>
                </a>
            </div>

            <!-- ? Schedule -->
            <div class="bg-white rounded-lg shadow-md p-6 lg:col-span-2">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Schedule</h2>
                @if (session('error'))
                    <div class="error  text-red-600 bg-red-300 p-3 rounded-lg">
                        {{ session('error') }}</div>
                @endif
                @if (session('sukses'))
                    <div class="error  text-green-800 bg-green-300 p-3 rounded-lg mb-2 font-bold ">
                        {{ session('sukses') }} !!</div>
                @endif
                <!-- Info Bar -->
                <div class="flex items-center bg-gray-200 p-4 rounded-lg mb-6">
                    <a href="{{ route('schedule.add') }}">
                        <svg class="w-8 h-8 text-green-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" fill="none">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </a>
                    <p class="text-lg font-semibold ml-4">You Created {{ $schedules->count() }} Schedule</p>
                    <span class="text-sm text-gray-600 ml-auto">{{ $total_act->count() }} Appliances are in use</span>
                </div>
                
                <!-- Schedule Items -->
                <div class="space-y-4">
                    <!-- Item 1 -->
                    @foreach ($schedules as $item)
                        <div
                            class="flex items-center justify-between bg-gray-100 p-4 rounded-lg hover:bg-gray-200 transition">
                            <div>
                                <p class="text-lg font-semibold">{{ $item->name_appliance }}</p>
                                <p class="text-sm text-gray-500">{{ $item->status }} {{ $item->time_start }} -
                                    {{ $item->time_end }}</p>
                                <p class="text-sm text-gray-500">{{ $item->repeat_schedule }}</p>
                            </div>
                            <div class="flex space-x-6">
                                <a href="{{ route('schedule.edit', $item->id_schedule) }}"  class="text-orange-600 font-semibold">Edit</a>

                                <form action="{{ route('schedule.delete', $item->id_schedule) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button  class="text-red-600 font-semibold" type="submit" onclick="return confirm('Are You Sure Want to Delete this Schedule?') ">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
    
@endsection
