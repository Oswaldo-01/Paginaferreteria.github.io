<?php
// Archivo: database.php

function Conectarse() {
    // Configuración de la base de datos
    $host = "localhost"; // Cambiar si tu servidor de base de datos está en otro lugar
    $usuario = "root";   // Usuario de la base de datos
    $contraseña = "";    // Contraseña del usuario (dejar vacío si no tiene)
    $base_datos = "ferreteria"; // Nombre de la base de datos

    // Conexión a la base de datos
    $link = mysqli_connect($host, $usuario, $contraseña, $base_datos);

    // Verificar si la conexión fue exitosa
    if (!$link) {
        die("Error al conectar con la base de datos: " . mysqli_connect_error());
    }

    return $link;
}
?>