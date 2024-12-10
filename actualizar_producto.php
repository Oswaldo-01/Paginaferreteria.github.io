<?php
include('database.php'); // Incluir la conexión a la base de datos

// Verificar si se ha recibido un ID de producto
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener los datos del producto desde la base de datos
    $link = Conectarse();
    $query = "SELECT * FROM productos WHERE id = $id";
    $result = mysqli_query($link, $query);
    $producto = mysqli_fetch_assoc($result);
} else {
    // Si no se proporciona un ID, redirigir al listado de productos
    header('Location: productos.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Producto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Actualizar Producto</h1>
        <form action="procesar_actualizar_producto.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">

            <label for="nombre">Nombre del Producto:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $producto['nombre']; ?>" required>

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required><?php echo $producto['descripcion']; ?></textarea>

            <label for="precio">Precio:</label>
            <input type="number" step="0.01" id="precio" name="precio" value="<?php echo $producto['precio']; ?>" required>

            <label for="imagen">Imagen del Producto (deja en blanco si no deseas cambiarla):</label>
            <input type="file" id="imagen" name="imagen" accept="image/*">

            <button type="submit">Actualizar Producto</button>
        </form>
    </div>
</body>
</html>