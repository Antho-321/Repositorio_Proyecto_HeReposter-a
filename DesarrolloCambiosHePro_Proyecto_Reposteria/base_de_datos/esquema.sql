-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-12-2023 a las 03:42:42
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

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
-- Estructura de tabla para la tabla `canasta`
--

CREATE TABLE `canasta` (
  `Id_Canasta` int(11) NOT NULL,
  `Id_Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `canasta`
--

INSERT INTO `canasta` (`Id_Canasta`, `Id_Usuario`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canasta_item`
--

CREATE TABLE `canasta_item` (
  `Id_Canasta_item` int(11) NOT NULL,
  `Id_canasta` int(11) NOT NULL,
  `Codigo` int(11) NOT NULL,
  `Cantidad_Cliente` int(11) NOT NULL,
  `Subtotal` decimal(10,0) NOT NULL,
  `Dedicatoria` varchar(400) DEFAULT NULL,
  `Especificacion_adicional` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobante_venta`
--

CREATE TABLE `comprobante_venta` (
  `Id_comprobante_venta` int(11) NOT NULL,
  `Id_canasta` int(11) NOT NULL,
  `Fcompra` date NOT NULL,
  `Subtotal(noIVA)` decimal(10,0) NOT NULL,
  `Total_pago` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `Codigo` int(11) NOT NULL,
  `Categoría` varchar(100) NOT NULL,
  `Tamaño` varchar(100) NOT NULL,
  `Masa` varchar(100) NOT NULL,
  `Sabor` varchar(100) NOT NULL,
  `Cobertura` varchar(100) NOT NULL,
  `Relleno` varchar(100) NOT NULL,
  `Descripción` varchar(1000) NOT NULL,
  `Precio` decimal(10,0) NOT NULL,
  `Porciones` varchar(100) NOT NULL,
  `Img` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`Codigo`, `Categoría`, `Tamaño`, `Masa`, `Sabor`, `Cobertura`, `Relleno`, `Descripción`, `Precio`, `Porciones`, `Img`) VALUES
(1, 'Bodas', 'Mediana', 'Normal (Con receta propia)', 'Naranja', 'Crema', 'Mermelada de frutilla', '', 12, '16', 'https://th.bing.com/th/id/R.b042dade06440a9cf8c236b81ad2c4d8?rik=8ynKhjpIzp3%2bmA&pid=ImgRaw&r=0'),
(2, 'Bautizos', 'Mediana', 'Normal (Con receta propia)', 'Naranja', 'Crema', 'Mermelada de frutilla', '', 12, '16', 'https://th.bing.com/th/id/R.b40b59c817f0ec2c24a5097a457b2c58?rik=LSOvD1PsMJfxeA&pid=ImgRaw&r=0'),
(3, 'XV años', 'Mediana', 'Normal (Con receta propia)', 'Naranja', 'Crema', 'Mermelada de frutilla', '', 12, '16', 'https://th.bing.com/th/id/R.e99479ac0e7d4a9c728e27672496b3a6?rik=RCV8gTQCKReNzg&pid=ImgRaw&r=0'),
(4, 'Cumpleaños', 'Mediana', 'Normal (Con receta propia)', 'Naranja', 'Crema', 'Mermelada de frutilla', '', 12, '16', 'https://th.bing.com/th/id/OIP.-vDV59NDSrLbo5SKb2jxggHaF3?pid=ImgDet&rs=1'),
(5, 'Baby Shower', 'Mediana', 'Normal (Con receta propia)', 'Chocolate', 'Crema', 'Mermelada de frutilla', '', 12, '16', 'https://th.bing.com/th/id/R.46fb8a09fc2f95a905b4342a428bd1fd?rik=C3KVdZ9n6YOTIw&pid=ImgRaw&r=0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Id_Usuario` int(11) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Id_Usuario`, `Email`, `Password`) VALUES
(1, 'luchitolondra522@gmail.com', '1234'),
(2, 'anthonyluisluna225@gmail.com', '123'),
(3, 'Administrador', 'Administrador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `canasta`
--
ALTER TABLE `canasta`
  ADD PRIMARY KEY (`Id_Canasta`),
  ADD KEY `canasta_ibfk_1` (`Id_Usuario`);

--
-- Indices de la tabla `canasta_item`
--
ALTER TABLE `canasta_item`
  ADD PRIMARY KEY (`Id_Canasta_item`),
  ADD KEY `Codigo` (`Codigo`),
  ADD KEY `canasta_item_ibfk_1` (`Id_canasta`);

--
-- Indices de la tabla `comprobante_venta`
--
ALTER TABLE `comprobante_venta`
  ADD PRIMARY KEY (`Id_comprobante_venta`),
  ADD KEY `factura_ibfk_1` (`Id_canasta`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`Codigo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Id_Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `canasta`
--
ALTER TABLE `canasta`
  MODIFY `Id_Canasta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `canasta_item`
--
ALTER TABLE `canasta_item`
  MODIFY `Id_Canasta_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `comprobante_venta`
--
ALTER TABLE `comprobante_venta`
  MODIFY `Id_comprobante_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Id_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `canasta`
--
ALTER TABLE `canasta`
  ADD CONSTRAINT `canasta_ibfk_1` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuario` (`Id_Usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `canasta_item`
--
ALTER TABLE `canasta_item`
  ADD CONSTRAINT `canasta_item_ibfk_1` FOREIGN KEY (`Id_canasta`) REFERENCES `canasta` (`Id_Canasta`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `canasta_item`
  ADD CONSTRAINT `canasta_item_ibfk_2` FOREIGN KEY (`Codigo`) REFERENCES `producto` (`Codigo`) ON DELETE NO ACTION;

--
-- Filtros para la tabla `comprobante_venta`
--
ALTER TABLE `comprobante_venta`
  ADD CONSTRAINT `comprobante_venta_ibfk_1` FOREIGN KEY (`Id_Canasta`) REFERENCES `canasta` (`Id_Canasta`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
