@extends('layout.mainLayout')

@section('title', 'Lights Room')

@section('content')
    <div class="flex flex-col items-center w-full bg-green-100 min-h-screen mt-20 ">
        <div class="w-64 hidden lg:block"></div>

        <!-- Konten Utama -->
        <div class="flex-1">
            <div class="container mx-auto px-6 lg:px-12 py-16">
                <!-- Header Section -->
                <div class="flex items-center justify-between mb-10">
                    <a href="/usage_by_room"
                        class="text-blue-500 px-4 py-2 rounded-lg border border-blue-500 hover:bg-blue-500 hover:text-white transition">
                        Back
                    </a>
                    <div class="flex items-center bg-gray-100 rounded-full px-6 py-3 shadow">
                        <div class="flex flex-col items-start">
                            <span class="text-2xl font-bold text-gray-800">{{ $total_power }} Wh</span>
                            <span class="text-gray-500 text-sm">Bigger than last week</span>
                        </div>
                        <span class="text-red-500 flex items-center text-sm ml-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="currentColor"
                                viewBox="0 0 24 24">
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
                        @foreach ($lightList as $i)
                            <div class="bg-white rounded-lg shadow p-6 flex flex-col space-y-4 hover:shadow-lg transition">
                                {{-- <span class="hidden" id="id_appliance">{{ $i->id_appliances }}</span> --}}
                                <span class="hidden startTime"
                                    data-id-appliance="{{ $i->id_appliances }}">{{ $i->start_time }}</span>
                                <span class="hidden" id="status-{{ $i->id_appliances }}">{{ $i->status }}</span>
                                <span class="hidden" id="totalUsageTime-{{ $i->id_appliances }}">{{ $i->usage_time }}</span>

                                <div class="text-gray-800 font-semibold">{{ $i->name }}</div>
                                <div id="usageTime-{{ $i->id_appliances }}" class="text-gray-500"> </div>
                                <div class="text-gray-500">Power: {{ $i->electrical_power }} Watts</div>
                                <div class="text-gray-500">Energy Used: {{ $i->total_power }} Wh</div>
                                <div class="flex items-center justify-between mt-auto">
                                    <span class="{{ $i->status === 'Active' ? 'text-green-500' : 'text-red-500' }}">
                                        {{ $i->status }}
                                    </span>
                                    <a href="{{ route('light', ['id_appliances' => $i->id_appliances]) }}"
                                        class="text-blue-500 px-4 py-2 rounded-lg border border-blue-500 hover:bg-blue-500 hover:text-white transition">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>


                <!-- Room Analysis Section -->
                <div class="bg-white rounded-lg shadow p-8">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-semibold text-gray-800">Room Analysis</h2>
                        <select class="border-gray-300 rounded px-4 py-2" id="periodeSelected">
                            <option value="week" selected>Week</option>
                            <option value="month">Month</option>
                        </select>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">
                        Analysis of energy consumption over the selected period.
                    </p>
                    <div>
                        <canvas id="roomAnalysisChart"></canvas>
                    </div>
                    <div class="text-gray-500 text-sm mt-4 text-center" id="rentang_periode">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const dataAnalysis = @json($roomAnalysis);
        const ctx = document.getElementById('roomAnalysisChart').getContext('2d');
        const periodeElement = document.getElementById('periodeSelected');
        let label = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
        let data = Object.values(dataAnalysis.week)
        let max = 500
        let rentangAwal = document.getElementById('rentang_periode');
        rentangAwal.textContent = `Periode : ${dataAnalysis.dateStartWeek} to ${dataAnalysis.today}`
        console.log(rentangAwal)



        const roomAnalysisChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: label,
                datasets: [{
                    label: 'Wh',
                    data: data,
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.8)', // Blue
                        'rgba(239, 68, 68, 0.8)', // Red
                        'rgba(249, 115, 22, 0.8)', // Orange
                        'rgba(34, 197, 94, 0.8)', // Green
                        'rgba(59, 130, 246, 0.8)', // Blue
                        'rgba(249, 115, 22, 0.8)', // Orange
                        'rgba(34, 197, 94, 0.8)', // Green
                    ],
                    borderRadius: 8,
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.raw} Wh`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max : max,
                        ticks: {
                            callback: function(value) {
                                return value + ' Wh';
                            },
                        }
                    }
                }
            }
        });

        periodeElement.addEventListener('change', () => {
            const labelSelected = periodeElement.value

            if (labelSelected == 'week') {
                label = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
                data = Object.values(dataAnalysis.week)
                max = (Math.max(...data) - Math.min(...data)) / 8



                rentangAwal.textContent = `Periode : ${dataAnalysis.dateStartWeek} to ${dataAnalysis.today}`



            } else if (labelSelected == 'month') {
                label = Object.keys(dataAnalysis.month)
                data = Object.values(dataAnalysis.month)
                max = (Math.max(...data) - Math.min(...data)) / 8
                console.log('ini ' + max)
                rentangAwal.textContent = `Periode : ${dataAnalysis.dateStartMonth} to ${dataAnalysis.today}`



            }
            console.log(data)

            roomAnalysisChart.data.labels = label;
            roomAnalysisChart.data.datasets[0].data = data;
            roomAnalysisChart.options.scales.y.max = max;
            roomAnalysisChart.update();
        })
    </script>

@endsection
