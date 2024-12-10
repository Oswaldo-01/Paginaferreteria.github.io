<?php
include('database.php'); // Incluir la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['producto'];

    // Conectar a la base de datos
    $link = Conectarse();

    // Eliminar el producto
    $queryDelete = "DELETE FROM productos WHERE id = $id";
    $resultDelete = mysqli_query($link, $queryDelete);

    if ($resultDelete) {
        echo "<script>alert('Producto eliminado exitosamente'); window.location.href = 'productos.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar el producto: " . mysqli_error($link) . "');</script>";
    }

    mysqli_close($link);
}
?>