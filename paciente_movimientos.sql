-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 20-11-2015 a las 17:18:39
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `smadia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente_movimientos`
--

CREATE TABLE IF NOT EXISTS `paciente_movimientos` (
  `id` int(11) NOT NULL,
  `paciente_id` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `tipo` varchar(15) NOT NULL,
  `sub_tipo` varchar(150) NOT NULL,
  `descripcion` text NOT NULL,
  `ingreso_id` int(11) DEFAULT NULL,
  `contrato_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `paciente_movimientos`
--
ALTER TABLE `paciente_movimientos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paciente_id` (`paciente_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `paciente_movimientos`
--
ALTER TABLE `paciente_movimientos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `paciente_movimientos`
--
ALTER TABLE `paciente_movimientos`
  ADD CONSTRAINT `paciente_movimientos_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`),
  ADD CONSTRAINT `paciente_movimientos_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `personal` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
