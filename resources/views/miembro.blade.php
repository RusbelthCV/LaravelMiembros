<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Datos del miembro</title>
</head>
<body>
    @if(!session()->has('admin'))
        @php
            echo "No tienes permisos para estar aquí";
            header("refresh:2;url=../");
        @endphp
    @else
        <div class="container mt-5 text-center">
            <form action="{{action('miembros@editar')}}" class="col-6" method = "POST" >
                {{csrf_field()}}
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" name = "nombre" id = "nombre" value = "{{$datos[0]->nombre}}" />
                </div>
                <div class="form-group">
                    <label for="email">Correo:</label>
                    <input type="email" class="form-control" name = "email" id = "email" value = "{{$datos[0]->correo}}" />
                </div>
                <div class="form-group">
                    <label for="telefono">Telefono:</label>
                    <input type="text" name="telefono" id="telefono" class="form-control" value = "{{$datos[0]->telefono}}" minlength="9" maxlength="9" />
                </div>
                <div class="form-group">
                    <label for="nacimiento">Fecha de nacimiento: </label>
                    <input type="date" class="form-control" name = "nacimiento" id = "nacimiento" value = "{{$datos[0]->nacimiento}}" max = "{{date('Y').'-'.date('m').'-'.date('d')}}" />
                </div>
                <div class="form-group">
                    <label for="inscripcion">Fecha de inscripcion: </label>
                    <input type="date" class="form-control" name = "inscripcion" id = "inscripcion" value = "{{$datos[0]->inscripcion}}" max = "{{date('Y').'-'.date('m').'-'.date('d')}}" />
                </div>
                <div class="form-group">
                    <label for="genero">Genero:</label>
                    <select name="genero" id="genero" class="custom-selec">
                        <option value="M"
                            @if($datos[0]->genero == 'M')
                                selected
                            @endif
                        >Mujer</option>  
                        <option value="H"
                            @if($datos[0]->genero == 'H')
                                selected
                            @endif
                        >Hombre</option>    
                    </select>
                    <input type="hidden" name="id" class="form-control" value = {{$datos[0]->id}}  />
                    </div>
                
                <div class="row justify-content-around">
                    <button class="btn btn-success btn-lg" type = "submit">Guardar Cambios</button>
                    <div class="btn-group h-50">
                        <a href="../" class="btn btn-primary btn-lg ml-2">
                            <i class="fa fa-home fa-3x" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                @if(session()->has('mensaje'))
                    
                    @if(!session('correo'))
                        <div class="alert alert-danger mt-3">
                            <strong>{{session('mensaje')}}</strong>
                        </div>
                    
                    @elseif(!session('telefono'))
                        <div class="alert alert-danger mt-3">
                            <strong>{{session('mensaje')}}</strong>
                        </div>
                
                    @elseif(!session('telefono') && !session('correo'))
                        <div class="alert alert-danger mt-3">
                            <strong>{{session('mensaje')}}</strong>
                        </div>
                    @else 
                        <div class="alert alert-success">
                            <strong>{{session('mensaje')}}</strong>
                        </div>
                    @endif
                @endif
            </form>
            
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script type = "text/javascript" src="{{asset('script/miembro.js')}}" ></script>
        <script src="{{asset('script/eventos.js')}}"></script>
    @endif
</body>
</html>