@extends('layout.dashboard')

@section('title', 'Aplikasi GX DOJO')

@section('content')

<div class="flex h-screen w-screen flex-col mt-16 ml-64">
    <div class="grid grid-cols-5 gap-6 p-6 bg-green-50 min-h-screen">

        <!-- Change in Cost -->
        <div class="col-span-2 bg-white rounded-lg shadow-md p-6">
            <h2 class="text-lg font-semibold text-gray-700">CHANGE IN COST</h2>
            <canvas id="changeInCostChart"></canvas>
            <div class="increase-label mt-6">
                <span>🔺 3.37% INCREASE IN COST</span>
            </div>
        </div>
        <script>
            const ctx = document.getElementById('changeInCostChart').getContext('2d');
            const changeInCostChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Cost',
                        data: [65, 192, 178, 184],
                        backgroundColor: ['#7fe3ff', '#7fe3ff', '#7fe3ff', '#58c3d0'],
                        borderRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                        },
                        y: {
                            ticks: {
                                stepSize: 50
                            },
                            grid: {
                                borderDash: [4, 4]
                            },
                        }
                    }
                }
            });
        </script>


        <!-- Usage Estimate -->
        <div class="col-span-3 bg-white rounded-lg shadow-md p-6">
            <h2 class="text-lg font-semibold text-gray-700">USAGE ESTIMATE</h2>
            <div class="mt-4">
                <canvas id="usageEstimateChart" width="400" height="250"></canvas>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('usageEstimateChart').getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['kwh 1', 'kwh 86', 'kwh 198', 'kwh 324', 'kwh 400'],
                        datasets: [{
                                label: 'To Now',
                                data: [0, 100, 200, 300, 400],
                                borderColor: '#ff6384',
                                backgroundColor: 'rgba(255, 99, 132, 0.3)',
                                pointBackgroundColor: '#ff6384',
                                fill: true,
                                tension: 0.3
                            },
                            {
                                label: 'Predicted',
                                data: [null, null, 200, 300, 435],
                                borderColor: '#36a2eb',
                                backgroundColor: 'rgba(54, 162, 235, 0.3)',
                                pointBackgroundColor: '#36a2eb',
                                fill: true,
                                tension: 0.3
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 500,
                                title: {
                                    display: true,
                                    text: 'kWh',
                                    color: '#666',
                                    font: {
                                        size: 12,
                                        weight: 'bold'
                                    }
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return context.raw ? `${context.raw} kWh` : '';
                                    }
                                }
                            }
                        }
                    }
                });
            });
        </script>


        <!-- Active Appliances -->
        <div class="col-span-1 bg-white rounded-lg shadow-md p-6">
            <h2 class="text-lg font-semibold text-gray-700">ACTIVE APPLIENCES</h2>
            <div class="mt-4">
                <!-- Chart Canvas -->
                <canvas id="activeAppliancesChart" class="w-full h-40"></canvas>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('activeAppliancesChart').getContext('2d');
                const activeAppliancesChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['AC', 'Lamp'],
                        datasets: [{
                            label: 'kWh',
                            data: [400, 450],
                            backgroundColor: ['#a0f0ff', '#39d2b4'],
                            borderWidth: 1,
                            borderRadius: 5,
                            barPercentage: 0.6,
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 500,
                                ticks: {
                                    stepSize: 100,
                                },
                                title: {
                                    display: true,
                                    text: 'kWh',
                                    font: {
                                        size: 12,
                                    }
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            });
        </script>

        <!-- Energy Intensity -->
        <div class="col-span-2 bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-800">ENERGY INTENSITY</h2>
            <div class="flex justify-around mt-8">
                <!-- Circle A -->
                <div class="flex flex-col items-center space-y-2">
                    <div class="relative">
                        <svg class="w-24 h-24 transform -rotate-90">
                            <!-- Background Circle -->
                            <circle class="text-gray-300" stroke-width="6" stroke="currentColor" fill="transparent" r="36" cx="48" cy="48" />
                            <!-- Foreground Circle -->
                            <circle id="circleA" class="text-teal-400" stroke-width="6" stroke-dasharray="226.2" stroke-linecap="round" stroke="currentColor" fill="transparent" r="36" cx="48" cy="48" />
                        </svg>
                        <!-- Text in Center -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-xl font-semibold">A</span>
                        </div>
                    </div>
                    <!-- Text Outside Circle -->
                    <span class="text-sm text-gray-500">45 kWh/sqft</span>
                </div>

                <!-- Circle B -->
                <div class="flex flex-col items-center space-y-2">
                    <div class="relative">
                        <svg class="w-24 h-24 transform -rotate-90">
                            <!-- Background Circle -->
                            <circle class="text-gray-300" stroke-width="6" stroke="currentColor" fill="transparent" r="36" cx="48" cy="48" />
                            <!-- Foreground Circle -->
                            <circle id="circleB" class="text-teal-400" stroke-width="6" stroke-dasharray="226.2" stroke-linecap="round" stroke="currentColor" fill="transparent" r="36" cx="48" cy="48" />
                        </svg>
                        <!-- Text in Center -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-xl font-semibold">B</span>
                        </div>
                    </div>
                    <!-- Text Outside Circle -->
                    <span class="text-sm text-gray-500">23 kWh/sqft</span>
                </div>

                <!-- Circle C -->
                <div class="flex flex-col items-center space-y-2">
                    <div class="relative">
                        <svg class="w-24 h-24 transform -rotate-90">
                            <!-- Background Circle -->
                            <circle class="text-gray-300" stroke-width="6" stroke="currentColor" fill="transparent" r="36" cx="48" cy="48" />
                            <!-- Foreground Circle -->
                            <circle id="circleC" class="text-teal-400" stroke-width="6" stroke-dasharray="226.2" stroke-linecap="round" stroke="currentColor" fill="transparent" r="36" cx="48" cy="48" />
                        </svg>
                        <!-- Text in Center -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-xl font-semibold">C</span>
                        </div>
                    </div>
                    <!-- Text Outside Circle -->
                    <span class="text-sm text-gray-500">11 kWh/sqft</span>
                </div>

            </div>
        </div>

        <script>
            // Set the energy intensity values for each circle
            const energyIntensityValues = {
                circleA: 45,
                circleB: 23,
                circleC: 11
            };

            // Calculate and set the stroke-dashoffset based on the value
            function setProgress(circleId, value) {
                const maxDashArray = 226.2;
                const offset = maxDashArray - (maxDashArray * (value / 100));

                const circleElement = document.getElementById(circleId);
                circleElement.style.strokeDashoffset = offset;
                circleElement.style.stroke = "#0dd3bb";
            }

            // Initialize each circle with its respective value
            setProgress("circleA", energyIntensityValues.circleA);
            setProgress("circleB", energyIntensityValues.circleB);
            setProgress("circleC", energyIntensityValues.circleC);
        </script>

        <style>
            /* Smooth animation for the circle progress */
            #circleA,
            #circleB,
            #circleC {
                transition: stroke-dashoffset 1s ease-in-out;
            }
        </style>


        <!-- Carbon Footprint -->
        <div class="col-span-2 bg-white rounded-lg shadow-md p-6">
            <h2 class="text-lg font-semibold text-gray-800">CARBON FOOTPRINT</h2>

            <!-- Emission Section -->
            <div class="mt-6">
                <p class="text-sm font-medium text-gray-600">Emission</p>
                <div class="flex items-center justify-between mt-1 text-xs text-gray-500">
                    <span>To Now</span>
                    <span>Predicted</span>
                </div>
                <!-- Emission Bar -->
                <div class="relative mt-2 h-4 bg-gray-200 rounded-full overflow-hidden">
                    <div class="absolute h-full bg-gray-700" style="width: 2%;"></div>
                </div>
                <div class="flex items-center justify-between mt-2 text-xs text-gray-500">
                    <span>52.9 Kg of CO2</span>
                    <span>3124.12 Kg of CO2</span>
                </div>
            </div>

            <!-- Green Energy Generated Section -->
            <div class="mt-6">
                <p class="text-sm font-medium text-gray-600">Green Energy Generated</p>
                <!-- Green Energy Generated Bar -->
                <div class="relative mt-2 h-4 bg-gray-200 rounded-full overflow-hidden">
                    <div class="absolute h-full bg-green-400" style="width: 30%;"></div>
                </div>
                <div class="flex items-center justify-between mt-2 text-xs text-gray-500">
                    <span>XXXX</span>
                    <span>XXXX</span>
                </div>
            </div>
        </div>


        @endsection