-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-12-2025 a las 22:53:18
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gymshark_store`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesorios`
--

CREATE TABLE `accesorios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `accesorios`
--

INSERT INTO `accesorios` (`id`, `nombre`, `descripcion`, `precio`, `imagen`) VALUES
(1, 'Cinturilla de entrenamiento', 'Cinturilla ajustable para soporte lumbar y ejercicios de fuerza.', 39.90, 'img/cinturilla1.jpg'),
(2, 'Guantes de levantamiento', 'Guantes acolchados para proteger las manos durante pesas y entrenamiento intenso.', 24.50, 'img/guantes2.jpg'),
(3, 'Botella deportiva de agua', 'Botella reutilizable de 1L, libre de BPA y resistente a impactos.', 19.90, 'img/botella2.jpg'),
(4, 'Toalla deportiva microfibra', 'Toalla ligera y absorbente ideal para gimnasio y actividades al aire libre.', 12.90, 'img/toalla1.jpg'),
(5, 'Banda elástica de resistencia', 'Banda para entrenamiento de fuerza y estiramientos, ideal para ejercicios funcionales.', 15.50, 'img/banda3.jpg'),
(6, 'Rodilleras deportivas', 'Protección para rodillas durante entrenamientos de alto impacto y levantamiento de pesas.', 29.90, 'img/rodilleras1.jpg'),
(7, 'Cuerda para saltar ajustable', 'Cuerda ligera y rápida para entrenamiento cardiovascular y coordinación.', 14.90, 'img/cuerda1.jpg'),
(8, 'Mochila deportiva compacta', 'Mochila ligera con compartimento para ropa y accesorios de entrenamiento.', 49.90, 'img/mochila2.jpg'),
(9, 'Gorra deportiva transpirable', 'Gorra con visera curva y material que permite ventilación durante entrenamientos.', 18.50, 'img/gorra2.jpg'),
(10, 'Calcetas deportivas acolchadas', 'Calcetas con soporte en arco y acolchado extra para correr o entrenar en gimnasio.', 9.90, 'img/calcetas1.jpg'),
(11, 'Muñequeras de entrenamiento', 'Muñequeras ajustables para soporte en ejercicios con pesas y barras.', 11.90, 'img/muñequera1.jpg'),
(12, 'Cinturón de hidratación para correr', 'Cinturón con bolsillo para botellas y objetos personales durante running.', 34.90, 'img/cinturonhidra1.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1,
  `talla` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1,
  `talla` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `metodo_pago` varchar(100) DEFAULT NULL,
  `fecha_pedido` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`, `imagen`) VALUES
(1, 'Leggings Performance', 120.00, 'img/p1.avif'),
(2, 'Camiseta DryFit', 80.00, 'img/p2.jpg'),
(3, 'Shorts Training', 90.00, 'img/p3.webp'),
(4, 'Sudadera Classic', 150.00, 'img/p4.avif'),
(5, 'Top Deportivo Seamless', 100.00, 'img/p5.webp'),
(6, 'Joggers Essential', 130.00, 'img/p6.webp');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_hombre`
--

CREATE TABLE `productos_hombre` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `talla` varchar(10) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) DEFAULT 0,
  `imagen` varchar(255) DEFAULT NULL,
  `categoria` varchar(50) DEFAULT 'Hombre'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos_hombre`
--

