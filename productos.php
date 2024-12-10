<?php
include('database.php'); // Incluir la conexión a la base de datos

// Obtener el texto de búsqueda
$buscar = isset($_GET['buscar']) ? $_GET['buscar'] : '';

// Conectar a la base de datos
$link = Conectarse();

// Si hay algo en el campo de búsqueda, filtramos los productos
if ($buscar) {
    $query = "SELECT * FROM productos WHERE nombre LIKE '%$buscar%' OR descripcion LIKE '%$buscar%'";
} else {
    // Si no hay búsqueda, mostramos todos los productos
    $query = "SELECT * FROM productos";
}

$result = mysqli_query($link, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Productos</title>
    <link rel="stylesheet" href="productos.css"> <!-- Archivo CSS exclusivo -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="main-container">
        <!-- Sección de encabezado -->
        <header class="header-negocio">
            <h1>Ferretería Martínez</h1>
        </header>

        <!-- Título de productos disponibles -->
        <header class="main-header">
            <h2>Productos Disponibles</h2>
            
        </header>

        <!-- Formulario de búsqueda (justo debajo del título) -->
        <form method="get" action="productos.php" class="form-busqueda">
            <input type="text" name="buscar" id="buscarProducto" class="buscador" placeholder="Buscar productos..." value="<?php echo htmlspecialchars($buscar); ?>">
            <a href="agregar_producto.php" class="btn agregar-btn">Agregar Producto</a>
        </form>

        <!-- Sección del listado de productos -->
        <section class="productos-grid">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <article class="producto-card">
                    <!-- Imagen del producto -->
                    <figure class="producto-figura">
                        <img src="images/<?php echo htmlspecialchars($row['imagen']); ?>" alt="<?php echo htmlspecialchars($row['nombre']); ?>" class="producto-imagen">
                    </figure>
                    
                    <!-- Información del producto -->
                    <div class="producto-info">
                        <h2><?php echo htmlspecialchars($row['nombre']); ?></h2>
                        <p class="descripcion"><?php echo htmlspecialchars($row['descripcion']); ?></p>
                        <p class="precio"><?php echo "$" . number_format($row['precio'], 2); ?></p>
                    </div>
                    
                    <!-- Acciones -->
                    <div class="producto-acciones">
                        <a href="actualizar_producto.php?id=<?php echo $row['id']; ?>" class="btn actualizar-btn">Actualizar</a>
                        <a href="eliminar_producto.php?id=<?php echo $row['id']; ?>" class="btn eliminar-btn" onclick="return confirm('¿Estás seguro de eliminar este producto?');">Eliminar</a>
                    </div>
                </article>
            <?php endwhile; ?>
        </section>
    </div>
</body>
</html>