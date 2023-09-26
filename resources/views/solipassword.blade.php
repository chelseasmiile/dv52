<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Restablecimiento de Contraseña</title>
</head>
<body>
    <h1>Solicitud de Restablecimiento de Contraseña</h1>
    <p>Por favor, ingresa tu dirección de correo electrónico a continuación para solicitar un restablecimiento de contraseña.</p>

    <!-- Formulario de solicitud de restablecimiento de contraseña -->
    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div>
            <button type="submit">Enviar Correo de Restablecimiento</button>
        </div>
    </form>
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

</body>
</html>
