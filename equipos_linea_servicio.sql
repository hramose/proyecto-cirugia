-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-02-2016 a las 23:29:59
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
-- Estructura de tabla para la tabla `equipos_linea_servicio`
--

CREATE TABLE IF NOT EXISTS `equipos_linea_servicio` (
  `id` int(11) NOT NULL,
  `equipo_id` int(11) NOT NULL,
  `linea_servicio_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `equipos_linea_servicio`
--
ALTER TABLE `equipos_linea_servicio`
  ADD PRIMARY KEY (`id`), ADD KEY `equipo_id` (`equipo_id`,`linea_servicio_id`), ADD KEY `linea_servicio_id` (`linea_servicio_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `equipos_linea_servicio`
--
ALTER TABLE `equipos_linea_servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `equipos_linea_servicio`
--
ALTER TABLE `equipos_linea_servicio`
ADD CONSTRAINT `equipos_linea_servicio_ibfk_1` FOREIGN KEY (`equipo_id`) REFERENCES `equipos` (`id`),
ADD CONSTRAINT `equipos_linea_servicio_ibfk_2` FOREIGN KEY (`linea_servicio_id`) REFERENCES `linea_servicio` (`id`);

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
