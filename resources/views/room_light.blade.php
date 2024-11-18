@extends('layout.room_light')

@section('title', 'Aplikasi GX DOJO')

@section('content')
<div class="bg-green-50 min-h-screen flex">
    <!-- Sidebar Placeholder -->
    <div class="w-64 hidden lg:block"></div> <!-- Placeholder untuk sidebar -->

    <!-- Konten Utama -->
    <div class="flex-1">
        <div class="container mx-auto px-6 lg:px-12 py-16">
            <!-- Header Section -->
            <div class="flex items-center justify-between mb-8">
                <a href="/usage_by_room" class="text-gray-700 text-lg font-semibold hover:text-gray-900">Back</a>
                <div class="flex items-center bg-gray-100 rounded-full px-6 py-3 shadow">
                    <div class="flex flex-col items-start">
                        <span class="text-2xl font-bold text-gray-800">54,523 Watts</span>
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
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                @foreach([1, 2, 3] as $appliance)
                <div class="bg-white rounded-lg shadow p-6 flex flex-col space-y-4">
                    <div class="text-gray-800 font-semibold">Panasonic Lamp</div>
                    <div class="text-gray-500">3 Hours 18 Minutes</div>
                    <div class="text-gray-500">23 Watts</div>
                    <div class="text-gray-500">67 kWh</div>
                    <div class="flex items-center justify-between mt-auto">
                        <span class="{{ $loop->first ? 'text-green-500' : 'text-red-500' }}">
                            {{ $loop->first ? 'Active' : 'Deactivate' }}
                        </span>
                        <a href="#" class="text-blue-500 px-4 py-2 rounded-lg border border-blue-500 hover:bg-blue-500 hover:text-white transition">
                            View
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Room Analysis Section -->
            <div class="bg-white rounded-lg shadow p-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-semibold text-gray-800">Room Analysis</h2>
                    <select class="border-gray-300 rounded px-4 py-2">
                        <option>Week</option>
                        <option>Month</option>
                    </select>
                </div>
                <div>
                    <!-- Canvas for Chart.js -->
                    <canvas id="roomAnalysisChart"></canvas>
                </div>
                <div class="text-gray-500 text-sm mt-4 text-center">
                    Periode 01-09-24 to 07-09-24
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Initialize Chart.js Bar Chart
    const ctx = document.getElementById('roomAnalysisChart').getContext('2d');
    const roomAnalysisChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'kWh',
                data: [3.847, 22.125, 15.124, 9.245, 19.451, 5.128, 10.222],
                backgroundColor: [
                    'rgba(34, 197, 94, 0.8)',  // Green
                    'rgba(239, 68, 68, 0.8)',  // Red
                    'rgba(249, 115, 22, 0.8)', // Orange
                    'rgba(59, 130, 246, 0.8)', // Blue
                    'rgba(249, 115, 22, 0.8)', // Orange
                    'rgba(34, 197, 94, 0.8)',  // Green
                    'rgba(59, 130, 246, 0.8)', // Blue
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
