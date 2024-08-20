-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-08-2024 a las 07:29:59
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prod_carrito`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre`, `descripcion`) VALUES
(1, 'Indumentaria', 'Ropa Deportiva.'),
(2, 'Calzado', 'Zapatillas Deportivas.'),
(3, 'Accesorios', 'Accesorios Deportivos.'),
(4, 'Deporte', 'Elementos Deportivos.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `imagen` varchar(1000) NOT NULL,
  `precio` decimal(20,2) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `imagen`, `precio`, `id_categoria`) VALUES
(10, 'Top Nike', '1723679701_top.jpg', 1.00, 1),
(12, 'Nike Mujer', '1723679797_mujernike.jpg', 1.00, 2),
(14, 'Padel Mulher', '1723679848_padelmulher.jpg', 1.00, 2),
(15, 'Running Puma', '1723679864_runningpuma.jpg', 1.00, 2),
(17, 'Guantes Nike', '1723679970_guantes.jpg', 1.00, 3),
(19, 'Botella Nike', '1723680002_botella.jpg', 1.00, 3),
(20, 'Casco Abus', '1723680028_cascoabus.jpg', 1.00, 4),
(21, 'Padel Mystica', '1723680043_padelmystica.jpg', 1.00, 4),
(22, 'Pesas', '1723680096_pesasorange.jpg', 1.00, 4),
(23, 'Hockey Ribcor', '1723680135_hockeyribcor.jpg', 1.00, 4),
(24, 'New Balance', '1723744133_newbalance2.jpg', 1.00, 2),
(25, 'Mochila Adidas', '1723744923_mochila addidas.jpg', 1.00, 3),
(26, 'Vincha Nike', '1723745300_Vincha Nike.jpg', 1.00, 3),
(27, 'Remera Mujer Nike', '1723745858_Remera Mujer Nike.jpg', 1.00, 1),
(30, 'Short Corto Nike', '1723746367_shortnike.jpg', 1.00, 1),
(31, 'Conjunto Deportivo', '1723746387_conjunto1.jpg', 1.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbldetalleventa`
--

CREATE TABLE `tbldetalleventa` (
  `ID` int(11) NOT NULL,
  `IDVENTA` int(11) NOT NULL,
  `IDPRODUCTO` int(11) NOT NULL,
  `PRECIOUNITARIO` decimal(20,1) NOT NULL,
  `CANTIDAD` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbldetalleventa`
--

INSERT INTO `tbldetalleventa` (`ID`, `IDVENTA`, `IDPRODUCTO`, `PRECIOUNITARIO`, `CANTIDAD`) VALUES
(1, 2, 20, 100.0, 1),
(2, 44, 25, 1.0, 1),
(3, 44, 17, 1.0, 1),
(4, 44, 19, 1.0, 1),
(5, 45, 25, 1.0, 4),
(6, 45, 17, 1.0, 1),
(7, 45, 19, 1.0, 1),
(8, 46, 25, 1.0, 4),
(9, 46, 17, 1.0, 1),
(10, 46, 19, 1.0, 1),
(11, 46, 14, 1.0, 1),
(12, 47, 25, 1.0, 4),
(13, 47, 17, 1.0, 1),
(14, 47, 19, 1.0, 1),
(15, 47, 14, 1.0, 1),
(16, 48, 25, 1.0, 4),
(17, 48, 17, 1.0, 1),
(18, 48, 19, 1.0, 1),
(19, 48, 14, 1.0, 1),
(20, 49, 25, 1.0, 4),
(21, 49, 17, 1.0, 1),
(22, 49, 19, 1.0, 1),
(23, 49, 14, 1.0, 1),
(24, 50, 25, 1.0, 4),
(25, 50, 17, 1.0, 1),
(26, 50, 19, 1.0, 1),
(27, 50, 14, 1.0, 1),
(28, 51, 14, 1.0, 3),
(29, 51, 15, 1.0, 3),
(30, 52, 27, 1.0, 1),
(31, 52, 30, 1.0, 1),
(32, 52, 31, 1.0, 1),
(33, 53, 15, 1.0, 1),
(34, 54, 15, 1.0, 1),
(35, 55, 15, 1.0, 1),
(36, 55, 14, 1.0, 4),
(37, 55, 12, 1.0, 4),
(38, 56, 15, 1.0, 1),
(39, 56, 14, 1.0, 1),
(40, 56, 12, 1.0, 1),
(41, 57, 15, 1.0, 1),
(42, 57, 14, 1.0, 1),
(43, 57, 12, 1.0, 1),
(44, 58, 15, 1.0, 1),
(45, 58, 14, 1.0, 1),
(46, 58, 12, 1.0, 1),
(47, 59, 15, 1.0, 3),
(48, 59, 12, 1.0, 1),
(49, 59, 25, 1.0, 1),
(50, 59, 26, 1.0, 3),
(51, 60, 15, 1.0, 3),
(52, 60, 12, 1.0, 1),
(53, 60, 25, 1.0, 1),
(54, 60, 26, 1.0, 3),
(55, 61, 20, 1.0, 1),
(56, 62, 15, 1.0, 1),
(57, 62, 12, 1.0, 1),
(58, 62, 14, 1.0, 1),
(59, 63, 15, 1.0, 1),
(60, 63, 12, 1.0, 1),
(61, 63, 14, 1.0, 1),
(62, 64, 14, 1.0, 2),
(63, 64, 15, 1.0, 4),
(64, 65, 14, 1.0, 1),
(65, 66, 14, 1.0, 1),
(66, 67, 14, 1.0, 1),
(67, 67, 15, 1.0, 1),
(68, 68, 14, 1.0, 4),
(69, 68, 24, 1.0, 1),
(70, 68, 12, 1.0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblventas`
--

CREATE TABLE `tblventas` (
  `ID` int(11) NOT NULL,
  `ClaveTransaccion` varchar(250) NOT NULL,
  `PaypalDatos` text NOT NULL,
  `Fecha` datetime NOT NULL,
  `Correo` varchar(5000) NOT NULL,
  `Total` decimal(60,0) NOT NULL,
  `status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblventas`
--

INSERT INTO `tblventas` (`ID`, `ClaveTransaccion`, `PaypalDatos`, `Fecha`, `Correo`, `Total`, `status`) VALUES
(1, '12345678910', '', '2024-08-18 06:02:07', 'ritaveron40@gmail.com', 100, 'pendiente'),
(2, '0vefgppo5mfqearqh28va64m4f', '', '2024-08-18 18:38:18', 'ritaveron40@gmail.com', 2, 'pendiente'),
(3, '0vefgppo5mfqearqh28va64m4f', '', '2024-08-18 18:44:54', 'ritaveron40@gmail.com', 4, 'pendiente'),
(4, '0vefgppo5mfqearqh28va64m4f', '', '2024-08-18 18:54:10', 'ritaveron40@gmail.com', 14, 'pendiente'),
(5, '0vefgppo5mfqearqh28va64m4f', '', '2024-08-18 20:17:43', 'ritaveron40@gmail.com', 14, 'pendiente'),
(6, '0vefgppo5mfqearqh28va64m4f', '', '2024-08-18 20:18:12', 'ritaveron40@gmail.com', 14, 'pendiente'),
(7, '0vefgppo5mfqearqh28va64m4f', '', '2024-08-18 20:19:44', 'ritaveron40@gmail.com', 14, 'pendiente'),
(8, '0vefgppo5mfqearqh28va64m4f', '', '2024-08-18 20:26:20', 'veronbeatriz073@gmail.com', 14, 'pendiente'),
(9, '0vefgppo5mfqearqh28va64m4f', '', '2024-08-18 20:28:21', 'veronbeatriz073@gmail.com', 14, 'pendiente'),
(10, '0vefgppo5mfqearqh28va64m4f', '', '2024-08-18 20:29:06', 'veronbeatriz073@gmail.com', 14, 'pendiente'),
(11, '0vefgppo5mfqearqh28va64m4f', '', '2024-08-18 20:29:21', 'veronbeatriz073@gmail.com', 14, 'pendiente'),
(12, '0vefgppo5mfqearqh28va64m4f', '', '2024-08-18 20:33:12', 'veronbeatriz073@gmail.com', 15, 'pendiente'),
(13, '0vefgppo5mfqearqh28va64m4f', '', '2024-08-18 20:33:22', 'veronbeatriz073@gmail.com', 15, 'pendiente'),
(14, '0vefgppo5mfqearqh28va64m4f', '', '2024-08-18 20:35:20', 'veronbeatriz073@gmail.com', 15, 'pendiente'),
(15, '0vefgppo5mfqearqh28va64m4f', '', '2024-08-18 20:36:33', 'veronbeatriz073@gmail.com', 15, 'pendiente'),
(16, '0vefgppo5mfqearqh28va64m4f', '', '2024-08-18 20:38:35', 'veronbeatriz073@gmail.com', 15, 'pendiente'),
(17, '0vefgppo5mfqearqh28va64m4f', '', '2024-08-18 20:39:06', 'veronbeatriz073@gmail.com', 15, 'pendiente'),
(18, '0vefgppo5mfqearqh28va64m4f', '', '2024-08-18 20:40:22', 'ritaveron40@gmail.com', 7, 'pendiente'),
(19, '0vefgppo5mfqearqh28va64m4f', '', '2024-08-18 20:41:08', 'ritaveron40@gmail.com', 7, 'pendiente'),
(20, '0vefgppo5mfqearqh28va64m4f', '', '2024-08-18 21:11:57', 'yaninasaggini91@gmail.com', 7, 'pendiente'),
(21, '0vefgppo5mfqearqh28va64m4f', '', '2024-08-18 21:13:09', 'loco_22_51@hotmail.com', 4, 'pendiente'),
(22, '0vefgppo5mfqearqh28va64m4f', '', '2024-08-18 21:38:44', 'veronbeatriz073@gmail.com', 4, 'pendiente'),
(23, '0vefgppo5mfqearqh28va64m4f', '', '2024-08-18 21:39:33', 'veronbeatriz073@gmail.com', 4, 'pendiente'),
(24, '0vefgppo5mfqearqh28va64m4f', '', '2024-08-18 21:43:03', 'ritaveron40@gmail.com', 4, 'pendiente'),
(25, '0vefgppo5mfqearqh28va64m4f', '', '2024-08-18 21:46:45', 'ritaveron40@gmail.com', 4, 'pendiente'),
(26, '0vefgppo5mfqearqh28va64m4f', '', '2024-08-18 21:47:12', 'ritaveron40@gmail.com', 4, 'pendiente'),
(27, '0vefgppo5mfqearqh28va64m4f', '', '2024-08-18 21:51:55', 'loco_22_51@hotmail.com', 4, 'pendiente'),
(28, '0vefgppo5mfqearqh28va64m4f', '', '2024-08-18 21:53:21', 'ritaveron40@gmail.com', 4, 'pendiente'),
(29, '0vefgppo5mfqearqh28va64m4f', '', '2024-08-18 22:03:45', 'ritaveron40@gmail.com', 2, 'pendiente'),
(30, '0vefgppo5mfqearqh28va64m4f', '', '2024-08-18 22:04:32', 'loco_22_51@hotmail.com', 2, 'pendiente'),
(31, '0vefgppo5mfqearqh28va64m4f', '', '2024-08-18 22:05:59', 'ritaveron40@gmail.com', 2, 'pendiente'),
(32, 'mmlc6lmjeq363nbmmil3cfqh7r', '', '2024-08-18 22:09:57', 'yaninasaggini91@gmail.com', 4, 'pendiente'),
(33, 'mmlc6lmjeq363nbmmil3cfqh7r', '', '2024-08-18 22:10:10', 'ritaveron40@gmail.com', 4, 'pendiente'),
(34, '5dl3mhfotck510eu75qippd229', '', '2024-08-18 22:14:20', 'yaninasaggini91@gmail.com', 3, 'pendiente'),
(35, '5dl3mhfotck510eu75qippd229', '', '2024-08-18 22:15:44', 'ritaveron40@gmail.com', 3, 'pendiente'),
(36, '5dl3mhfotck510eu75qippd229', '', '2024-08-18 22:22:41', 'ritaveron40@gmail.com', 3, 'pendiente'),
(37, 'e39cu90djeurhc7g9n3o30gfqg', '', '2024-08-19 12:14:20', 'veronbeatriz073@gmail.com', 2, 'pendiente'),
(38, 'e39cu90djeurhc7g9n3o30gfqg', '', '2024-08-19 12:14:34', 'ritaveron40@gmail.com', 2, 'pendiente'),
(39, 'e39cu90djeurhc7g9n3o30gfqg', '', '2024-08-19 15:45:07', 'ritaveron40@gmail.com', 4, 'pendiente'),
(40, 'e39cu90djeurhc7g9n3o30gfqg', '', '2024-08-19 15:57:30', 'ritaveron40@gmail.com', 2, 'pendiente'),
(41, 'e39cu90djeurhc7g9n3o30gfqg', '', '2024-08-19 15:57:51', 'ritaveron40@gmail.com', 2, 'pendiente'),
(42, 'e39cu90djeurhc7g9n3o30gfqg', '', '2024-08-19 16:01:17', 'ritaveron40@gmail.com', 3, 'pendiente'),
(43, 'e39cu90djeurhc7g9n3o30gfqg', '', '2024-08-19 16:08:51', 'ritaveron40@gmail.com', 3, 'pendiente'),
(44, 'e39cu90djeurhc7g9n3o30gfqg', '', '2024-08-19 16:38:25', 'ritaveron40@gmail.com', 3, 'pendiente'),
(45, 'e39cu90djeurhc7g9n3o30gfqg', '', '2024-08-19 16:39:03', 'veronbeatriz073@gmail.com', 6, 'pendiente'),
(46, 'e39cu90djeurhc7g9n3o30gfqg', '', '2024-08-19 16:59:00', 'yaninasaggini91@gmail.com', 7, 'pendiente'),
(47, 'e39cu90djeurhc7g9n3o30gfqg', '', '2024-08-19 17:31:56', 'ritaveron40@gmail.com', 7, 'pendiente'),
(48, 'e39cu90djeurhc7g9n3o30gfqg', '', '2024-08-19 17:40:48', 'ritaveron40@gmail.com', 7, 'pendiente'),
(49, 'e39cu90djeurhc7g9n3o30gfqg', '', '2024-08-19 17:52:54', 'loco_22_51@hotmail.com', 7, 'pendiente'),
(50, 'e39cu90djeurhc7g9n3o30gfqg', '', '2024-08-19 17:56:51', 'ritaveron40@gmail.com', 7, 'pendiente'),
(51, 'lkjhekpvv6avsn7vpn1hoipcuc', '', '2024-08-19 18:46:06', 'ritaveron40@gmail.com', 6, 'pendiente'),
(52, '5bis3l2vr6k0733v70eqgqbgoh', '', '2024-08-19 20:50:54', 'ritaveron40@gmail.com', 3, 'pendiente'),
(53, 'k7iirqskodmqbu7tng9rgffjke', '', '2024-08-19 21:47:35', 'ritaveron40@gmail.com', 1, 'pendiente'),
(54, 'k7iirqskodmqbu7tng9rgffjke', '', '2024-08-19 22:30:41', 'loco_22_51@hotmail.com', 1, 'pendiente'),
(55, 'k7iirqskodmqbu7tng9rgffjke', '', '2024-08-19 22:34:40', 'yaninasaggini91@gmail.com', 9, 'pendiente'),
(56, 'k7iirqskodmqbu7tng9rgffjke', '', '2024-08-19 23:03:50', 'aaa@gmail.com', 3, 'pendiente'),
(57, 'k7iirqskodmqbu7tng9rgffjke', '', '2024-08-19 23:04:22', 'ritaveron40@gmail.com', 3, 'pendiente'),
(58, 'k7iirqskodmqbu7tng9rgffjke', '', '2024-08-19 23:05:03', 'ritaveron40@gmail.com', 3, 'pendiente'),
(59, 'k7iirqskodmqbu7tng9rgffjke', '', '2024-08-19 23:14:38', 'ritaveron40@gmail.com', 8, 'pendiente'),
(60, 'k7iirqskodmqbu7tng9rgffjke', '', '2024-08-19 23:17:54', 'ritaveron40@gmail.com', 8, 'pendiente'),
(61, 'k7iirqskodmqbu7tng9rgffjke', '', '2024-08-19 23:19:22', 'ritaveron40@gmail.com', 1, 'pendiente'),
(62, 'k7iirqskodmqbu7tng9rgffjke', '', '2024-08-19 23:24:02', 'ritaveron40@gmail.com', 3, 'pendiente'),
(63, 'k7iirqskodmqbu7tng9rgffjke', '', '2024-08-19 23:25:37', 'ritaveron40@gmail.com', 3, 'pendiente'),
(64, 'k7iirqskodmqbu7tng9rgffjke', '', '2024-08-19 23:26:42', 'aaa@gmail.com', 6, 'pendiente'),
(65, 'k7iirqskodmqbu7tng9rgffjke', '', '2024-08-19 23:28:09', 'jose@gmail.com', 1, 'pendiente'),
(66, 'k7iirqskodmqbu7tng9rgffjke', '', '2024-08-19 23:28:58', 'ritaveron40@gmail.com', 1, 'pendiente'),
(67, 'k7iirqskodmqbu7tng9rgffjke', '', '2024-08-20 00:58:53', 'ritaveron40@gmail.com', 2, 'pendiente'),
(68, 'k7iirqskodmqbu7tng9rgffjke', '', '2024-08-20 01:58:59', 'aaa@gmail.com', 6, 'pendiente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `tbldetalleventa`
--
ALTER TABLE `tbldetalleventa`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDVENTA` (`IDVENTA`),
  ADD KEY `IDPRODUCTO` (`IDPRODUCTO`);

--
-- Indices de la tabla `tblventas`
--
ALTER TABLE `tblventas`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `tbldetalleventa`
--
ALTER TABLE `tbldetalleventa`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de la tabla `tblventas`
--
ALTER TABLE `tblventas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);

--
-- Filtros para la tabla `tbldetalleventa`
--
ALTER TABLE `tbldetalleventa`
  ADD CONSTRAINT `tbldetalleventa_ibfk_1` FOREIGN KEY (`IDVENTA`) REFERENCES `tblventas` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbldetalleventa_ibfk_2` FOREIGN KEY (`IDPRODUCTO`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
