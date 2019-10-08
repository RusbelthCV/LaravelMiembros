<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    </head>
    <body>
        @if (!session()->has('admin'))
        <div class="container mt-5">
                <nav class="navbar navbar-expand-lg navbar-primary bg-light">
                    <a class="navbar-brand" href="./login">Identificarse</a>  
                </nav>
            </div>
        @else
            <div class="container mt-5">
                <nav class="navbar navbar-expand-lg navbar-primary bg-light justify-content-around">
                    <a href="./lista" class="btn btn-primary">
                        <strong>Lista miembros</strong>
                    </a>
                    <a href="./add" class="btn btn-success">
                        <strong>Agregar miembro</strong>
                    </a>
                    <a class="btn btn-danger" href="./Logout">
                        <i class="fa fa-sign-out fa-2x" aria-hidden="true"></i>
                    </a>  
                </nav>
            </div>
        @endif
    </body>
</html>
