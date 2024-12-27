<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan.pdf</title>

<style>
  table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th {
  background-color: #d3d3d3;
}
table {
  width: 100%;
}
th,td{
  text-align: center;
  padding: 5px 3px;
}
tr:nth-child(even) {
  background-color: #f4f4f4;
}
</style>

</head>

<body>
    <h1 align="center">{{ $report->description }}</h1>
    <h4>Periode : {{ $report->date }} to {{ $report->time_span }}</h4>
    <p>
        <span>Total Power Used : {{ $summaries->sum('total_power') }} Watt/Hour</span><br>
        <span id="total-usage-time">
            @php
                $time = $summaries->sum('total_usage_time');
                $hours = floor($time / 3600);
                $minutes = floor(($time % 3600) / 60);
                $seconds = $time % 60;
            @endphp

            Total Usage Time : {{ $hours }}Jam {{ $minutes }}menit {{ $seconds }}detik</span>
    </p>

    <table align="center" >
        <thead >
            <tr >
                <th>No</th>
                <th>Appliance</th>
                <th>Total Power</th>
                <th>Usage Time</th>
                <th>Date</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($summaries as $i)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $i->appliance->name }}</td>
                    <td>{{ $i->total_power }} Watt/Hour</td>
                    <td>
                        @php
                            $hours = floor($i->total_usage_time / 3600);
                            $minutes = floor(($i->total_usage_time % 3600) / 60);
                            $seconds = $i->total_usage_time % 60;
                        @endphp
                        {{ $hours }}Jam {{ $minutes }}menit {{ $seconds }}detik</td>
                    <td>{{ $i->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
