<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h5>Hola mundo</h5>
    <form method = 'POST' action="{{route('contacto.store')}}">
        @csrf
        <div>
            <label for="Nombre">Nombre</label>
            {{html()->text('Nombre')->class('form-control')->id('nombre')}}
             &nbsp;
        </div>
        <div>
            <label for="Seccion">Seccion</label>
            {{html()->text('Seccion')->class('form-control')->id('seccion')}}
             &nbsp;
        </div>
        <div>
            <label for="Mensaje">Mensaje</label>
            {{html()->text('Mensaje')->class('form-control')->id('mensaje')}}
             &nbsp;
        </div>
        <div>
            <label for="Correo Electrónico">Correo Electrónico</label>
            {{html()->text('Correo')->class('form-control')->id('correo')}}
             &nbsp;
        </div>
        <div>
            <label for="Telefono">Telefono</label>
            {{html()->text('Telefono')->class('form-control')->id('telefono')}}
             &nbsp;
        </div>
        <button type="submit">Enviar</button>

    </form>
</body>
</html>