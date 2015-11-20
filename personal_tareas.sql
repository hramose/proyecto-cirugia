-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2015 a las 22:17:36
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
-- Estructura de tabla para la tabla `personal_tareas`
--

CREATE TABLE IF NOT EXISTS `personal_tareas` (
  `id` int(11) NOT NULL,
  `personal_id` int(11) NOT NULL,
  `tarea` text NOT NULL,
  `fecha_cumplir` date NOT NULL,
  `estado` varchar(15) NOT NULL,
  `fecha` datetime NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `personal_tareas`
--

INSERT INTO `personal_tareas` (`id`, `personal_id`, `tarea`, `fecha_cumplir`, `estado`, `fecha`, `usuario_id`) VALUES
(1, 13, 'Esta es una prueba', '2015-11-22', 'Activa', '2015-11-20 22:05:05', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `personal_tareas`
--
ALTER TABLE `personal_tareas`
  ADD PRIMARY KEY (`id`), ADD KEY `personal_id` (`personal_id`), ADD KEY `usuario_id` (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `personal_tareas`
--
ALTER TABLE `personal_tareas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `personal_tareas`
--
ALTER TABLE `personal_tareas`
ADD CONSTRAINT `personal_tareas_ibfk_1` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id`),
ADD CONSTRAINT `personal_tareas_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `personal` (`id`);

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
