<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $name }}</title>
</head>
<body>
  <h1 class="center">{{ $name }}</h1>

  <table class="center">
    <thead>
      <tr>
        <td>ID</td>
        <td>Name</td>
        <td>Date</td>
      </tr>
      <tbody>
        @foreach ($tes as $i)
            <tr>
              <td>{{ $i->id }}</td>
              <td>{{ $i->name }}</td>
              <td>{{ $i->status }}</td>
            </tr>
        @endforeach
      </tbody>
    </thead>
  </table>
</body>
</html>