-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-02-2024 a las 01:09:18
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
-- Estructura de tabla para la tabla `auditoria`
--

DROP TABLE IF EXISTS detalles_pedido;
DROP TABLE IF EXISTS pastel;
DROP TABLE IF EXISTS comprobante_venta;
DROP TABLE IF EXISTS pedido;
DROP TABLE IF EXISTS tamanos_formas;
DROP TABLE IF EXISTS roles;
DROP TABLE IF EXISTS auditoria;
DROP TABLE IF EXISTS clientes;
DROP TABLE IF EXISTS usuarios;
DROP TABLE IF EXISTS formas;
DROP TABLE IF EXISTS tamano;
DROP TABLE IF EXISTS tipo_relleno_sabor;
DROP TABLE IF EXISTS tipo;
DROP TABLE IF EXISTS categoria;
DROP TABLE IF EXISTS rellenos;
DROP TABLE IF EXISTS cobertura;
DROP TABLE IF EXISTS sabores;
DROP TABLE IF EXISTS varios;

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
  `telefono` decimal(10,0) DEFAULT NULL,
  `direccion_domicilio` varchar(50) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `clave` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`cliente_id`, `cedula`, `nombre_cliente`, `telefono`, `direccion_domicilio`, `email`, `clave`) VALUES
(1, NULL, NULL, NULL, NULL, 'anthonyluisluna225@gmail.com', '123');

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
  `fecha` date DEFAULT NULL,
  `cantidad` decimal(10,0) DEFAULT NULL,
  `concepto` varchar(50) DEFAULT NULL,
  `cedula_vendedor` varchar(10) DEFAULT NULL,
  `total_pago` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `fecha_entrega` date DEFAULT NULL,
  `hora_entrega` time DEFAULT NULL,
  `pedido_confirmado` tinyint(1) DEFAULT 0,
  `lugar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `sabores_id` int(11) DEFAULT NULL,
  `sabores_descripcion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`sabores_id`)
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

