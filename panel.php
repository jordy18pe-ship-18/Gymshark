<?php
session_start(); // Inicia la sesión
include("conexion.php");

// Si no hay usuario logueado, redirige al login
if(!isset($_SESSION['usuario'])){
    header("Location: index.php");
    exit();
}

$sql = "SELECT * FROM productos";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>GymShark Store</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- ======= NAVBAR ======= -->
  <header>
    <a href="#" class="logo">GYMSHARK<span class="logo-accent">Store</span></a>
   

    <nav>
      <ul>
        <li><a href="panel.php">Inicio</a></li>
        <li><a href="hombre.php">Hombres</a></li>
        <li><a href="mujer.php">Mujeres</a></li>
        <li><a href="accesorios.php">Accesorios</a></li>
        <?php if(isset($_SESSION['usuario'])): ?>
  <li><a href="logout.php">Cerrar Sesión [ <?php echo $_SESSION['usuario']; ?> ]</a></li>
<?php endif; ?>

        <li><a href="Ofertas"></a></li>
        <li><a href="for_producto.php"></a></li>
        <li><a href="crud.php"></a></li>
        
      </ul>
    </nav>
  </header>

  <!-- ======= HERO con VIDEO ======= -->
  <section class="hero">
    <video autoplay muted loop playsinline class="video-fondo">
      <source src="img/gymshark.mp4" type="video/mp4">
      Tu navegador no soporta videos.
    </video>
    <div class="overlay-texto">
      <h1>Rinde al máximo con estilo</h1>
      <p>Nueva colección ya disponible</p>
      <a href="#" class="btn-hero">Explorar</a>
    </div>
  </section>

  <!-- SECCIÓN MOTIVADORA  -->
  <section class="motivacion">
    <div class="contenedor-texto">
      <h2>Supera tus límites</h2>
      <p>Entrena con la mejor energía y viste con estilo.  
        Nuestra ropa está diseñada para rendir contigo en cada desafío.</p>
      <a href="#" class="btn-motivacion">Descubre la colección</a>
    </div>
  </section>
<!-- SECCIÓN MOTIVACIÓN DE COMPRA -->
<section class="motivacion-compra">
  <h2>Entrena Mejor. Compra Mejor.</h2>

  <div class="grid-motivacion">

    <div class="card-motivacion">
      <h3>Diseñado para rendir</h3>
      <p>Entrena sin límites con prendas creadas para el máximo desempeño.</p>
      <span>✔ Calidad Premium</span>
    </div>

    <div class="card-motivacion">
      <h3>Comodidad en cada movimiento</h3>
      <p>Libertad total para levantar, correr y superar tus marcas.</p>
      <span>✔ Ajuste perfecto</span>
    </div>

    <div class="card-motivacion">
      <h3>Estilo que impone respeto</h3>
      <p>Tu esfuerzo merece verse reflejado dentro y fuera del gym.</p>
      <span>✔ Diseño moderno</span>
    </div>

    <div class="card-motivacion">
      <h3>Entrena como un atleta</h3>
      <p>La ropa que usan los que entrenan en serio.</p>
      <span>✔ Alto rendimiento</span>
    </div>

    <div class="card-motivacion">
      <h3>No entrenes con cualquier cosa</h3>
      <p>Elige calidad, resistencia y confort en cada sesión.</p>
      <span>✔ Material resistente</span>
    </div>

    <div class="card-motivacion">
      <h3>Invierte en tu progreso</h3>
      <p>Cada repetición cuenta, tu ropa también.</p>
      <span>✔ Pensado para ti</span>
    </div>

  </div>
</section>

  <main class="contenedor">

    <!--  Título fuera del grid de productos -->
    <h2 class="subtitulo-productos">Productos más comprados</h2>

    <div class="productos">
      <?php while($fila = $resultado->fetch_assoc()) { ?>
        <div class="card">
          <?php if(!empty($fila['imagen'])) { ?>
            <img src="<?php echo $fila['imagen']; ?>" alt="<?php echo $fila['nombre']; ?>">
          <?php } else { ?>
            <img src="img/no-image.png" alt="Sin imagen">
          <?php } ?>
          <h4><?php echo $fila['nombre']; ?></h4>
          <p>S/ <?php echo number_format($fila['precio'], 2); ?></p>
          <button onclick="agregarCarrito('<?php echo $fila['nombre']; ?>', <?php echo $fila['precio']; ?>)">Agregar al carrito</button>
        </div>
      <?php } ?>
    </div>
  </main>

  <!-- SECCIÓN COLABORADORES -->
  <section class="colaboradores">
    <h2>Nuestros Colaboradores</h2>
    <div class="grid-colaboradores">
      <div class="card-colaborador">
        <img src="https://barbend.com/wp-content/uploads/2024/09/Untitled-design-2024-09-09T161306.077.jpg" alt="Chris Bumstead">
        <h3>Chris Bumstead (Cbum)</h3>
        <p>Culturista profesional canadiense y multicampeón de Míster Olympia Classic Physique. Una de las figuras más grandes de Gymshark.</p>
      </div>
      <div class="card-colaborador">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQBSUt4rkPebESYcom0W4-ibAxIsCDCOEaZAQ&s" alt="David Laid">
        <h3>David Laid</h3>
        <p>Influencer que documentó su transformación física. De atleta pasó a Director Creativo de Gymshark.</p>
      </div>
      <div class="card-colaborador">
        <img src="https://i.ytimg.com/vi/1LdBAuZ7WBE/hq720.jpg" alt="Sam Sulek">
        <h3>Sam Sulek</h3>
        <p>Joven bodybuilder e influencer muy popular en YouTube. Colaborador de alto perfil en Gymshark.</p>
      </div>
      <div class="card-colaborador">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRVi2NNIv-aXedpkyzqyYR53OSktbKS2Q-AZ_vh3jU2wg-SO5LN00UcHbqzXF_Z23Kh8zU&usqp=CAU" alt="Whitney Simmons">
        <h3>Belcast</h3>
        <p>Influencer fitness reconocida por su estilo motivacional. Ha lanzado colecciones exclusivas con Gymshark.</p>
      </div>
    </div>
  </section>

  <footer>
    &copy; 2025 GymShark Store - Desarrollado por JonathanQ.
  </footer>

            
  <script src="script.js"></script>
</body>
</html>
