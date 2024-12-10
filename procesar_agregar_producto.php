<?php
include('database.php'); // Incluir la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir los datos del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    // Subir la imagen
    $imagen = $_FILES['imagen']['name'];
    $imagen_temp = $_FILES['imagen']['tmp_name'];
    $imagen_dir = 'images/' . $imagen;  // Ruta donde se guardará la imagen

    if (move_uploaded_file($imagen_temp, $imagen_dir)) {
        // Conectar a la base de datos
        $link = Conectarse();

        // Insertar el nuevo producto
        $queryInsert = "INSERT INTO productos (nombre, descripcion, precio, imagen) 
                        VALUES ('$nombre', '$descripcion', '$precio', '$imagen')";

        $resultInsert = mysqli_query($link, $queryInsert);

        if ($resultInsert) {
            echo "<script>alert('Producto agregado exitosamente'); window.location.href = 'productos.php';</script>";
        } else {
            echo "<script>alert('Error al agregar el producto: " . mysqli_error($link) . "');</script>";
        }

        mysqli_close($link);
    } else {
        echo "<script>alert('Error al subir la imagen.');</script>";
    }
}
?>