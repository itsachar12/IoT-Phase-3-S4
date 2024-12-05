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
                        <span class="text-green-500 font-bold">123</span> out of 654 Appliances in Active
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
                    <span class="text-sm font-medium text-gray-700">400 Watts</span>
                </div>

                <!-- Air Conditioner Active -->
                <div class="flex items-center space-x-4">
                    <img src="{{ url('/image/g3.png') }}" class="w-8 h-8 object-contain" alt="Air Conditioner">
                    <span class="text-sm font-medium text-gray-700">
                        <span class="text-green-500 font-bold">12</span>/23 Actives
                    </span>
                </div>

                <!-- Lightbulb Active -->
                <div class="flex items-center space-x-4">
                    <i class="fa-solid fa-lightbulb text-gray-800 text-3xl"></i>
                    <span class="text-sm font-medium text-gray-700">
                        <span class="text-green-500 font-bold">86</span>/89 Actives
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
                                <p class="text-xs text-gray-500">23 Units | 48kWh</p>
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
                                <p class="text-xs text-gray-500">100 Units | 15kWh</p>
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
                    <a href="#" data-modal-target="crud-modal" data-modal-toggle="crud-modal">
                        <svg class="w-8 h-8 text-green-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" fill="none">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </a>
                    <p class="text-lg font-semibold ml-4">You Created 4 Schedule</p>
                    <span class="text-sm text-gray-600 ml-auto">3 Appliances are in use</span>
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
                                <a href="#"  class="text-orange-600 font-semibold">Edit</a>

                                <form action="{{ route('schedule.delete', $item->id_schedule) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button  class="text-red-600 font-semibold" type="submit" onclick="confirm('Are You Sure Want to Delete this Schedule, with id {{ $item->id_schedule }} ? ') ">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>


    {{-- modal add schedule --}}
    <div id="crud-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Add New Schedule
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Modal body -->
                <form class="p-4 md:p-5" action="{{ route('schedule.add') }}" method="post">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">

                        <input type="number" class="hidden" value="">

                        {{-- ? apliance --}}
                        <div class="col-span-2">
                            <label for="name_appliance"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Appliance</label>
                            <select id="name_appliance" required name="name_appliance"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option selected="" disabled>--Select Appliance--</option>
                                {{-- perulangan daftar appliances --}}
                                @foreach ($appliances as $app)
                                    <option value="{{ $app->name }}">{{ $app->name }}</option>
                                @endforeach

                            </select>
                        </div>

                        {{-- ? Time start --}}
                        <div class="col-span-2 sm:col-span-1">
                            <label for="time_start"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Time Start</label>
                            <input type="time" name="time_start" id="time_start"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required="">
                        </div>

                        {{-- ? Time End --}}
                        <div class="col-span-2 sm:col-span-1">
                            <label for="time_end"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Time End</label>
                            <input type="time" name="time_end" id="time_end"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required>
                        </div>

                        {{-- ?repeat --}}
                        <div class="col-span-1">
                            <label for="repeat_schedule"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Repeat </label>
                            <select id="repeat_schedule" required name="repeat_schedule"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option selected disabled>--Select Repeat--</option>
                                {{-- perulangan daftar appliances --}}
                                <option value="Once">Once</option>
                                <option value="Daily">Daily</option>
                            </select>
                        </div>

                        {{-- ?status --}}
                        <div class="col-span-1">
                            <label for="status"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                            <select id="status" required name="status"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option selected disabled>--Select Status--</option>
                                {{-- perulangan daftar appliances --}}
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>

                    </div>
                    <button type="submit"
                        class="text-white inline-flex items-center justify-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5  dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 w-full">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Add New Schedule
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{--! modal edit schedule  --}}
    
@endsection
