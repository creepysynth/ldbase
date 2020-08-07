<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
<ul>
    @forelse($channels as $channel)
        <li>{{ $channel->name }}</li>
    @empty
        No channels yet
    @endforelse
</ul>
</body>
</html>
