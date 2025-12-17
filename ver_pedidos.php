<?php
include 'conexion.php';

// Leer solo los productos en el carrito, no pedidos
$resultado = $conexion->query("SELECT * FROM carrito ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>🛒 Carrito de Pedidos</title>
<style>
body { background: #111; color: #fff; font-family: 'Poppins', sans-serif; text-align:center; }
table { width: 80%; margin: 40px auto; border-collapse: collapse; background: #222; }
th, td { padding: 12px; border-bottom: 1px solid #444; }
th { background: #00c3ff; color: #000; }
a, button { color: #00c3ff; text-decoration: none; margin: 5px; }
a:hover, button:hover { text-decoration: underline; color: #0099cc; }
.btn-volver { display:inline-block; background:#00c3ff; color:#000; padding:10px 20px; border-radius:6px; text-decoration:none; margin-bottom:20px; }
.btn-volver:hover { background:#0099cc; color:#fff; transform:scale(1.05); transition:0.2s; }
button { background-color:#00c3ff; color:#000; border:none; padding:10px 20px; border-radius:6px; cursor:pointer; }
button:hover { background-color:#0099cc; color:#fff; }
</style>
</head>
<body>

<h1>🛒 Carrito de Compras</h1>

<?php
if ($resultado && $resultado->num_rows > 0) {
    echo "<table>";
    echo "<tr>
            <th>Producto</th>
            <th>Categoría</th>
            <th>Descripción</th>
            <th>Talla</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Fecha</th>
            <th>Acciones</th>
          </tr>";
    $total = 0;
    while ($row = $resultado->fetch_assoc()) {
        $total += $row['precio'] * $row['cantidad'];
        echo "<tr>
                <td>{$row['nombre']}</td>
                <td>{$row['categoria']}</td>
                <td>".(!empty($row['descripcion']) ? $row['descripcion'] : '-')."</td>
                <td>".(!empty($row['talla']) ? $row['talla'] : '-')."</td>
                <td>S/ ".number_format($row['precio'],2)."</td>
                <td>{$row['cantidad']}</td>
                <td>-</td>
                <td><a href='eliminar_pedido.php?id={$row['id']}'>🗑️ Quitar</a></td>
              </tr>";
    }
    echo "<tr><td colspan='8'><strong>Total: S/ ".number_format($total,2)."</strong></td></tr>";
    echo "</table>";
echo '<form method="GET" action="realizar_pedido.php">
        <button type="submit">✅ Realizar Pedido</button>
      </form>';
} else {
    echo "<p>No hay productos en el carrito.</p>";
}
?>

<a href="panel.php" class="btn-volver">◀️ Volver al inicio</a>

</body>
</html>
