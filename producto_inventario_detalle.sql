-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-02-2016 a las 21:16:10
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `smadia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_inventario_detalle`
--

CREATE TABLE IF NOT EXISTS `producto_inventario_detalle` (
  `id` int(11) NOT NULL,
  `producto_inventario_id` int(11) NOT NULL,
  `lote` varchar(20) NOT NULL,
  `cantidad_compra` int(11) NOT NULL,
  `existencia` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `producto_inventario_detalle`
--
ALTER TABLE `producto_inventario_detalle`
  ADD PRIMARY KEY (`id`), ADD KEY `producto_inventario_id` (`producto_inventario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `producto_inventario_detalle`
--
ALTER TABLE `producto_inventario_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `producto_inventario_detalle`
--
ALTER TABLE `producto_inventario_detalle`
ADD CONSTRAINT `producto_inventario_detalle_ibfk_1` FOREIGN KEY (`producto_inventario_id`) REFERENCES `producto_inventario` (`id`);

DELIMITER $$
--
-- Eventos
--
CREATE DEFINER=`root`@`localhost` EVENT `Actualizar_promos` ON SCHEDULE EVERY 1 DAY STARTS '2015-10-15 02:00:00' ON COMPLETION PRESERVE ENABLE COMMENT 'Nada' DO UPDATE `promociones` set `estado`= "Vencida" WHERE `fecha_fin` < CURDATE() and estado = "Activa"$$

CREATE DEFINER=`root`@`localhost` EVENT `Actualizar el estado de las Citas` ON SCHEDULE EVERY 1 DAY STARTS '2015-10-15 02:00:00' ON COMPLETION PRESERVE ENABLE DO UPDATE `citas` set `estado`= "Vencida" WHERE `fecha_cita` < CURDATE() and estado = "Programada"$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
