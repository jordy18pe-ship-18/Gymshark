<?php
include 'conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accesorios</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

<?php include("navbar.php"); ?>

<h2 class="subtitulo-productos">Accesorios</h2>

<main class="contenedor">
  <section class="productos">
    <?php
    // AHORA SÍ TRAEMOS LA DESCRIPCIÓN
    $sql = "SELECT id, nombre, precio, imagen, descripcion FROM accesorios";
    $resultado = $conexion->query($sql);

    if ($resultado && $resultado->num_rows > 0) {
      while ($row = $resultado->fetch_assoc()) {
        ?>
        <div class="card">
          <img src="<?php echo $row['imagen']; ?>" alt="<?php echo $row['nombre']; ?>">
          <h4><?php echo $row['nombre']; ?></h4>
          <p>S/ <?php echo $row['precio']; ?></p>

          <button 
            class="btn-agregar" 
            onclick="abrirModal(
              '<?php echo $row['id']; ?>', 
              '<?php echo addslashes($row['nombre']); ?>', 
              '<?php echo $row['precio']; ?>',
              '<?php echo addslashes($row['descripcion']); ?>',
              'accesorios', 
              '<?php echo $row['imagen']; ?>'
            )">
            🛒 Agregar al carrito
          </button>
        </div>
        <?php
      }
    } else {
      echo "<p>No hay accesorios disponibles.</p>";
    }
    ?>
  </section>
</main>


<!-- ========== MODAL ========== -->
<div id="modalCarrito" class="modal">
  <div class="modal-contenido">
    <span class="cerrar" onclick="cerrarModal()">&times;</span>

    <img id="imagenProductoModal" src="" alt="Producto">

    <div class="modal-detalles">
      <form action="agregar_pedido.php" method="POST" id="formCarrito">

        <input type="hidden" name="producto_id" id="producto_id">
        <input type="hidden" name="categoria" id="categoria">

        <label>Producto:</label>
        <input type="text" name="nombre" id="nombre" readonly>

        <label>Precio:</label>
        <input type="text" name="precio" id="precio" readonly>

        <label>Descripción:</label>
        <textarea name="descripcion" id="descripcion" readonly></textarea>

        <button type="submit" class="btn-agregar">Confirmar pedido</button>
      </form>
    </div>
  </div>
</div>


<!-- BOTÓN FLOTANTE -->
<button class="btn-ver-pedido" onclick="window.location.href='ver_pedidos.php'">
  📦 Ver pedido
</button>

<script>
function abrirModal(id, nombre, precio, descripcion, categoria, imagen) {
  document.getElementById('modalCarrito').style.display = 'flex';

  document.getElementById('producto_id').value = id;
  document.getElementById('nombre').value = nombre;
  document.getElementById('precio').value = precio;
  document.getElementById('descripcion').value = descripcion;
  document.getElementById('categoria').value = categoria;

  document.getElementById('imagenProductoModal').src = imagen;
}

function cerrarModal() {
  document.getElementById('modalCarrito').style.display = 'none';
}

window.onclick = function(event) {
  const modal = document.getElementById('modalCarrito');
  if (event.target === modal) {
    modal.style.display = "none";
  }
}
</script>

</body>
</html>