INSERT INTO `tamanos_formas` (`tamanos_formas_id`, `tamano_id`, `formas_id`, `num_porciones`, `altura`, `longitud1`, `longitud2`,`naranja_chocolate`,`naranja_maracuya`) VALUES
(1, 5, 1, '5-6', 4.687500000, 8.11690210, NULL, 1.5, 2),
(2, 4, 1, '10-12', 5.156250000, 10.10633889, NULL, 2.56, 3.41),
(3, 3, 1, '16', 6.093750000, 12.09577567, NULL, 4.33, 5.77),
(4, 2, 1, '30', 8.437500000, 15.19929707, NULL, 9.47, 12.62),
(5, 1, 1, '70', 8.906250000, 18.06408604, NULL, 14.12, 18.82),
(6, 5, 2, '2-4', 4.687500000, 8.11690210, NULL, 1.5, 2),
(7, 4, 2, '8-10', 5.156250000, 10.10633889, NULL, 2.56, 3.41),
(8, 3, 2, '12-14', 6.093750000, 12.09577567, NULL, 4.33, 5.77),
(9, 2, 2, '26-28', 8.437500000, 15.19929707, NULL, 9.47, 12.62),
(10, 1, 2, '66-68', 8.906250000, 18.06408604, NULL, 14.12, 18.82),
(11, 4, 3, '20-25', 5.700000000, 24.50000000, 24.25000000, 5.24, 6.98),
(12, 3, 3, '35-40', 5.900000000, 35.25000000, 34.90000000, 11.22, 14.96),
(13, 2, 3, '50', 5.900000000, 40.45000000, 40.05000000, 14.78, 19.7),
(14, 3, 4, '35-40', 6.000000000, 39.90000000, 25.00000000, 9.25, 12.34),
(15, 1, 4, '100', 4.500000000, 64.75000000, 45.35000000, 20.43, 27.24);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `tipo_id` int(11) NOT NULL,
  `tipo_descripcion` varchar(50) DEFAULT NULL,
  `precio_base_volumen` decimal(10,9) DEFAULT NULL,
  PRIMARY KEY (`tipo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO tipo (tipo_id, tipo_descripcion, precio_base_volumen) VALUES ('1', 'Normal (Con receta propia)', '0.002061381');
INSERT INTO tipo (tipo_id, tipo_descripcion, precio_base_volumen) VALUES ('2', 'Normal (Con premezcla)', '0.002983874');
INSERT INTO tipo (tipo_id, tipo_descripcion, precio_base_volumen) VALUES ('3', 'Especial (Con frutos secos)', '0.008245523');
INSERT INTO tipo (tipo_id, tipo_descripcion, precio_base_volumen) VALUES ('4', 'Bizcochuelo', '0.002061381');
INSERT INTO tipo (tipo_id, tipo_descripcion, precio_base_volumen) VALUES ('5', 'Milhojas', '0.002061381');
INSERT INTO tipo (tipo_id, tipo_descripcion, precio_base_volumen) VALUES ('6', 'Cheesecake', '0.009276214');
INSERT INTO tipo (tipo_id, tipo_descripcion, precio_base_volumen) VALUES ('7', 'Mousse', '0.006069417');
INSERT INTO tipo (tipo_id, tipo_descripcion, precio_base_volumen) VALUES ('8', 'Tres leches', '0.003570245');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_relleno_sabor`
--

CREATE TABLE `tipo_relleno_sabor` (
  `tipo_relleno_sabor_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipo_id` int(11) NOT NULL,
  `rellenos` boolean,
  `sabores_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`tipo_relleno_sabor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Filtros para la tabla `tipo_relleno_sabor`
--
alter table tipo_relleno_sabor add constraint tipo_relleno_sabor_ibfk_1 foreign key (sabores_id)
      references sabores (sabores_id) on delete restrict on update restrict;

alter table tipo_relleno_sabor add constraint tipo_relleno_sabor_ibfk_2 foreign key (tipo_id)
      references tipo (tipo_id) on delete restrict on update restrict;

INSERT INTO tipo_relleno_sabor (tipo_id, rellenos, sabores_id) VALUES ('1', true, '5');
INSERT INTO tipo_relleno_sabor (tipo_id, rellenos, sabores_id) VALUES ('1', true, '6');
INSERT INTO tipo_relleno_sabor (tipo_id, rellenos, sabores_id) VALUES ('1', true, '7');
INSERT INTO tipo_relleno_sabor (tipo_id, rellenos, sabores_id) VALUES ('1', true, '8');
INSERT INTO tipo_relleno_sabor (tipo_id, rellenos, sabores_id) VALUES ('1', true, '9');
INSERT INTO tipo_relleno_sabor (tipo_id, rellenos, sabores_id) VALUES ('2', true, '5');
INSERT INTO tipo_relleno_sabor (tipo_id, rellenos, sabores_id) VALUES ('2', true, '6');
INSERT INTO tipo_relleno_sabor (tipo_id, rellenos, sabores_id) VALUES ('2', true, '7');
INSERT INTO tipo_relleno_sabor (tipo_id, rellenos, sabores_id) VALUES ('3', false, '5');
INSERT INTO tipo_relleno_sabor (tipo_id, rellenos, sabores_id) VALUES ('3', false, '6');
INSERT INTO tipo_relleno_sabor (tipo_id, rellenos, sabores_id) VALUES ('3', false, '7');
INSERT INTO tipo_relleno_sabor (tipo_id, rellenos, sabores_id) VALUES ('3', false, '8');
INSERT INTO tipo_relleno_sabor (tipo_id, rellenos, sabores_id) VALUES ('3', false, '9');
INSERT INTO tipo_relleno_sabor (tipo_id, rellenos, sabores_id) VALUES ('4', true, '6');
INSERT INTO tipo_relleno_sabor (tipo_id, rellenos, sabores_id) VALUES ('4', true, '7');
INSERT INTO tipo_relleno_sabor (tipo_id, rellenos, sabores_id) VALUES ('5', true, NULL);
INSERT INTO tipo_relleno_sabor (tipo_id, rellenos, sabores_id) VALUES ('6', false, '1');
INSERT INTO tipo_relleno_sabor (tipo_id, rellenos, sabores_id) VALUES ('6', false, '2');
INSERT INTO tipo_relleno_sabor (tipo_id, rellenos, sabores_id) VALUES ('6', false, '3');
INSERT INTO tipo_relleno_sabor (tipo_id, rellenos, sabores_id) VALUES ('6', false, '4');
INSERT INTO tipo_relleno_sabor (tipo_id, rellenos, sabores_id) VALUES ('6', false, '5');
INSERT INTO tipo_relleno_sabor (tipo_id, rellenos, sabores_id) VALUES ('6', false, '6');
INSERT INTO tipo_relleno_sabor (tipo_id, rellenos, sabores_id) VALUES ('6', false, '7');
INSERT INTO tipo_relleno_sabor (tipo_id, rellenos, sabores_id) VALUES ('6', false, '8');
INSERT INTO tipo_relleno_sabor (tipo_id, rellenos, sabores_id) VALUES ('7', false, '1');
INSERT INTO tipo_relleno_sabor (tipo_id, rellenos, sabores_id) VALUES ('7', false, '2');
INSERT INTO tipo_relleno_sabor (tipo_id, rellenos, sabores_id) VALUES ('7', false, '3');
INSERT INTO tipo_relleno_sabor (tipo_id, rellenos, sabores_id) VALUES ('7', false, '4');
INSERT INTO tipo_relleno_sabor (tipo_id, rellenos, sabores_id) VALUES ('7', false, '5');
INSERT INTO tipo_relleno_sabor (tipo_id, rellenos, sabores_id) VALUES ('7', false, '6');
INSERT INTO tipo_relleno_sabor (tipo_id, rellenos, sabores_id) VALUES ('7', false, '7');
INSERT INTO tipo_relleno_sabor (tipo_id, rellenos, sabores_id) VALUES ('7', false, '8');
INSERT INTO tipo_relleno_sabor (tipo_id, rellenos, sabores_id) VALUES ('8', false, NULL);

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
  MODIFY `detalle_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `pedido_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rellenos`
--
ALTER TABLE `rellenos`
  MODIFY `relleno_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `sabores`
--
ALTER TABLE `sabores`
  MODIFY `sabores_id` int(11) DEFAULT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `tipo_relleno_sabor_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `fk_clientes_pedidos` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`cliente_id`);

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



COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
