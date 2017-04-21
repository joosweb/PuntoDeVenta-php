-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:8889
-- Tiempo de generación: 21-04-2017 a las 20:47:12
-- Versión del servidor: 5.5.42
-- Versión de PHP: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `lubricentro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_diaria`
--

CREATE TABLE `caja_diaria` (
  `id` int(11) NOT NULL,
  `caja_inicial` int(11) NOT NULL,
  `fecha_caja` date NOT NULL,
  `estado` varchar(15) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'ABIERTA'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `caja_diaria`
--

INSERT INTO `caja_diaria` (`id`, `caja_inicial`, `fecha_caja`, `estado`) VALUES
(2, 50000, '2017-04-09', 'ABIERTA'),
(5, 70000, '2017-04-10', 'ABIERTA'),
(6, 50000, '2017-04-16', 'ABIERTA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int(11) NOT NULL,
  `codigo_producto` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_producto` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `precio` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre_categoria`) VALUES
(4, 'Aditivos'),
(5, 'Adhesivos'),
(6, 'Grasas'),
(7, 'Accesorios'),
(9, 'Aromatizantes'),
(10, 'Cables de Bujias'),
(11, 'Crucetas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE `gastos` (
  `id` int(11) NOT NULL,
  `importe` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `comentario` text COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `gastos`
--

INSERT INTO `gastos` (`id`, `importe`, `fecha`, `comentario`) VALUES
(8, 2500, '2017-04-10', 'completo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_ventas`
--

CREATE TABLE `log_ventas` (
  `id` int(11) NOT NULL,
  `codigo_producto` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_venta` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `log_ventas`
--

INSERT INTO `log_ventas` (`id`, `codigo_producto`, `cantidad`, `fecha_venta`) VALUES
(2, '021625918471', 1, '2017-04-07 18:54:48'),
(3, '021625918471', 1, '2017-04-07 18:54:48'),
(5, '4008177107146', 1, '2017-03-20 19:11:02'),
(6, '021625918471', 1, '2017-03-23 12:33:23'),
(7, '021625918471', 1, '2017-03-23 12:33:53'),
(8, '7806358001675', 1, '2017-03-30 16:47:06'),
(9, '008536590101', 1, '2017-03-30 16:47:06'),
(10, '6944259838981', 1, '2017-03-30 16:47:06'),
(11, '6944259838974', 1, '2017-03-30 16:47:06'),
(12, '073579515145', 1, '2017-03-30 16:47:06'),
(13, '7806358001675', 1, '2017-04-07 23:05:44'),
(14, '7806358000180', 1, '2017-04-07 23:05:44'),
(15, '7804627180748', 1, '2017-04-08 09:04:39'),
(16, '4045989607013', 1, '2017-04-10 01:35:13'),
(17, '6944259838981', 1, '2017-04-10 10:27:24'),
(18, '008536590101', 1, '2017-04-10 10:27:24'),
(19, '7806358000180', 1, '2017-04-10 10:27:24'),
(20, '7806358001675', 1, '2017-04-10 10:27:24'),
(21, '079340375314', 1, '2017-04-10 10:59:31'),
(22, '093371000670', 1, '2017-04-10 10:59:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `nombre_producto` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `precio` int(11) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `codigo_producto` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `id_categoria`, `nombre_producto`, `precio`, `fecha_ingreso`, `codigo_producto`, `stock`) VALUES
(6, 4, 'Castrol 5w30 EDGE', 46500, '2017-01-04', '4008177107146', 0),
(7, 1, 'Elf 10w40  Evolution', 23000, '2017-01-04', '7804627180663', 0),
(8, 1, 'Elf 20w50 Evolution', 19000, '2017-01-04', '7804627180748', 3),
(9, 1, 'Acdelco 15w40 Select', 15000, '2017-01-04', '021625918471', 0),
(10, 1, 'Mobil 10w40 Special', 14000, '2017-01-04', '7806358001675', 0),
(11, 1, 'Mobil 20w50 Super 1000', 21500, '2017-01-04', '7806358000180', 1),
(12, 1, 'Castrol 80w90 Axle', 5500, '2017-01-04', '079191226155', 0),
(14, 3, 'Liquido freno 1/4 ml', 2000, '2017-01-04', '008536590101', 82),
(15, 3, 'Alto al humo JohnsenÂ´s', 4500, '2017-01-04', '039101046266', 8),
(16, 3, 'Limpia Injector Diesel', 3000, '2017-01-04', '6944259838981', 2),
(17, 3, 'Limpia Injector Bencinero', 2500, '2017-01-04', '6944259838974', 5),
(18, 3, 'Anticorrosivo radiador', 3700, '2017-01-04', '073579515145', 1),
(19, 3, 'Limpia Injector y Carburador', 3000, '2017-01-04', '7702155009640', 4),
(20, 3, 'Limpia contacto Loctite', 3500, '2017-01-04', '7891200346998', 6),
(21, 3, 'Gear Oil (Corona)', 3500, '2017-01-04', '076906031196', 2),
(22, 3, 'Grasa Liquida', 4500, '2017-01-04', '039101046044', 5),
(23, 3, 'Limpia contacto johnsens', 5500, '2017-01-04', '039101046006', 6),
(24, 3, 'Rost Off Wurth', 4100, '2017-01-04', '4045989607013', 1),
(25, 3, 'Super lub Loctite', 3500, '2017-01-04', '7891200343300', 18),
(26, 5, 'Fijador de roscas', 3750, '2017-01-04', '686226271006', 0),
(27, 5, 'Silicona  roja Loctite', 3000, '2017-01-04', '079340374690', 13),
(28, 5, 'Silicona Grey Loctite', 4755, '2017-01-04', '079340374645', 17),
(29, 5, 'Silicona Gasket Versachem', 2500, '2017-01-04', '078727730098', 11),
(30, 5, 'acero liquido', 4750, '2017-01-04', '079340375314', 9),
(31, 3, 'Lubricante de Chapa', 3550, '2017-01-04', '077678002506', 3),
(32, 3, 'Limpia Radiador Versachem', 1800, '2017-01-04', '7805315000195', 4),
(33, 3, 'Sella radiador Versachem', 1800, '2017-01-04', '7805315000171', 2),
(34, 5, 'Adhesivo espejo CPI', 2000, '2017-01-04', '093371000670', 9),
(35, 5, 'Reparacion Estanque Versachem', 2850, '2017-01-04', '078727167092', 4),
(36, 6, 'Grasa Homocinetica Optimus', 3500, '2017-01-05', '7501799109156', 16),
(37, 6, 'Grasa Rodamientos Azul Valvoline', 1500, '2017-01-05', '7808720800015', 24),
(38, 6, 'Grasa Rodamiento Roja Valvoline', 1500, '2017-01-05', '7808720800008', 22),
(39, 7, 'Cubrevolante Negro/Gris', 5000, '2017-01-05', '6930529100339', 0),
(40, 7, 'Cubrevolante Beige/Negro', 5000, '2017-01-05', '6930529100339', 0),
(41, 7, 'Cubrevolante Azul/Negro', 5000, '2017-01-05', '6930529100339', -1),
(42, 8, 'Bujia NGK ZFR5E-11 ', 2400, '2017-01-09', '7897707509850', 1),
(43, 8, 'Bujia NGK BKR5EKC', 2750, '2017-01-09', '7897707506361', 15),
(44, 8, 'Bujia NGK BKR5EYA-11', 1500, '2017-01-09', '7897707509027', 20),
(45, 8, 'Bujia NGK BCPR5EY', 1850, '2017-01-09', '087295112663', 10),
(46, 8, 'Bujia NGK BP5HS', 1600, '2017-01-09', '7897707506064', 26),
(47, 8, 'Bujia NGK BKR5E', 1500, '2017-01-09', '7897707505708', 23),
(48, 8, 'Bujia NGK BPR5EY', 1500, '2017-01-09', '7897707505722', 16),
(49, 8, 'Bujia NGK BPR5ES', 1500, '2017-01-09', '7897707506309', 1),
(50, 8, 'Bujia NGK BP5ES', 1500, '2017-01-09', '7897707506040', 48),
(51, 8, 'Bujia DENSO W16EX-U', 1500, '2017-01-09', '042511030275', 1),
(52, 8, 'Bujia DENSO W16EXR-U', 1500, '2017-01-09', '042511030312', 2),
(53, 8, 'Bujia DENSO K16R-U', 1500, '2017-01-09', '042511031197', 1),
(54, 8, 'Bujia DENSO T20PR-U', 1500, '2017-01-09', '042511050358', 4),
(55, 8, 'Bujia NGK D8EA', 1600, '2017-01-09', '7897707505524', 6),
(56, 8, 'Bujia NGK DCPR7E', 4500, '2017-01-09', '087295139325', 8),
(57, 8, 'Bujia NGK BPM7A', 1600, '2017-01-09', '7897707505500', 10),
(58, 8, 'Bujia DENSO T20EPR-U', 1500, '2017-01-09', '042511050327', 7),
(59, 8, 'Bujia DENSO K20PBR', 3500, '2017-01-09', '042511050600', 4),
(60, 8, 'Bujia DENSO W20EPB', 3500, '2017-01-09', '042511050655', 4),
(61, 8, 'Bujia CHAMPION 300 N9YC', 2000, '2017-01-09', '037551000067', 4),
(62, 9, 'Palmera Aroma Pino', 1000, '2017-01-10', '232269250197', 11),
(63, 9, 'Palmera Aroma Fresa', 1000, '2017-01-10', '089269250128', 9),
(64, 9, 'Palmera Aroma Vainilla', 1000, '2017-01-10', '089269250173', 1),
(65, 9, 'Palmera Aroma Cereza', 1000, '2017-01-10', '089269250135', 5),
(66, 9, 'Palmera Aroma  Coco', 1000, '2017-01-10', '089269250159', 16),
(67, 9, 'Palmera Aroma Bayas Silvestres', 1000, '2017-01-10', '089269250180', 2),
(68, 9, 'Palmera Aroma Jazmin', 1000, '2017-01-10', '089269250142', 9),
(69, 10, 'Nissan Sunny', 6000, '2017-01-19', '7502012187753', 2),
(70, 10, 'Suzuki SK-410 / ST-90', 8000, '2017-01-19', '7502012183076', 1),
(71, 10, 'Nissan V-16 (twin Cam) / Sentra II', 10000, '2017-01-19', '7502012187630', 1),
(72, 10, 'Nissan V-16 (tapa roja)', 11500, '2017-01-19', '7502012187814', 1),
(73, 10, 'Chevrolet Milenium 2.2', 14600, '2017-01-19', '7502012182512', 0),
(74, 10, 'Chevrolet Chevette / Chevy 500', 11000, '2017-01-19', '7892069006931', 0),
(75, 10, 'Toyota Hilux 2.0 (90-93)', 12900, '2017-01-19', '010180106', 2),
(76, 10, 'Chevrolet Luv 2.3', 12000, '2017-01-19', '010180025', 0),
(77, 10, 'Toyota Hilux 2.4 (95-04) 2RZE', 35000, '2017-01-19', '010180114', 2),
(78, 10, 'Toyota Hilux 1.8  (2Y-3Y)', 11500, '2017-01-19', '010180053', 0),
(79, 10, 'Toyota Hilux 2.4 (93-97) 22RE', 22000, '2017-01-19', '010180065', 1),
(80, 10, 'Nissan D-21', 10000, '2017-01-19', '010180095', 1),
(81, 10, 'Volkswagen Gol (punta metalica)', 14500, '2017-01-19', '7892069006061', 1),
(82, 11, 'Gumz-3  (32 x 92 Seg/int)', 13500, '2017-01-19', '010280011', 4),
(83, 11, 'Gumz-6 (28 x 82 seg/int)', 11000, '2017-01-19', '010280008', 3),
(84, 11, 'Gumz-9 (26,5 x 73 seg/int)', 12000, '2017-01-19', '010280009', 1),
(85, 11, 'Gumz-10 (22,5 x 58,5 seg/ext)', 16000, '2017-01-19', '010280007', 2),
(86, 11, 'Guk-12 (27 x 80 seg/ext)', 10500, '2017-01-19', '010280042', 3),
(87, 11, 'Gum-81 (25 x 63,8 seg/ext)', 6500, '2017-01-19', '010280012', 1),
(88, 11, 'Gud-84 (28 x 80 seg/ext)', 11500, '2017-01-19', '010280033', 2),
(89, 11, 'Gum-88 (25 x 76,8 seg/ext)', 16500, '2017-01-19', '010280075', 2),
(90, 11, 'Gu-800 (27 x 62 seg/ext)', 8650, '2017-01-19', '010280016', 2),
(91, 11, 'Gu-2200 (30 x 93 seg/ext)', 10000, '2017-01-19', '010280004', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticketventa`
--

CREATE TABLE `ticketventa` (
  `id_ticket` int(11) NOT NULL,
  `rut_usuario` varchar(14) COLLATE utf8_spanish2_ci NOT NULL,
  `monto` int(11) NOT NULL,
  `fecha_ticket` datetime NOT NULL,
  `comentario` text COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `ticketventa`
--

INSERT INTO `ticketventa` (`id_ticket`, `rut_usuario`, `monto`, `fecha_ticket`, `comentario`) VALUES
(1, '17.757.169-5', 50000, '2017-04-10 01:36:50', 'sdasdasdasd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `rut` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `apellidos` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `tipo` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `rut`, `password`, `nombre`, `apellidos`, `tipo`) VALUES
(2, '16.618.814-8', '*6BB4837EB74329105EE4568DDA7DC67ED2CA2AD9', 'Marilyn', '', 2),
(3, '8.646.538-8', '*6BB4837EB74329105EE4568DDA7DC67ED2CA2AD9', 'Irene', '', 2),
(4, '16.405.757-7', '*6BB4837EB74329105EE4568DDA7DC67ED2CA2AD9', 'Jose', 'OSSES ORMEÑO', 1),
(5, '17.757.169-5', '*6BB4837EB74329105EE4568DDA7DC67ED2CA2AD9', 'Bernardo', 'Salazar', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caja_diaria`
--
ALTER TABLE `caja_diaria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `log_ventas`
--
ALTER TABLE `log_ventas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ticketventa`
--
ALTER TABLE `ticketventa`
  ADD PRIMARY KEY (`id_ticket`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caja_diaria`
--
ALTER TABLE `caja_diaria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `gastos`
--
ALTER TABLE `gastos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `log_ventas`
--
ALTER TABLE `log_ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=92;
--
-- AUTO_INCREMENT de la tabla `ticketventa`
--
ALTER TABLE `ticketventa`
  MODIFY `id_ticket` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
