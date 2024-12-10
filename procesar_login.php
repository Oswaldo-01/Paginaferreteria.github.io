<?php
// Incluir la conexión a la base de datos
include('database.php');

// Verificar si se enviaron los datos del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Conectarse a la base de datos
    $link = Conectarse();

    // Preparar la consulta SQL
    $query = "SELECT id, username, password, rol FROM usuarios WHERE username = ?";
    $stmt = mysqli_prepare($link, $query);

    // Vincular los parámetros
    mysqli_stmt_bind_param($stmt, 's', $username);

    // Ejecutar la consulta
    mysqli_stmt_execute($stmt);

    // Obtener el resultado
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    // Verificar si el usuario existe y la contraseña es correcta
    if ($user && $password == $user['password']) {
        // Si el usuario existe y la contraseña es correcta
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['rol'] = $user['rol'];
        
        // Redirigir al panel de control o a la página principal
        header("Location: productos.php");
    } else {
        // Si el usuario o la contraseña son incorrectos
        echo "Usuario o contraseña incorrectos.";
    }

    // Cerrar la conexión
    mysqli_stmt_close($stmt);
    mysqli_close($link);
}
?>