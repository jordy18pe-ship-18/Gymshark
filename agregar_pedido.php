<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $precio = $_POST['precio'];
    $talla = $_POST['talla'] ?? '';
    $cantidad = $_POST['cantidad'] ?? 1;
    $descripcion = $_POST['descripcion'] ?? '';

    $sql = "INSERT INTO carrito (nombre, categoria, precio, cantidad, talla, descripcion)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssdiss", $nombre, $categoria, $precio, $cantidad, $talla, $descripcion);
    $stmt->execute();
    $stmt->close();

    header("Location: ver_pedidos.php");
    exit;
}
?>
