<?php
include 'conexion.php';
$mensaje = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $usuario = trim($_POST['usuario']);
  $clave = trim($_POST['clave']);

  $sql_check = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
  $resultado = $conexion->query($sql_check);

  if ($resultado->num_rows > 0) {
    $mensaje = "⚠️ El usuario ya existe.";
  } else {
    $sql = "INSERT INTO usuarios (usuario, clave) VALUES ('$usuario', '$clave')";
    if ($conexion->query($sql)) {
      $mensaje = "✅ Cuenta creada correctamente. <a href='index.php'>Inicia sesión</a>";
    } else {
      $mensaje = "❌ Error al registrar.";
    }
  }
}
$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro</title>
  <style>
    body {
      background-color: #111;
      font-family: Arial, sans-serif;
      color: white;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .registro-container {
      background: #1a1a1a;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(255,0,255,0.4);
      width: 320px;
      text-align: center;
    }
    .registro-container h2 {
      color: #ff00ff;
      margin-bottom: 20px;
    }
    .registro-container input {
      width: 90%;
      padding: 10px;
      margin: 10px 0;
      border-radius: 8px;
      border: none;
      outline: none;
      text-align: center;
    }
    .btn-registrar {
      width: 95%;
      padding: 10px;
      border: none;
      border-radius: 10px;
      background: #ff00ff;
      color: white;
      cursor: pointer;
      transition: 0.3s;
      font-weight: bold;
    }
    .btn-registrar:hover {
      background: #cc00cc;
      transform: scale(1.05);
    }
    .mensaje {
      margin-top: 10px;
      color: #ff5555;
      font-size: 14px;
    }
  </style>
</head>
<body>
  <div class="registro-container">
    <h2>Crear Cuenta</h2>
    <form method="POST">
      <input type="text" name="usuario" placeholder="Usuario" required>
      <input type="password" name="clave" placeholder="Contraseña" required>
      <button type="submit" class="btn-registrar">Registrar</button>
    </form>
    <?php if ($mensaje != ''): ?>
      <p class="mensaje"><?php echo $mensaje; ?></p>
    <?php endif; ?>
  </div>
</body>
</html>
