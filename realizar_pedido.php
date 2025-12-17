<?php
include 'conexion.php';

$mensaje = "";
$metodos_pago = ["Tarjeta de crédito","Tarjeta de débito","PayPal","Pago en efectivo","Transferencia bancaria"];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_usuario = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $metodo_pago = $_POST['metodo_pago'];

    // Traer productos del carrito
    $carrito = $conexion->query("SELECT * FROM carrito");
    while ($row = $carrito->fetch_assoc()) {
        $stmt = $conexion->prepare("INSERT INTO pedidos 
            (nombre, categoria, descripcion, precio, cantidad, talla, email, telefono, direccion, metodo_pago)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "sssdisssss",
            $row['nombre'],
            $row['categoria'],
            $row['descripcion'],
            $row['precio'],
            $row['cantidad'],
            $row['talla'],
            $nombre_usuario,
            $email,
            $direccion,
            $metodo_pago
        );
        $stmt->execute();
        $stmt->close();
    }

    // Vaciar carrito
    $conexion->query("DELETE FROM carrito");

    $mensaje = "🎉 Pedido realizado con éxito. Gracias $nombre_usuario.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Realizar Pedido</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css">
<style>
body { font-family: Arial, sans-serif; background:##000; display:flex; justify-content:center; align-items:center; min-height:100vh; margin:0; }
.pedido-container { background:#fff; padding:30px 40px; border-radius:12px; box-shadow:0 4px 15px rgba(0,0,0,0.2); width:100%; max-width:500px; }
h2,h3{text-align:center; color:#333;}
form label{display:block; margin:10px 0 5px; font-weight:bold;}
form input[type="text"], form input[type="email"], form input[type="tel"] {width:100%; padding:10px; margin-bottom:15px; border-radius:6px; border:1px solid #0f0f0fff;}
.metodos-pago div{margin-bottom:10px;}
form button {width:100%; padding:12px; background:#00b894; color:white; border:none; border-radius:6px; font-size:16px; cursor:pointer; transition:0.3s;}
form button:hover{background:#019875;}
.mensaje{text-align:center; color:green; font-weight:bold; margin-bottom:20px;}
</style>
</head>
<body>
<div class="pedido-container">
    <h2>Formulario de Pedido</h2>
    <?php if(!empty($mensaje)) { echo "<p class='mensaje'>$mensaje</p>"; } ?>
    <form action="" method="POST">
        <h3>Datos del usuario</h3>
        <label>Nombre:</label><input type="text" name="nombre" required>
        <label>Correo electrónico:</label><input type="email" name="email" required>
        <label>Teléfono:</label><input type="tel" name="telefono" required>
        <label>Dirección:</label><input type="text" name="direccion" required>

        <h3>Método de pago</h3>
        <div class="metodos-pago">
            <?php foreach($metodos_pago as $i => $m) { ?>
                <div>
                    <input type="radio" id="pago<?php echo $i; ?>" name="metodo_pago" value="<?php echo $m; ?>" required>
                    <label for="pago<?php echo $i; ?>"><?php echo $m; ?></label>
                </div>
            <?php } ?>
        </div>

        <button type="submit">Realizar Pedido</button>
    </form>
</div>
</body>
</html>
