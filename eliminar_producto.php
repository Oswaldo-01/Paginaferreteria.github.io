<?php
include('database.php'); // Incluir la conexión a la base de datos

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Conectar a la base de datos
    $link = Conectarse();

    // Eliminar el producto
    $query = "DELETE FROM productos WHERE id = $id";
    if (mysqli_query($link, $query)) {
        echo "<script>alert('Producto eliminado exitosamente'); window.location.href = 'productos.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar el producto'); window.location.href = 'productos.php';</script>";
    }

    mysqli_close($link);
} else {
    echo "<script>alert('No se ha especificado el producto a eliminar'); window.location.href = 'productos.php';</script>";
}
?>