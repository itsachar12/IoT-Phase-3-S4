@extends('layout.mainLayout')


@section('title', 'Report')

@section('content')

    <div class="flex flex-col items-center w-auto bg-green-100 min-h-screen mt-20 ml-64">
        
        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-6xl mx-auto mt-10">
            @if (session('sukses'))
                <div class="error  text-green-600 bg-green-200 p-3 rounded-lg mb-5 font-semibold ">
                    {{ session('sukses') }} !!</div>
            @endif
            <!-- Filter dan Search -->
            <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
                <!-- Date Range -->
                <div id="date-range-picker" class="flex items-center gap-3 w-full md:w-auto">
                    <input id="datepicker-range-start" name="start" type="date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full md:w-48 p-2.5" />
                    <span class="text-gray-500">to</span>
                    <input id="datepicker-range-end" name="end" type="date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full md:w-48 p-2.5" />
                </div>

                <!-- Search -->
                <form class="flex items-center gap-3 w-full md:w-auto">
                    <div class="relative w-full md:w-64">
                        <!-- Ikon Pencarian -->
                        <div class="absolute inset-y-0 left-3 flex items-center">
                            <svg class="w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="search" id="default-search"
                            class="block w-full pl-10 pr-4 py-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Search reports..." required />
                        <button type="submit"
                            class="text-white absolute right-0 bottom-0 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 h-full ">Search</button>
                    </div>
                </form>
            </div>

            <!-- Tabel -->
            <div class="overflow-x-auto">
                <div class="mt-6 text-right mb-5">
                    <a href="{{ route('report.add') }}"
                        class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        + Add Report
                    </a>
                </div>
                <table
                    class="w-full border border-gray-300 divide-y divide-gray-300 text-sm text-left bg-white rounded-lg shadow-md">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-6 py-3 font-semibold text-gray-800 text-center">No</th>
                            <th class="px-6 py-3 font-semibold text-gray-800">Report Name</th>
                            <th class="px-6 py-3 font-semibold text-gray-800">Type Appliance</th>
                            <th class="px-6 py-3 font-semibold text-gray-800 text-center">Date</th>
                            <th class="px-6 py-3 font-semibold text-gray-800 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reports as $i)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-3 text-center">{{ $loop->iteration }}</td>
                                <td class="px-6 py-3">{{ $i->description }}</td>
                                <td class="px-6 py-3">{{ $i->type_report }}</td>
                                <td class="px-6 py-3 text-center">{{ $i->date }}</td>
                                <td class="px-6 py-3 text-center flex justify-center gap-2">

                                    <a href="{{ route('report.view', $i->id_report) }}"
                                        class="bg-blue-500 text-white px-3 py-2 rounded hover:bg-blue-600">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('report.download', $i->id_report) }}"
                                        class="bg-green-500 text-white px-3 py-2 rounded hover:bg-green-600">
                                        <i class="fa fa-print"></i>
                                    </a>

                                    <form action="{{ route('report.delete', $i->id_report) }}" method="post">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" onclick="return confirm('Are You Sure to delete this report?')"
                                            class="bg-red-500 text-white px-3 py-2 rounded hover:bg-red-600">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-3 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-16 h-16 text-gray-300 mb-3" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 -5 30 30" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 8v4l3 3m9-7.5a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <p class="text-gray-700 font-medium">No reports available.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
