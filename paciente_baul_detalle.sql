-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 11-07-2016 a las 16:37:00
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
-- Estructura de tabla para la tabla `paciente_baul_detalle`
--

CREATE TABLE IF NOT EXISTS `paciente_baul_detalle` (
  `id` int(11) NOT NULL,
  `paciente_baul_id` int(11) NOT NULL,
  `archivo` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `paciente_baul_detalle`
--
ALTER TABLE `paciente_baul_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paciente_baul_id` (`paciente_baul_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `paciente_baul_detalle`
--
ALTER TABLE `paciente_baul_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `paciente_baul_detalle`
--
ALTER TABLE `paciente_baul_detalle`
  ADD CONSTRAINT `paciente_baul_detalle_ibfk_1` FOREIGN KEY (`paciente_baul_id`) REFERENCES `paciente_baul` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