INSERT INTO `productos_hombre` (`id`, `nombre`, `descripcion`, `talla`, `color`, `precio`, `stock`, `imagen`, `categoria`) VALUES
(1, 'Camiseta GymShark Fit', 'Camiseta de entrenamiento ligera y transpirable.', 'S,M', 'Negro', 79.90, 15, 'img/hombre1.jpg', 'Hombre'),
(2, 'Short GymShark Motion', 'Short deportivo con ajuste elástico.', 'S,M,L', 'Gris', 89.90, 10, 'img/hombre2.jpg', 'Hombre'),
(3, 'Sudadera GymShark Pro', 'Sudadera con capucha, ideal para clima frío.', 'S,M,L', 'Azul oscuro', 119.90, 8, 'img/hombre3.jpg', 'Hombre'),
(4, 'Tank GymShark Power', 'Polo sin mangas ideal para pesas.', 'S,M,L', 'Blanco', 69.90, 20, 'img/hombre4.jpg', 'Hombre'),
(5, 'Jogger GymShark Elite', 'Jogger con bolsillos laterales y cierre.', 'S,M,L', 'Negro', 129.90, 12, 'img/hombre5.jpg', 'Hombre'),
(13, 'Jogger Deportivo Gris', 'Pantalón tipo jogger de algodón y elastano, cómodo para entrenamientos y uso diario.', 'S,M,L', 'Negro', 119.90, 0, 'img/hombre6.jpg', 'Hombre'),
(14, 'Camiseta Sin Mangas GymFit', 'Camiseta ligera y transpirable ideal para rutinas intensas.', 'S,M,L', 'Negro', 79.90, 0, 'img/hombre7.jpg', 'Hombre'),
(15, 'Sudadera con Capucha Negra', 'Sudadera con capucha de tejido suave, diseño moderno y corte ajustado.', 'S,M,L', 'Negro', 149.90, 0, 'img/hombre8.jpg', 'Hombre'),
(16, 'Pantalón Corto Compresión', 'Short con tecnología de compresión para un mejor rendimiento muscular.', 'S,M,L', 'Negro', 89.90, 0, 'img/hombre9.jpg', 'Hombre'),
(17, 'Zapatillas GymShark Runner', 'Zapatillas ligeras con suela antideslizante y máxima amortiguación.', 'S,M,L', 'Negro', 299.90, 0, 'img/hombre10.jpg', 'Hombre'),
(18, 'Camiseta Térmica ProLine', 'Camiseta térmica de manga larga ideal para entrenamientos en clima frío.', 'S,M,L', 'Negro', 99.90, 0, 'img/hombre11.jpg', 'Hombre'),
(23, 'Guantes de Entrenamiento', 'Guantes con refuerzo de agarre y ventilación para evitar la sudoración.', 'S,M,L', 'Negro', 59.90, 0, 'img/hombre12.jpg', 'Hombre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_mujer`
--

CREATE TABLE `productos_mujer` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `talla` varchar(10) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) DEFAULT 0,
  `imagen` varchar(255) DEFAULT NULL,
  `categoria` varchar(50) DEFAULT 'Mujer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos_mujer`
--

INSERT INTO `productos_mujer` (`id`, `nombre`, `descripcion`, `talla`, `color`, `precio`, `stock`, `imagen`, `categoria`) VALUES
(1, 'Leggings GymShark Sculpt', 'Leggings de compresión con cintura alta.', 'S', 'Negro', 99.90, 20, 'img/mujer1.jpg', 'Mujer'),
(2, 'Top GymShark Seamless', 'Top deportivo sin costuras y con soporte.', 'M', 'Rosa', 69.90, 25, 'img/mujer2.jpg', 'Mujer'),
(3, 'Chaqueta GymShark Flex', 'Chaqueta ligera ideal para antes o después del entrenamiento.', 'M', 'Turquesa', 109.90, 12, 'img/mujer3.jpg', 'Mujer'),
(4, 'Short GymShark Vital', 'Short elástico para alto rendimiento.', 'S', 'Gris claro', 79.90, 18, 'img/mujer4.jpg', 'Mujer'),
(5, 'Camiseta GymShark Energy', 'Camiseta deportiva con tejido suave.', 'M,S', 'Blanco', 74.90, 22, 'img/mujer5.jpg', 'Mujer'),
(13, 'Top Deportivo Coral', 'Top elástico con soporte medio y diseño ergonómico para máxima comodidad.', 'S,M', 'Negro', 89.90, 0, 'img/mujer6.jpg', 'Mujer'),
(14, 'Leggins Ajustados Negros', 'Leggins de compresión con cintura alta para una silueta perfecta.', 'S,M', 'Negro', 129.90, 0, 'img/mujer7.jpg', 'Mujer'),
(15, 'Sudadera Rosada GymShark', 'Sudadera oversize en color rosa pastel, ideal para antes o después del gym.', 'S,M', 'Rosado', 149.90, 0, 'img/mujer8.jpg', 'Mujer'),
(16, 'Short Deportivo Gris Claro', 'Shorts ligeros con tecnología DryFit para mantenerte fresca.', 'S,M', 'Gris', 99.90, 0, 'img/mujer9.jpg', 'Mujer'),
(17, 'Camiseta Fit Blanca', 'Camiseta básica de algodón premium con corte femenino.', 'S,M', 'Blanco', 79.90, 0, 'img/mujer10.jpg', 'Mujer'),
(18, 'Zapatillas GymShark Air', 'Zapatillas ligeras y transpirables con amortiguación mejorada.', 'B,D', 'Blanco', 299.90, 0, 'img/mujer11.jpg', 'Mujer'),
(19, 'Bolso de Gimnasio Rosa', 'Bolso deportivo amplio y resistente, con compartimientos internos.', 'S,M', 'Rosado', 119.90, 0, 'img/mujer12.jpg', 'Mujer');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `clave`) VALUES
(3, 'jona', '12345'),
(4, 'pedro', '123456'),
(5, 'jordy', '654321');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accesorios`
--
ALTER TABLE `accesorios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos_hombre`
--
ALTER TABLE `productos_hombre`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos_mujer`
--
ALTER TABLE `productos_mujer`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accesorios`
--
ALTER TABLE `accesorios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `productos_hombre`
--
ALTER TABLE `productos_hombre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `productos_mujer`
--
ALTER TABLE `productos_mujer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
