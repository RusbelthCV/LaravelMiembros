<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">    
    <title>Login</title>
</head>
<body>
    <div class="container d-flex justify-content-center">
      <div class="row align-items-center mt-5">
        <form action="{{action('Login@comprobar')}}" method="POST" class="">
          {{csrf_field()}}
          <div class="form-group">
            <label for="email">Correo</label>
            <input type="email" required name="email" id="email" class="form-control" placeholder="Correo electrónico..." aria-describedby="helpId">
            <small id="helpId" class="text-muted">Inserta tu correo electrónico</small>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña..." aria-describedby="helpId">
            <small id="helpId" class="text-muted">Contraseña</small>
          </div>
          <button class="btn btn-success btn-lg">Iniciar Sesión</button>
          @if(session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert" id = "divAlert">
              <strong>Credenciales erroneas</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" id = "alert" >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif
        </form>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="{{asset('script/eventos.js')}}"></script>
</body>
</html>