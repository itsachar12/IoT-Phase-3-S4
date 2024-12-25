<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>title</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/ea41a3ae8b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Flowbite  -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

    <!-- Tailwind CSS  -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>


    <script>
        function realtimeUsageLamp() {
            const appliances = document.querySelectorAll('.startTime');

            appliances.forEach(appliance => {
                const id = appliance.dataset.idAppliance;
                const status = document.getElementById('status-' + id).textContent;
                const usageTimeElement = document.getElementById('usageTime-' + id);
                let updateCounter = 0;


                let usageTime = parseInt(document.getElementById('totalUsageTime-' + id).textContent);

                // merubah usage time detik to time H:m:s
                function formatTime(seconds) {
                    const hours = Math.floor(seconds / 3600);
                    const minutes = Math.floor((seconds % 3600) / 60);
                    const remainingSeconds = seconds % 60;
                    return `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${remainingSeconds.toString().padStart(2, '0')}`;
                }


                if (status === 'Active') {

                    const intervalId = setInterval(() => {

                        if (document.getElementById('status-' + id).textContent === 'Active') {
                            usageTime++;

                            console.log(usageTime);
                            usageTimeElement.textContent = `Usage Time : ${formatTime(usageTime)}`;


                            updateCounter++;
                            if (updateCounter >= 5) {
                                updateUsageLamp(id, usageTime);
                                updateCounter = 0;
                            }
                        }
                    }, 1000);

                    // Simpan intervalID ke dalam data atribut agar bisa di-clear jika diperlukan
                    // appliance.setAttribute('data-interval', intervalId); 

                } else {

                    usageTimeElement.textContent = `Usage Time : ${formatTime(usageTime)}`;
                }
            });
        }


        function updateUsageLamp(id, usageTime) {
            // console.log(elapsed)
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            // console.log(csrfToken)
            fetch(`/lampu/${id}/update-usage`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken // Token CSRF
                    },
                    body: JSON.stringify({
                        usage_time: usageTime // Kirim waktu penggunaan yang dihitung
                    })
                })
                // .then(data => console.log(data))
                .catch(error => console.error("Error:", error));
        }

        function realtimeUsageAC() {

            const startTimes = document.querySelectorAll('.startTime');

            startTimes.forEach((startTimeElement) => {
                const startTime = startTimeElement.textContent;

                const id = startTimeElement.dataset.idAppliance;
                const startTimeDate = new Date(startTime);
                const usageTimeElement = document.getElementById('usageTime-' + id);
                const status = document.getElementById('status-' + id).textContent;
                let updateCounter = 0;
                let usageTime = parseInt(document.getElementById('totalUsageTime-' + id).textContent);
                // console.log(totalUsageTime);


                function formatTime(seconds) {
                    const hours = Math.floor(seconds / 3600);
                    const minutes = Math.floor((seconds % 3600) / 60);
                    const remainingSeconds = seconds % 60;
                    return `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${remainingSeconds.toString().padStart(2, '0')}`;
                }

                if (status === 'Active') {
                    const intervalId = setInterval(() => {
                        // in seconds

                        if (document.getElementById('status-' + id).textContent === 'Active') {
                            usageTime++;


                            usageTimeElement.textContent = `Usage Time : ${formatTime(usageTime)}`;


                            updateCounter++;
                            if (updateCounter >= 5) {
                                updateUsageAC(id, usageTime);
                                updateCounter = 0;
                            }
                        } else {
                            usageTimeElement.textContent = `Usage Time : ${formatTime(usageTime)}`;
                        }



                    }, 1000);
                }


            })
        }

        // Update database every minute
        function updateUsageAC(id, usageTime) {
            fetch(`/ac/${id}/update-usage`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Token CSRF
                },
                body: JSON.stringify({
                    usage_time: usageTime // Kirim waktu penggunaan yang dihitung
                })
            })
        }

        function resetDataApp() {
            fetch(`/appliances/resetDataApp`, {
                    method: 'GET',

                }).then(response => response.json())
                .then(data => {
                    console.log(data.message); // Tampilkan respons dari backend
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>

</head>

<body onload="realtimeUsageAC(); resetDataApp(); realtimeUsageLamp()">

    <header>
        @include('components.header')
    </header>

    <div class="container">
        <main>
            @yield('content')
        </main>
    </div>

    <footer>
        @include('components.footer')
    </footer>

</body>

</html>
