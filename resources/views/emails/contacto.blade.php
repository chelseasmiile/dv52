<!DOCTYPE html>
<html>
<head>
    <title>Nuevo mensaje de contacto</title>
</head>
<body>
    <p>Nombre: {{ $data['Nombre'] }}</p>
    <p>Sección: {{ $data['Seccion'] }}</p>
    <p>Mensaje: {{ $data['Mensaje'] }}</p>
    <p>Correo electrónico: {{ $data['Correo'] }}</p>
    <p>Teléfono: {{ $data['Telefono'] }}</p>
</body>
</html>
