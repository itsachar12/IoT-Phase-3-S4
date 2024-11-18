@extends('layout.report')

@section('title', 'Aplikasi GX DOJO')

@section('content')

<div class="relative bg-green-50 min-h-screen h-screen flex-col overflow-hidden flex-1 ml-64">
    <div class="bg-white p-6 rounded-lg shadow-md mt-16 mx-4">
        <!-- Filter dan Search -->
        <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
            <!-- Date Range -->
            <div id="date-range-picker" class="flex items-center gap-2">
                <div class="relative">
                    <input id="datepicker-range-start" name="start" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                </div>
                <span class="text-gray-500">to</span>
                <div class="relative">
                    <input id="datepicker-range-end" name="end" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                </div>
            </div>

            <!-- Search -->
            <form class="flex items-center gap-2 w-full md:w-auto">
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search reports..." required />
                    <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Search</button>
                </div>
            </form>
        </div>

        <!-- Tabel -->
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 divide-y divide-gray-300 text-sm text-left bg-white rounded-lg shadow-md">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 font-semibold text-gray-800 border border-gray-300">No</th>
                        <th class="px-4 py-3 font-semibold text-gray-800 border border-gray-300">Report Name</th>
                        <th class="px-4 py-3 font-semibold text-gray-800 border border-gray-300">Date</th>
                        <th class="px-4 py-3 font-semibold text-gray-800 text-center border border-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reports as $report)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 border border-gray-300">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 border border-gray-300">{{ $report['name'] }}</td>
                        <td class="px-4 py-3 border border-gray-300">{{ $report['date'] }}</td>
                        <td class="px-4 py-3 text-center flex justify-center gap-2 border border-gray-300">
                            <button class="bg-blue-500 text-white px-3 py-2 rounded hover:bg-blue-600">
                                <i class="fa fa-eye"></i>
                            </button>
                            <button class="bg-red-500 text-white px-3 py-2 rounded hover:bg-red-600">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-4 py-3 text-center text-gray-500 border border-gray-300">
                            No reports available.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    </main>
</div>
</div>

@endsection