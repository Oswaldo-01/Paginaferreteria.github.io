<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Ferretería</title>
    <link rel="stylesheet" href="style.css"> <!-- Enlazamos el archivo CSS -->
</head>
<body>
    <div class="login-container">
        <h2>Iniciar sesión</h2>
        <form action="procesar_login.php" method="POST">
            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Ingresar</button>
        </form>
    </div>
</body>
</html>