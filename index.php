
<?php
session_start();
include 'conexion.php'; 

if (isset($_SESSION['usuario'])) {
  header("Location: index.php");
  exit();
}

$mensaje = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $usuario = trim($_POST['usuario']);
  $clave = trim($_POST['clave']);

  $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND clave = '$clave'";
  $resultado = $conexion->query($sql);

  if ($resultado->num_rows > 0) {
    $_SESSION['usuario'] = $usuario;
    header("Location: panel.php");
    exit();
  } else {
    $mensaje = "❌ Usuario o contraseña incorrectos.";
  }
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar Sesión</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      background-color: #111;
      font-family: Arial, sans-serif;
      color: white;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .login-container {
      background: #1a1a1a;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(255,0,255,0.4);
      width: 320px;
      text-align: center;
    }

    .login-container h2 {
      color: #ff00ff;
      margin-bottom: 20px;
    }

    .login-container input {
      width: 90%;
      padding: 10px;
      margin: 10px 0;
      border-radius: 8px;
      border: none;
      outline: none;
      text-align: center;
    }

    .btn-login {
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

    .btn-login:hover {
      background: #cc00cc;
      transform: scale(1.05);
    }

    .mensaje {
      margin-top: 10px;
      color: #ff5555;
      font-size: 14px;
    }

    .registro-link {
      display: block;
      margin-top: 15px;
      color: #ff00ff;
      text-decoration: none;
      font-size: 14px;
    }

    .registro-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <h2>Iniciar Sesión</h2>
    <form action="" method="POST">
      <input type="text" name="usuario" placeholder="Usuario" required>
      <input type="password" name="clave" placeholder="Contraseña" required>
      <button type="submit" class="btn-login">Entrar</button>
    </form>
    <?php if ($mensaje != ''): ?>
      <p class="mensaje"><?php echo $mensaje; ?></p>
    <?php endif; ?>
    <a href="registro.php" class="registro-link">Crear una cuenta</a>
  </div>

</body>
</html>
