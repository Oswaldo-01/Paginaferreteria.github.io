<?php
include('database.php'); // Incluir la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir los datos del formulario
    $id = intval($_POST['id']); // Convierte a entero por seguridad
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    if (!empty($_FILES['imagen']['name'])) {
        // Subir la nueva imagen
        $imagen = $_FILES['imagen']['name'];
        $imagen_temp = $_FILES['imagen']['tmp_name'];
        $imagen_dir = 'images/' . $imagen;

        move_uploaded_file($imagen_temp, $imagen_dir);
    } else {
        // Si no se sube una nueva imagen, no modificarla
        $imagen = null;
    }

    // Conectar a la base de datos
    $link = Conectarse();

    if ($imagen) {
        // Si se subió una nueva imagen
        $queryUpdate = "UPDATE productos SET nombre = '$nombre', descripcion = '$descripcion', precio = '$precio', imagen = '$imagen' WHERE id = $id";
    } else {
        // Si no se subió una nueva imagen
        $queryUpdate = "UPDATE productos SET nombre = '$nombre', descripcion = '$descripcion', precio = '$precio' WHERE id = $id";
    }

    $resultUpdate = mysqli_query($link, $queryUpdate);

    if ($resultUpdate) {
        echo "<script>alert('Producto actualizado exitosamente'); window.location.href = 'productos.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar el producto: " . mysqli_error($link) . "');</script>";
    }

    mysqli_close($link);
}
?>