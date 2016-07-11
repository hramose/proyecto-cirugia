-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 11-07-2016 a las 16:36:44
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
-- Estructura de tabla para la tabla `paciente_baul`
--

CREATE TABLE IF NOT EXISTS `paciente_baul` (
  `id` int(11) NOT NULL,
  `paciente_id` int(11) NOT NULL,
  `detalle` mediumtext NOT NULL,
  `personal_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `paciente_baul`
--
ALTER TABLE `paciente_baul`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paciente_id` (`paciente_id`),
  ADD KEY `personal_id` (`personal_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `paciente_baul`
--
ALTER TABLE `paciente_baul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `paciente_baul`
--
ALTER TABLE `paciente_baul`
  ADD CONSTRAINT `paciente_baul_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`),
  ADD CONSTRAINT `paciente_baul_ibfk_2` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
