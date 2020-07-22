<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
            <h1>Services</h1>
            <a href="/services?active=1" class="btn btn-primary">Active</a>
            <a href="/services?active=0" class="btn btn-warning">Inactive</a>
            <a href="/services" class="btn btn-success">All</a>
            <br><br>
            <ul>
                @forelse($services as $service)
                    <li><a href="/services/{{ $service->id }}">{{ $service->name }}</a></li>
                @empty
                    No services available
                @endforelse
            </ul>
            <br>
            <a href="/services/create" class="btn btn-success">Create service</a>
        </div>
    </body>
</html>
