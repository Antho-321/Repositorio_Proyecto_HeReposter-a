-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-02-2024 a las 22:47:32
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
-- Base de datos: `db_pankey`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adorno_fondant`
--

CREATE TABLE `adorno_fondant` (
  `adorno_fondant_id` int(11) NOT NULL,
  `enlace` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE `auditoria` (
  `id_auditoria` int(11) NOT NULL,
  `cedula_usuario` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `tabla_afectada` varchar(20) DEFAULT NULL,
  `operacion_realizada` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `categoria_id` int(11) NOT NULL,
  `categoria_descripcion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`categoria_id`, `categoria_descripcion`) VALUES
(1, 'Bodas'),
(2, 'Bautizos'),
(3, 'XV años'),
(4, 'Cumpleaños'),
(5, 'Baby Shower'),
(6, 'San Valentin'),
(7, 'Halloween'),
(8, 'Navidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `cliente_id` int(11) NOT NULL,
  `cedula` varchar(10) DEFAULT NULL,
  `nombre_cliente` varchar(50) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `direccion_domicilio` varchar(50) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `clave` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`cliente_id`, `cedula`, `nombre_cliente`, `telefono`, `direccion_domicilio`, `email`, `clave`) VALUES
(1, '1050298650', 'Anthony Luna', '0979785963', 'Ibarra 21-137', 'anthonyluisluna225@gmail.com', '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cobertura`
--

CREATE TABLE `cobertura` (
  `cobertura_id` int(11) NOT NULL,
  `cobertura_descripcion` varchar(100) DEFAULT NULL,
  `cobertura_precio_base_volumen` decimal(10,9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cobertura`
--

INSERT INTO `cobertura` (`cobertura_id`, `cobertura_descripcion`, `cobertura_precio_base_volumen`) VALUES
(1, 'Crema', 0.008338684),
(2, 'Fondant', 0.050032103),
(3, 'Ninguna', 0.000000000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobante_venta`
--

CREATE TABLE `comprobante_venta` (
  `comprobante_id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `hora_entrega` time DEFAULT NULL,
  `total_pago` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comprobante_venta`
--

INSERT INTO `comprobante_venta` (`comprobante_id`, `pedido_id`, `fecha_entrega`, `hora_entrega`, `total_pago`) VALUES
(1, 1, '2024-10-10', '09:59:00', 90);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_pedido`
--

CREATE TABLE `detalles_pedido` (
  `detalle_id` int(11) NOT NULL,
  `pedido_id` int(11) DEFAULT NULL,
  `id_varios` int(11) DEFAULT NULL,
  `pastel_id` int(11) DEFAULT NULL,
  `cantidad_pastel` int(11) DEFAULT NULL,
  `cantidad_varios` int(11) DEFAULT NULL,
  `dedicatoria` varchar(300) DEFAULT NULL,
  `especificacion_adicional` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalles_pedido`
--

INSERT INTO `detalles_pedido` (`detalle_id`, `pedido_id`, `id_varios`, `pastel_id`, `cantidad_pastel`, `cantidad_varios`, `dedicatoria`, `especificacion_adicional`) VALUES
(1, 1, NULL, 6, 1, NULL, NULL, NULL),
(2, 2, NULL, 2, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dibujo_img_especial`
--

CREATE TABLE `dibujo_img_especial` (
  `dibujo_img_especial_id` int(11) NOT NULL,
  `enlace` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especificacion_adicional`
--

CREATE TABLE `especificacion_adicional` (
  `especificacion_adicional_id` int(11) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `enlace` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formas`
--

CREATE TABLE `formas` (
  `formas_id` int(11) NOT NULL,
  `formas_descripcion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `formas`
--

INSERT INTO `formas` (`formas_id`, `formas_descripcion`) VALUES
(1, 'Redonda'),
(2, 'Personalizada'),
(3, 'Cuadrada'),
(4, 'Rectangular');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pastel`
--

CREATE TABLE `pastel` (
  `pastel_id` int(11) NOT NULL,
  `tamanos_formas_id` int(11) DEFAULT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `relleno_id` int(11) DEFAULT NULL,
  `cobertura_id` int(11) DEFAULT NULL,
  `sabores_id` int(11) DEFAULT NULL,
  `precio` decimal(10,0) DEFAULT NULL,
  `img` varchar(300) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pastel`
--

INSERT INTO `pastel` (`pastel_id`, `tamanos_formas_id`, `tipo_id`, `relleno_id`, `cobertura_id`, `sabores_id`, `precio`, `img`, `categoria_id`) VALUES
(1, 1, 1, 1, 1, 1, 20, 'https://th.bing.com/th/id/R.b042dade06440a9cf8c236b81ad2c4d8?rik=8ynKhjpIzp3%2bmA&pid=ImgRaw&r=0', 1),
(2, 2, 4, 2, 2, 4, 10, 'https://th.bing.com/th/id/R.b40b59c817f0ec2c24a5097a457b2c58?rik=LSOvD1PsMJfxeA&pid=ImgRaw&r=0', 2),
(3, 1, 1, 1, 1, 1, 18, 'https://sallysbakingaddiction.com/wp-content/uploads/2013/04/triple-chocolate-cake-4.jpg', 1),
(4, 1, 1, 1, 1, 1, 27, 'https://th.bing.com/th/id/OIP.-vDV59NDSrLbo5SKb2jxggHaF3?pid=ImgDet&rs=1', 4),
(5, 1, 1, 1, 1, 1, 68, 'https://th.bing.com/th/id/R.46fb8a09fc2f95a905b4342a428bd1fd?rik=C3KVdZ9n6YOTIw&pid=ImgRaw&r=0', 5),
(6, 1, 1, 1, 1, 1, 90, 'https://www.recipetineats.com/wp-content/uploads/2020/08/My-best-Vanilla-Cake_9-SQ.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `pedido_id` int(11) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `fecha_pedido` date DEFAULT current_timestamp(),
  `pedido_confirmado` tinyint(1) DEFAULT 0,
  `dibujo_img_especial_id` int(11) DEFAULT NULL,
  `adorno_fondant_id` int(11) DEFAULT NULL,
  `especificacion_adicional_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`pedido_id`, `cliente_id`, `fecha_pedido`, `pedido_confirmado`, `dibujo_img_especial_id`, `adorno_fondant_id`, `especificacion_adicional_id`) VALUES
(1, 1, '2024-02-29', 1, NULL, NULL, NULL),
(2, 1, '2024-02-29', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rellenos`
--

CREATE TABLE `rellenos` (
  `relleno_id` int(11) NOT NULL,
  `relleno_descripcion` varchar(50) DEFAULT NULL,
  `relleno_altura` decimal(10,2) DEFAULT NULL,
  `relleno_precio_base_volumen` decimal(10,9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rellenos`
--

INSERT INTO `rellenos` (`relleno_id`, `relleno_descripcion`, `relleno_altura`, `relleno_precio_base_volumen`) VALUES
(1, 'Mermelada', NULL, NULL),
(2, 'Glass de frutilla con crema', 0.75, 0.009185692),
(3, 'Crema napolitana', 0.75, 0.011022830),
(4, 'Durazno con crema', 0.75, 0.011022830),
(5, 'Ninguno', 0.00, 0.000000000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(20) DEFAULT NULL,
  `cedula_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sabores`
--

CREATE TABLE `sabores` (
  `sabores_id` int(11) NOT NULL,
  `sabores_descripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sabores`
--

INSERT INTO `sabores` (`sabores_id`, `sabores_descripcion`) VALUES
(1, 'Fresa'),
(2, 'Limón'),
(3, 'Uva'),
(4, 'Manzana'),
(5, 'Naranja'),
(6, 'Vainilla'),
(7, 'Chocolate'),
(8, 'Maracuyá'),
(9, 'Naranja y chocolate (Marmoleada)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tamano`
--

CREATE TABLE `tamano` (
  `tamano_id` int(11) NOT NULL,
  `tamano_descripcion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tamano`
--

INSERT INTO `tamano` (`tamano_id`, `tamano_descripcion`) VALUES
(1, 'Extra grande'),
(2, 'Grande'),
(3, 'Mediana'),
(4, 'Pequeña'),
(5, 'Mini');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tamanos_formas`
--

CREATE TABLE `tamanos_formas` (
  `tamanos_formas_id` int(11) NOT NULL,
  `tamano_id` int(11) DEFAULT NULL,
  `formas_id` int(11) DEFAULT NULL,
  `num_porciones` varchar(8) DEFAULT NULL,
  `altura` decimal(10,9) DEFAULT NULL,
  `longitud1` decimal(10,8) DEFAULT NULL,
  `longitud2` decimal(10,8) DEFAULT NULL,
  `naranja_chocolate` decimal(4,2) DEFAULT NULL,
  `naranja_maracuya` decimal(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tamanos_formas`
--

INSERT INTO `tamanos_formas` (`tamanos_formas_id`, `tamano_id`, `formas_id`, `num_porciones`, `altura`, `longitud1`, `longitud2`, `naranja_chocolate`, `naranja_maracuya`) VALUES
(1, 5, 1, '5-6', 4.687500000, 8.11690210, NULL, 1.50, 2.00),
(2, 4, 1, '10-12', 5.156250000, 10.10633889, NULL, 2.56, 3.41),
(3, 3, 1, '16', 6.093750000, 12.09577567, NULL, 4.33, 5.77),
(4, 2, 1, '30', 8.437500000, 15.19929707, NULL, 9.47, 12.62),
(5, 1, 1, '70', 8.906250000, 18.06408604, NULL, 14.12, 18.82),
(6, 5, 2, '2-4', 4.687500000, 8.11690210, NULL, 1.50, 2.00),
(7, 4, 2, '8-10', 5.156250000, 10.10633889, NULL, 2.56, 3.41),
(8, 3, 2, '12-14', 6.093750000, 12.09577567, NULL, 4.33, 5.77),
(9, 2, 2, '26-28', 8.437500000, 15.19929707, NULL, 9.47, 12.62),
(10, 1, 2, '66-68', 8.906250000, 18.06408604, NULL, 14.12, 18.82),
(11, 4, 3, '20-25', 5.700000000, 24.50000000, 24.25000000, 5.24, 6.98),
(12, 3, 3, '35-40', 5.900000000, 35.25000000, 34.90000000, 11.22, 14.96),
(13, 2, 3, '50', 5.900000000, 40.45000000, 40.05000000, 14.78, 19.70),
(14, 3, 4, '35-40', 6.000000000, 39.90000000, 25.00000000, 9.25, 12.34),
(15, 1, 4, '100', 4.500000000, 64.75000000, 45.35000000, 20.43, 27.24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `tipo_id` int(11) NOT NULL,
  `tipo_descripcion` varchar(50) DEFAULT NULL,
  `precio_base_volumen` decimal(10,9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`tipo_id`, `tipo_descripcion`, `precio_base_volumen`) VALUES
(1, 'Normal (Con receta propia)', 0.002061381),
(2, 'Normal (Con premezcla)', 0.002983874),
(3, 'Especial (Con frutos secos)', 0.008245523),
(4, 'Bizcochuelo', 0.002061381),
(5, 'Milhojas', 0.002061381),
(6, 'Cheesecake', 0.009276214),
(7, 'Mousse', 0.006069417),
(8, 'Tres leches', 0.003570245);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_relleno_sabor`
--

CREATE TABLE `tipo_relleno_sabor` (
  `tipo_relleno_sabor_id` bigint(20) UNSIGNED NOT NULL,
  `tipo_id` int(11) NOT NULL,
  `rellenos` tinyint(1) DEFAULT NULL,
  `sabores_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_relleno_sabor`
--

INSERT INTO `tipo_relleno_sabor` (`tipo_relleno_sabor_id`, `tipo_id`, `rellenos`, `sabores_id`) VALUES
(1, 1, 1, 5),
(2, 1, 1, 6),
(3, 1, 1, 7),
(4, 1, 1, 8),
(5, 1, 1, 9),
(6, 2, 1, 5),
(7, 2, 1, 6),
(8, 2, 1, 7),
(9, 3, 0, 5),
(10, 3, 0, 6),
(11, 3, 0, 7),
(12, 3, 0, 8),
(13, 3, 0, 9),
(14, 4, 1, 6),
(15, 4, 1, 7),
(16, 5, 1, NULL),
(17, 6, 0, 1),
(18, 6, 0, 2),
(19, 6, 0, 3),
(20, 6, 0, 4),
(21, 6, 0, 5),
(22, 6, 0, 6),
(23, 6, 0, 7),
(24, 6, 0, 8),
(25, 7, 0, 1),
(26, 7, 0, 2),
(27, 7, 0, 3),
(28, 7, 0, 4),
(29, 7, 0, 5),
(30, 7, 0, 6),
(31, 7, 0, 7),
(32, 7, 0, 8),
(33, 8, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `cedula_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(50) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `contrasena` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `varios`
--

CREATE TABLE `varios` (
  `id_varios` int(11) NOT NULL,
  `descripcion_varios` varchar(1000) DEFAULT NULL,
  `precio_varios` decimal(10,0) DEFAULT NULL,
  `img_varios` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `adorno_fondant`
--
ALTER TABLE `adorno_fondant`
  ADD PRIMARY KEY (`adorno_fondant_id`);

--
-- Indices de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`id_auditoria`),
  ADD KEY `fk_relationship_11` (`cedula_usuario`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cliente_id`);

--
-- Indices de la tabla `cobertura`
--
ALTER TABLE `cobertura`
  ADD PRIMARY KEY (`cobertura_id`);

--
-- Indices de la tabla `comprobante_venta`
--
ALTER TABLE `comprobante_venta`
  ADD PRIMARY KEY (`comprobante_id`),
  ADD KEY `fk_pedido_comprobanteventa2` (`pedido_id`);

--
-- Indices de la tabla `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  ADD PRIMARY KEY (`detalle_id`),
  ADD KEY `fk_pastel_detalles_pedido` (`pastel_id`),
  ADD KEY `fk_pedido_detallespedidio` (`pedido_id`),
  ADD KEY `fk_varios_detallespedido` (`id_varios`);

--
-- Indices de la tabla `dibujo_img_especial`
--
ALTER TABLE `dibujo_img_especial`
  ADD PRIMARY KEY (`dibujo_img_especial_id`);

--
-- Indices de la tabla `especificacion_adicional`
--
ALTER TABLE `especificacion_adicional`
  ADD PRIMARY KEY (`especificacion_adicional_id`);

--
-- Indices de la tabla `formas`
--
ALTER TABLE `formas`
  ADD PRIMARY KEY (`formas_id`);

--
-- Indices de la tabla `pastel`
--
ALTER TABLE `pastel`
  ADD PRIMARY KEY (`pastel_id`),
  ADD KEY `fk_cobertura_detallespedido` (`cobertura_id`),
  ADD KEY `fk_rellenos_detallespedidos` (`relleno_id`),
  ADD KEY `fk_sabores_detallespedido` (`sabores_id`),
  ADD KEY `fk_categoria_detallespedido` (`categoria_id`),
  ADD KEY `fk_tamanoformas_detallespedido` (`tamanos_formas_id`),
  ADD KEY `fk_tipo_pastel` (`tipo_id`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`pedido_id`),
  ADD UNIQUE KEY `fk_dibujo_img_especial` (`dibujo_img_especial_id`),
  ADD UNIQUE KEY `fk_adorno_fondant` (`adorno_fondant_id`),
  ADD UNIQUE KEY `fk_especificacion_adicional` (`especificacion_adicional_id`),
  ADD KEY `fk_clientes_pedidos` (`cliente_id`);

--
-- Indices de la tabla `rellenos`
--
ALTER TABLE `rellenos`
  ADD PRIMARY KEY (`relleno_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`),
  ADD KEY `fk_relationship_12` (`cedula_usuario`);

--
-- Indices de la tabla `sabores`
--
ALTER TABLE `sabores`
  ADD PRIMARY KEY (`sabores_id`);

--
-- Indices de la tabla `tamano`
--
ALTER TABLE `tamano`
  ADD PRIMARY KEY (`tamano_id`);

--
-- Indices de la tabla `tamanos_formas`
--
ALTER TABLE `tamanos_formas`
  ADD PRIMARY KEY (`tamanos_formas_id`),
  ADD KEY `fk_formas_tamanosformas` (`formas_id`),
  ADD KEY `fk_tamano_tamanosformas` (`tamano_id`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`tipo_id`);

--
-- Indices de la tabla `tipo_relleno_sabor`
--
ALTER TABLE `tipo_relleno_sabor`
  ADD PRIMARY KEY (`tipo_relleno_sabor_id`),
  ADD KEY `tipo_relleno_sabor_ibfk_1` (`sabores_id`),
  ADD KEY `tipo_relleno_sabor_ibfk_2` (`tipo_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`cedula_usuario`);

--
-- Indices de la tabla `varios`
--
ALTER TABLE `varios`
  ADD PRIMARY KEY (`id_varios`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `adorno_fondant`
--
ALTER TABLE `adorno_fondant`
  MODIFY `adorno_fondant_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `categoria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `cliente_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cobertura`
--
ALTER TABLE `cobertura`
  MODIFY `cobertura_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  MODIFY `detalle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `dibujo_img_especial`
--
ALTER TABLE `dibujo_img_especial`
  MODIFY `dibujo_img_especial_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `especificacion_adicional`
--
ALTER TABLE `especificacion_adicional`
  MODIFY `especificacion_adicional_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `formas`
--
ALTER TABLE `formas`
  MODIFY `formas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pastel`
--
ALTER TABLE `pastel`
  MODIFY `pastel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `pedido_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `rellenos`
--
ALTER TABLE `rellenos`
  MODIFY `relleno_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `sabores`
--
ALTER TABLE `sabores`
  MODIFY `sabores_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tamano`
--
ALTER TABLE `tamano`
  MODIFY `tamano_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tamanos_formas`
--
ALTER TABLE `tamanos_formas`
  MODIFY `tamanos_formas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
  MODIFY `tipo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tipo_relleno_sabor`
--
ALTER TABLE `tipo_relleno_sabor`
  MODIFY `tipo_relleno_sabor_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD CONSTRAINT `fk_relationship_11` FOREIGN KEY (`cedula_usuario`) REFERENCES `usuarios` (`cedula_usuario`);

--
-- Filtros para la tabla `comprobante_venta`
--
ALTER TABLE `comprobante_venta`
  ADD CONSTRAINT `fk_pedido_comprobanteventa2` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`pedido_id`);

--
-- Filtros para la tabla `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  ADD CONSTRAINT `fk_pastel_detalles_pedido` FOREIGN KEY (`pastel_id`) REFERENCES `pastel` (`pastel_id`),
  ADD CONSTRAINT `fk_pedido_detallespedidio` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`pedido_id`),
  ADD CONSTRAINT `fk_varios_detallespedido` FOREIGN KEY (`id_varios`) REFERENCES `varios` (`id_varios`);

--
-- Filtros para la tabla `pastel`
--
ALTER TABLE `pastel`
  ADD CONSTRAINT `fk_categoria_detallespedido` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`categoria_id`),
  ADD CONSTRAINT `fk_cobertura_detallespedido` FOREIGN KEY (`cobertura_id`) REFERENCES `cobertura` (`cobertura_id`),
  ADD CONSTRAINT `fk_rellenos_detallespedidos` FOREIGN KEY (`relleno_id`) REFERENCES `rellenos` (`relleno_id`),
  ADD CONSTRAINT `fk_sabores_detallespedido` FOREIGN KEY (`sabores_id`) REFERENCES `sabores` (`sabores_id`),
  ADD CONSTRAINT `fk_tamanoformas_detallespedido` FOREIGN KEY (`tamanos_formas_id`) REFERENCES `tamanos_formas` (`tamanos_formas_id`),
  ADD CONSTRAINT `fk_tipo_pastel` FOREIGN KEY (`tipo_id`) REFERENCES `tipo` (`tipo_id`);

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_clientes_pedidos` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`cliente_id`),
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`dibujo_img_especial_id`) REFERENCES `dibujo_img_especial` (`dibujo_img_especial_id`),
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`adorno_fondant_id`) REFERENCES `adorno_fondant` (`adorno_fondant_id`),
  ADD CONSTRAINT `pedido_ibfk_3` FOREIGN KEY (`especificacion_adicional_id`) REFERENCES `especificacion_adicional` (`especificacion_adicional_id`);

--
-- Filtros para la tabla `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `fk_relationship_12` FOREIGN KEY (`cedula_usuario`) REFERENCES `usuarios` (`cedula_usuario`);

--
-- Filtros para la tabla `tamanos_formas`
--
ALTER TABLE `tamanos_formas`
  ADD CONSTRAINT `fk_formas_tamanosformas` FOREIGN KEY (`formas_id`) REFERENCES `formas` (`formas_id`),
  ADD CONSTRAINT `fk_tamano_tamanosformas` FOREIGN KEY (`tamano_id`) REFERENCES `tamano` (`tamano_id`);

--
-- Filtros para la tabla `tipo_relleno_sabor`
--
ALTER TABLE `tipo_relleno_sabor`
  ADD CONSTRAINT `tipo_relleno_sabor_ibfk_1` FOREIGN KEY (`sabores_id`) REFERENCES `sabores` (`sabores_id`),
  ADD CONSTRAINT `tipo_relleno_sabor_ibfk_2` FOREIGN KEY (`tipo_id`) REFERENCES `tipo` (`tipo_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
