@extends('layout.room_light')

@section('title', 'Aplikasi GX DOJO')

@section('content')
<div class="flex flex-col items-center w-full bg-green-100 min-h-screen mt-20 ml-64"
>
    <div class="w-64 hidden lg:block"></div>

    <!-- Konten Utama -->
    <div class="flex-1">
        <div class="container mx-auto px-6 lg:px-12 py-16">
            <!-- Header Section -->
            <div class="flex items-center justify-between mb-10">
                <a href="/usage_by_room" class="text-blue-500 px-4 py-2 rounded-lg border border-blue-500 hover:bg-blue-500 hover:text-white transition">
                    Back
                </a>
                <div class="flex items-center bg-gray-100 rounded-full px-6 py-3 shadow">
                    <div class="flex flex-col items-start">
                        <span class="text-2xl font-bold text-gray-800">{{ $total_power }} Watts</span>
                        <span class="text-gray-500 text-sm">Bigger than last week</span>
                    </div>
                    <span class="text-red-500 flex items-center text-sm ml-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0l7 12h-14l7-12z" />
                        </svg>
                        10%
                    </span>
                </div>
            </div>

            <!-- List Appliances Section -->
            <div class="mb-12">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Appliances Usage</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($lightList as $i)
                    <div class="bg-white rounded-lg shadow p-6 flex flex-col space-y-4 hover:shadow-lg transition" >
                        <span class="hidden" id="startTime">{{ $i->start_time }}</span>
                        <span class="hidden" id="id_appliance">{{ $i->id_appliances }}</span>

                        <div class="text-gray-800 font-semibold">{{ $i->name }}</div>
                        <div id="usageTime" class="text-gray-500"></div>
                        <div class="text-gray-500">Power: {{ $i->electrical_power }} Watts</div>
                        <div class="text-gray-500">Energy: 67 kWh</div>
                        <div class="flex items-center justify-between mt-auto">
                            <span class="{{ $i->status === 'Active' ? 'text-green-500' : 'text-red-500' }}">
                                {{ $i->status }}
                            </span>
                            <a href="{{ route('light', ['id_appliances' => $i->id_appliances]) }}" class="text-blue-500 px-4 py-2 rounded-lg border border-blue-500 hover:bg-blue-500 hover:text-white transition">
                                View Details
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <script>
                function tes(){
                    console.log('hai')
                }
            </script>

            <!-- Room Analysis Section -->
            <div class="bg-white rounded-lg shadow p-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-semibold text-gray-800">Room Analysis</h2>
                    <select class="border-gray-300 rounded px-4 py-2">
                        <option>Week</option>
                        <option>Month</option>
                    </select>
                </div>
                <p class="text-sm text-gray-600 mb-4">
                    Analysis of energy consumption over the selected period.
                </p>
                <div>
                    <canvas id="roomAnalysisChart"></canvas>
                </div>
                <div class="text-gray-500 text-sm mt-4 text-center">
                    Periode: 01-09-24 to 07-09-24
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const ctx = document.getElementById('roomAnalysisChart').getContext('2d');
    const roomAnalysisChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'kWh',
                data: [3.847, 22.125, 15.124, 9.245, 19.451, 5.128, 10.222],
                backgroundColor: [
                    'rgba(59, 130, 246, 0.8)',  // Blue
                    'rgba(239, 68, 68, 0.8)',  // Red
                    'rgba(249, 115, 22, 0.8)', // Orange
                    'rgba(59, 130, 246, 0.8)', // Blue
                    'rgba(249, 115, 22, 0.8)', // Orange
                    'rgba(34, 197, 94, 0.8)',  // Green
                    'rgba(34, 197, 94, 0.8)',  // Green
                ],
                borderRadius: 8,
                borderWidth: 1,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.raw} kWh`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + ' kWh';
                        }
                    }
                }
            }
        }
    });
</script>

@endsection
