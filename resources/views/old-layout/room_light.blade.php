<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Room Light</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/ea41a3ae8b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Flowbite  -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

    <!-- Tailwind CSS  -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>



    <script>
        // Function to calculate and display elapsed time
        function realtimeUsage() {

            const startTimes = document.querySelectorAll('.startTime');

            startTimes.forEach((startTimeElement) => {
                const startTime = startTimeElement.textContent;

                const id = startTimeElement.dataset.idAppliance;
                const startTimeDate = new Date(startTime);
                const timerElement = document.getElementById('usageTime-' + id);
                const totalUsageTime = document.getElementById('totalUsageTime-' + id).textContent;
                // console.log(totalUsageTime);

                let updateCounter = 0
                
                setInterval(() => {
                    const status = document.getElementById('status-' + id).textContent;
                    const now = new Date();

                    const elapsed = Math.floor((now - startTimeDate) / 1000); // in seconds
                    // console.log(elapsed);
                    
                    if (status === 'Active') {
                        // Format elapsed time into HH:mm:ss
                        const hours = Math.floor(elapsed / 3600);
                        const minutes = Math.floor((elapsed % 3600) / 60);
                        const seconds = elapsed % 60;

                        // menampilkan waktu yang telah digunakan
                        timerElement.textContent =
                            `Usage Time : ${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

                            // update tiap 5 detik
                        updateCounter++
                        if(updateCounter >= 5){

                            updateUsage(id, elapsed)
                            updateCounter = 0
                        }
                    } else {
                        const hours = Math.floor(totalUsageTime / 3600);
                        const minutes = Math.floor((totalUsageTime % 3600) / 60);
                        const seconds = totalUsageTime % 60;
                        timerElement.textContent =
                            `Usage Time : ${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                    }



                }, 1000);

            })
        }

        // Update database every minute
        function updateUsage(id, elapsed) {
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
                        usage_time: elapsed // Kirim waktu penggunaan yang dihitung
                    })
                })
                // .then(data => console.log(data))
                .catch(error => console.error("Error:", error));
        }
    </script>


</head>

<body onload="realtimeUsage()">

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
