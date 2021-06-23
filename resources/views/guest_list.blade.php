<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affiliate Guest List</title>
</head>
<body>
    <h1>Guest List</h1>
    <ul>
    @foreach ($guestList as $guest)
    <li>ID:{{ $guest['id'] }}   Name:{{ $guest['name'] }}</li>
    @endforeach
    </ul>
</body>
</html>