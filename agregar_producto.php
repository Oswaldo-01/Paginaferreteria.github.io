<?php
include('database.php'); // Conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir los datos del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $imagen = $_FILES['imagen']['name'];

    // Subir la imagen
    $target_dir = "images/"; // Directorio donde se guardarán las imágenes
    $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
    move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file);

    // Conectar a la base de datos
    $link = Conectarse();

    // Insertar producto en la base de datos
    $queryInsert = "INSERT INTO productos (nombre, descripcion, precio, imagen) 
                    VALUES ('$nombre', '$descripcion', '$precio', '$imagen')";
    $resultInsert = mysqli_query($link, $queryInsert);

    if ($resultInsert) {
        echo "<script>alert('Producto agregado exitosamente'); window.location.href = 'productos.php';</script>";
    } else {
        echo "<script>alert('Error al agregar el producto: " . mysqli_error($link) . "');</script>";
    }

    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
    <link rel="stylesheet" href="style.css"> <!-- Agrega tu archivo de estilo -->
</head>
<body>
    <div class="container">
        <h1>Agregar Nuevo Producto</h1>
        <form action="agregar_producto.php" method="POST" enctype="multipart/form-data">
            <label for="nombre">Nombre del Producto:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required></textarea>

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" step="0.01" required>

            <label for="imagen">Imagen del Producto:</label>
            <input type="file" id="imagen" name="imagen" accept="image/*" required>

            <button type="submit">Agregar Producto</button>
        </form>
    </div>
</body>
</html>