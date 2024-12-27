@extends('layout.mainLayout')


@section('title', 'Reports Detail')

@section('content')

    <div class="flex flex-col  w-auto bg-green-100 min-h-screen mt-20 ml-64 ">
        <div class="mb-4 mt-10 ml-10">
            <a href="/report"
                class="text-blue-500 px-4 py-2 rounded-lg border border-blue-500 hover:bg-blue-500 hover:text-white transition ">
                Back
            </a>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-6xl mx-auto mt-5 mb-14">
            @if (session('sukses'))
                <div class="error  text-green-600 bg-green-200 p-3 rounded-lg mb-5 font-semibold ">
                    {{ session('sukses') }} !!</div>
            @endif
                
            <!-- Tabel -->
            <span class="text-slate-800 text-xl  font-bold ">{{ $report->description }}</span>
            <div class="overflow-x-auto mt-5">
                <table
                    class="w-full border border-gray-300 divide-y divide-gray-300 text-sm text-left bg-white rounded-lg shadow-md">
                    <div class="mt-6 text-right mb-5">
                        <a href="{{ route('report.download', ['id' => $report->id_report, 'data' => serialize($data_summary_report)]) }}"
                            class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            <span class="fa fa-print mr-3"></span>Print
                        </a>
                    </div>
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-6 py-3 font-semibold text-gray-800 text-center">No</th>
                            <th class="px-6 py-3 font-semibold text-gray-800">Des</th>
                            <th class="px-6 py-3 font-semibold text-gray-800 text-center">Power Used</th>
                            <th class="px-6 py-3 font-semibold text-gray-800 text-center">Usage Time</th>
                            <th class="px-6 py-3 font-semibold text-gray-800 text-center">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data_summary_report as $i)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-3 text-center">{{ $loop->iteration }}</td>
                                <td class="px-6 py-3">{{ $i->appliance->name }}</td>
                                <td class="px-6 py-3 text-center">{{ $i->total_power }} Watt / Hour</td>
                                <td class="px-6 py-3 text-center">
                                    @php
                                        $hours = floor($i->total_usage_time / 3600);
                                        $minutes = floor(($i->total_usage_time % 3600) / 60);
                                        $seconds = $i->total_usage_time % 60;
                                    @endphp
                                    {{ $hours }}Jam {{ $minutes }}menit {{ $seconds }}detik
                                </td>
                                <td class="px-6 py-3 text-center">{{ $i->created_at->format('d-m-Y') }} </td>



                                
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
