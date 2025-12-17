// ====== CARRITO ======
let carrito = [];
let total = 0;
const listaCarrito = document.getElementById("lista-carrito");
const totalElemento = document.getElementById("total");

function agregarCarrito(nombre, precio) {
  carrito.push({ nombre, precio });
  actualizarCarrito();
}

function actualizarCarrito() {
  listaCarrito.innerHTML = "";
  if (carrito.length === 0) {
    listaCarrito.innerHTML = "<li>No hay productos en el carrito.</li>";
  } else {
    carrito.forEach((item) => {
      const li = document.createElement("li");
      li.textContent = `${item.nombre} - S/ ${item.precio}`;
      listaCarrito.appendChild(li);
    });
  }
  total = carrito.reduce((acc, item) => acc + item.precio, 0);
  totalElemento.textContent = total.toFixed(2);
}



