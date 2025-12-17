<?php
// Datos de conexión
$servidor = "localhost";   // o 127.0.0.1
$usuario = "root";         // tu usuario de MySQL
$clave   = "";             // tu contraseña de MySQL
$basedatos = "gymshark_store";   // nombre de tu base de datos

// Crear conexión
$conexion = new mysqli($servidor, $usuario, $clave, $basedatos);

// Verificar conexión
if ($conexion->connect_error) {
    die("❌ Error de conexión: " . $conexion->connect_error);
} else {
    // echo "✅ Conexión exitosa a la BD.";
}
?>
