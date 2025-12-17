<?php
include 'conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Colección para Mujeres</title>
<link rel="stylesheet" href="style.css">

  
</head>

<body>
 <?php include("navbar.php"); ?>
<h2 class="subtitulo-productos">Colección para Mujeres</h2>

<main class="contenedor">
  <section class="productos">
    <?php
    $sql = "SELECT id, nombre, precio, imagen FROM productos_mujer";
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
            onclick="abrirModal('<?php echo $row['id']; ?>', '<?php echo addslashes($row['nombre']); ?>', '<?php echo $row['precio']; ?>', 'productos_mujer', '<?php echo $row['imagen']; ?>')">
            🛒 Agregar al carrito
          </button>
        </div>
        <?php
      }
    } else {
      echo "<p>No hay productos disponibles.</p>";
    }
    ?>
  </section>
</main>

<!-- ===== Modal flotante ===== -->
<div id="modalCarrito" class="modal">
  <div class="modal-contenido">
    <span class="cerrar" onclick="cerrarModal()">&times;</span>

    <!-- Imagen del producto -->
    <img id="imagenProductoModal" src="" alt="Producto seleccionado">

    <!-- Contenedor de detalles -->
    <div class="modal-detalles">
      <form action="agregar_pedido.php" method="POST" id="formCarrito">
        <input type="hidden" name="producto_id" id="producto_id">
        <input type="hidden" name="categoria" id="categoria">

        <label>Producto:</label>
        <input type="text" name="nombre" id="nombre" readonly>

        <label>Precio:</label>
        <input type="text" name="precio" id="precio" readonly>

        <label>Talla:</label>
        <select name="talla" id="talla" required>
          <option value="">Seleccione una talla</option>
        </select>
        <p id="sinTallas" style="color:gray; display:none;">Sin tallas disponibles</p>

        <button type="submit" class="btn-agregar">Confirmar pedido</button>
      </form>
    </div>
  </div>
</div>

<button class="btn-ver-pedido" onclick="window.location.href='ver_pedidos.php'">
  📦 Ver pedido
</button>

<?php
// ===== Traer tallas desde la base de datos =====
$sqlTallas = "SELECT id, talla FROM productos_mujer";
$resultadoTallas = $conexion->query($sqlTallas);

$tallasPorProducto = [];
if($resultadoTallas) {
  while($rowT = $resultadoTallas->fetch_assoc()) {
    if(!empty($rowT['talla'])) {
      $tallasPorProducto[$rowT['id']] = explode(",", $rowT['talla']);
    } else {
      $tallasPorProducto[$rowT['id']] = [];
    }
  }
}
$conexion->close();
?>

<script>
const tallasPorProducto = <?php echo json_encode($tallasPorProducto); ?>;

function abrirModal(id, nombre, precio, categoria, imagen) {
  document.getElementById('modalCarrito').style.display = 'flex';
  document.getElementById('producto_id').value = id;
  document.getElementById('nombre').value = nombre;
  document.getElementById('precio').value = precio;
  document.getElementById('categoria').value = categoria;

  document.getElementById('imagenProductoModal').src = imagen;

  const selectTalla = document.getElementById('talla');
  const sinTallas = document.getElementById('sinTallas');

  selectTalla.innerHTML = '<option value="">Seleccione una talla</option>';

  if (tallasPorProducto[id] && tallasPorProducto[id].length > 0) {
    sinTallas.style.display = 'none';
    selectTalla.style.display = 'block';
    tallasPorProducto[id].forEach(t => {
      const option = document.createElement('option');
      option.value = t.trim();
      option.textContent = t.trim();
      selectTalla.appendChild(option);
    });
  } else {
    selectTalla.style.display = 'none';
    sinTallas.style.display = 'block';
  }
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
