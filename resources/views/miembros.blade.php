<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Lista Miembros</title>
</head>
<body>
    @if(!session()->has('admin'))
        @php
            echo "No tienes permisos para estar aquí";
            header("refresh:2;url=./");
        @endphp
    @else
        <div class="container mt-5">
            {{-- Buscador --}}
            <div class="row justify-content-around">
                <div class="row mb-5 ml-1">
                    <form action = "" method = "POST">
                        <div class="form-group">
                            <input type="search" name="busqueda" id="busqueda" class="form-control" />
                        </div>
                    </form>
                </div>
                <div class="btn-group h-50">
                    <a href="./" class="btn btn-primary btn-lg">
                        <i class="fa fa-home fa-3x" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        
            <div class="table-responsive">
                <table class="table ">
                    <thead class="table-dark">
                        <td></td>
                        <td>Nombre</td>
                        <td>Género</td>
                        <td>Correo</td>
                        <td>Teléfono</td>
                        <td>Fecha Nacimiento</td>
                        <td>Fecha Inscripción</td>
                        <td>Editar</td>
                        <td>Borrar</td>
                    </thead>
                    <tbody id="resultados">
                        @foreach ($miembros as $item )
                            <tr class="bg-info text-light">
                            @foreach ($item as $value)
                                <td>
                                    @if($value == $item->id)
                                        {{$value = ""}}
                                    @endif
                                    @if($value == 'H')
                                        <i class="fa fa-mars fa-2x" aria-hidden="true"></i>
                                    @elseif($value == 'M')
                                        <i class="fa fa-venus fa-2x" aria-hidden="true"></i>
                                    @else
                                        {{$value}}
                                    @endif
                                </td>
                            @endforeach
                            <td>
                            <a href = "./editar/{{$item->id}}" class="btn btn-success btn-lg">
                                <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                            </a>
                            </td>
                            <td>
                                <a href = "./borrar/{{$item->id}}" class="btn btn-danger btn-lg">
                                    <i class="fa fa-trash-o fa-2x" aria-hidden="true"></i>
                                </a>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="{{asset('script/busqueda.js')}}"></script>
    @endif
</body>
</html>