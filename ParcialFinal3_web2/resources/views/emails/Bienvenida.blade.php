<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bienvenida a Groot Mascotas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
    <h1 class="text-center text-secondary">Bienvenido a GrootMascotas</h1>
    <h1 class="text-info">Asunto: {{ $subject }}</h1>

    <div class="container">
        <h3 class="text-info">Su registro en la aplicación se ha generado de forma correcta!</h3>
        <p>
            Ya puede beneficiarse de las acciones que contiene la app, de la gestión de administradores
            y de las mascotas
        </p>
    </div>

    <a href="{{ url('/login') }}" class="btn btn-success">
        Ya puedes iniciar sesión
    </a>

</body>
</html>
