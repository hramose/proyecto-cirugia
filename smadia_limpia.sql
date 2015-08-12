-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 17-06-2015 a las 07:28:45
-- Versión del servidor: 5.5.38-0ubuntu0.14.04.1-log
-- Versión de PHP: 5.5.9-1ubuntu4.3

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
-- Estructura de tabla para la tabla `activos_tipo`
--

CREATE TABLE IF NOT EXISTS `activos_tipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `activos_tipo`
--

INSERT INTO `activos_tipo` (`id`, `tipo`) VALUES
(1, 'Equipos Técnológicos'),
(2, 'Muebles de Oficina'),
(3, 'Equipos Médicos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activo_inventario`
--

CREATE TABLE IF NOT EXISTS `activo_inventario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activo_tipo_id` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `marca` varchar(25) NOT NULL,
  `modelo` varchar(25) NOT NULL,
  `serial` varchar(50) NOT NULL,
  `caracteristicas` text NOT NULL,
  `ubicacion` varchar(50) NOT NULL,
  `estado` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `activo_tipo_id` (`activo_tipo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activo_observaciones`
--

CREATE TABLE IF NOT EXISTS `activo_observaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activo_inventario_id` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `observacion` text NOT NULL,
  `fecha` datetime NOT NULL,
  `personal_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `activo_inventario_id` (`activo_inventario_id`),
  KEY `personal_id` (`personal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bancos`
--

CREATE TABLE IF NOT EXISTS `bancos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bancos_cuentas`
--

CREATE TABLE IF NOT EXISTS `bancos_cuentas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_banco` int(11) NOT NULL,
  `numero` varchar(25) NOT NULL,
  `estado` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_banco` (`id_banco`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `business_lines`
--

CREATE TABLE IF NOT EXISTS `business_lines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(254) DEFAULT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `price` decimal(10,2) NOT NULL,
  `pricetopay` varchar(254) NOT NULL,
  `insumo` varchar(254) NOT NULL,
  `status` varchar(10) NOT NULL,
  `percentage` varchar(254) NOT NULL,
  `restringido` varchar(2) NOT NULL DEFAULT 'SI',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=192 ;

--
-- Volcado de datos para la tabla `business_lines`
--

INSERT INTO `business_lines` (`id`, `name`, `parent`, `price`, `pricetopay`, `insumo`, `status`, `percentage`, `restringido`) VALUES
(1, 'Medicina Estética Facial', 0, 0.00, '', '', '', '', 'SI'),
(3, 'Plasma Rico en Plaquetas', 1, 890000.00, '', '', 'activo', '', 'SI'),
(5, 'Toxina Botulinica', 1, 800000.00, '', '', 'activo', '', 'NO'),
(6, 'Microdermoabrasion', 1, 90000.00, '12000', '0', 'activo', '25', 'SI'),
(50, 'Micro A. Hialuronico', 1, 160000.00, '12000', '34000', 'activo', '25', 'SI'),
(51, 'Micro Vitamina C', 1, 160000.00, '12000', '34000', 'activo', '25', 'SI'),
(11, 'Softlift', 1, 1300000.00, '', '', 'activo', '', 'SI'),
(12, 'Medicina Estética Corporal', 0, 0.00, '', '', '', '', 'SI'),
(13, 'Hidrolipoclasia', 12, 200000.00, '', '', 'activo', '', 'SI'),
(14, 'Fotodepilación', 12, 100000.00, '8000', '0', 'activo', '30', 'SI'),
(15, 'Escleroterapia', 12, 120000.00, '', '', 'activo', '', 'SI'),
(16, 'Ultracavitacion', 12, 90000.00, '13000', '0', 'activo', '30', 'SI'),
(17, 'Laserlipolisis', 73, 0.00, '', '', 'activo', '', 'SI'),
(18, 'Intradermoterapia Corporal', 12, 90000.00, '', '', 'activo', '', 'SI'),
(19, 'Cirugía Plástica Facial', 0, 0.00, '', '', '', '', 'SI'),
(20, 'Reducción de papada', 19, 0.00, '', '', 'activo', '', 'SI'),
(21, 'Corrección de parpados', 19, 0.00, '', '', 'activo', '', 'SI'),
(22, 'Rinoplastia', 19, 0.00, '', '', 'activo', '', 'SI'),
(23, 'Cirugía Plástica Corporal', 0, 0.00, '', '', '', '', 'SI'),
(24, 'Pechos', 23, 0.00, '', '', 'activo', '', 'SI'),
(25, 'Abdominoplastia', 23, 0.00, '', '', 'activo', '', 'SI'),
(26, 'Liposucción', 23, 0.00, '', '', 'activo', '', 'SI'),
(27, 'Plasmalipolisis', 23, 0.00, '', '', 'activo', '', 'SI'),
(28, 'Valoracion', 0, 0.00, '', '', '', '', 'SI'),
(29, 'Valoracion Inicial', 28, 50000.00, '', '', 'activo', '', 'NO'),
(30, 'Escleroespuma', 12, 120000.00, '', '', 'inactivo', '', 'SI'),
(31, 'Intradermoterapia Facial', 1, 75000.00, '', '', 'activo', '', 'SI'),
(32, 'Nutrición Celular', 1, 120000.00, '', '', 'activo', '', 'SI'),
(33, 'Lecitina', 12, 0.00, '', '', 'inactivo', '', 'SI'),
(34, 'Plasma de Tercera Generación', 1, 1000000.00, '', '', 'activo', '', 'SI'),
(35, 'Sueroterapia', 12, 160000.00, '7000', '0', 'activo', '0', 'SI'),
(36, 'Cauterizacion de Verrugas', 1, 150000.00, '', '', 'activo', '', 'SI'),
(37, 'Relleno Restylane 1 ml', 1, 1200000.00, '', '', 'activo', '', 'NO'),
(38, 'Carboxiterapia', 12, 40000.00, '7000', '0', 'activo', '30', 'SI'),
(39, 'DLM', 12, 50000.00, '8000', '0', 'activo', '30', 'SI'),
(40, 'Ultrasonido', 12, 25000.00, '3000', '', 'activo', '30', 'SI'),
(41, 'Presoterapia', 12, 30000.00, '3000', '0', 'activo', '30', 'SI'),
(42, 'DLM - US Cirugías', 12, 60000.00, '12000', '0', 'activo', '30', 'SI'),
(43, 'Láser FTD', 1, 30000.00, '5000', '0', 'activo', '25', 'SI'),
(44, 'Radiofrecuencia Facial', 1, 90000.00, '9000', '0', 'activo', '30', 'SI'),
(45, 'Radiofrecuencia Corporal', 12, 100000.00, '13000', '0', 'activo', '30', 'SI'),
(46, 'Hidratación Facial', 1, 80000.00, '16000', '0', 'activo', '30', 'SI'),
(47, 'Higiene Facial', 1, 100000.00, '16000', '0', 'activo', '30', 'SI'),
(48, 'Exfoliación Cuerpo Entero', 12, 100000.00, '10000', '0', 'activo', '30', 'SI'),
(49, 'Masaje Relajante', 12, 100000.00, '13000', '0', 'activo', '30', 'SI'),
(52, 'Micro Despigmentante', 1, 160000.00, '12000', '34000', 'activo', '25', 'SI'),
(53, 'Micro Acne', 1, 160000.00, '12000', '34000', 'activo', '25', 'SI'),
(54, 'Peeling', 1, 70000.00, '0', '0', 'activo', '', 'SI'),
(55, 'DP Cera bikini total', 12, 25000.00, '6000', '0', 'inactivo', '35', 'SI'),
(56, 'DP Cera Bikini Parcial', 12, 15000.00, '3879', '0', 'inactivo', '30', 'SI'),
(57, 'DP Cera linea alba', 12, 10000.00, '3879', '0', 'inactivo', '35', 'SI'),
(58, 'DP Cera Bozo', 1, 10000.00, '1800', '0', 'inactivo', '35', 'SI'),
(59, 'DP Cera Cejas', 1, 20000.00, '3000', '0', 'inactivo', '35', 'SI'),
(60, 'DP Cera Media Pierna', 12, 25000.00, '3500', '0', 'inactivo', '35', 'SI'),
(61, 'DP Cera Pierna completa', 12, 38000.00, '7000', '0', 'inactivo', '35', 'SI'),
(62, 'DP Cera Axilas', 12, 15000.00, '3000', '0', 'inactivo', '30', 'SI'),
(63, 'DP Cera Barba', 1, 25000.00, '2500', '0', 'inactivo', '35', 'SI'),
(64, 'Tatuaje de Cejas', 1, 150000.00, '38793', '0', 'inactivo', '35', 'SI'),
(65, 'Tatuaje Linea Superior Ojo Negra', 1, 100000.00, '18000', '0', 'inactivo', '40', 'SI'),
(66, 'Tatuaje Linea Inferior Ojo', 1, 100000.00, '18000', '0', 'inactivo', '40', 'SI'),
(67, 'Retoque Tatuaje de Cejas', 1, 100000.00, '', '', 'inactivo', '', 'SI'),
(68, 'Corrientes Rusas Abdomen', 12, 45000.00, '8000', '0', 'activo', '30', 'SI'),
(69, 'Lifting Facial', 1, 70000.00, '10000', '0', 'activo', '35', 'SI'),
(70, 'Lifting Gluteos', 12, 80000.00, '10000', '0', 'activo', '30', 'SI'),
(71, 'Valoracion Cirugias', 28, 50000.00, '0', '0', 'activo', '0', 'NO'),
(72, '', 72, 0.00, '', '', 'inactivo', '', 'SI'),
(73, 'Procedimientos', 0, 0.00, '', '', 'activo', '', 'SI'),
(74, 'Cellulaser', 73, 800000.00, '0', '0', 'activo', '0', 'SI'),
(75, 'Chocolaterapia Facial', 1, 80000.00, '17000', '0', 'inactivo', '30', 'SI'),
(76, 'Corrientes Rusas Brazos', 12, 45000.00, '8000', '0', 'activo', '30', 'SI'),
(77, 'Corrientes Rusas Gluteos', 12, 45000.00, '8000', '0', 'activo', '30', 'SI'),
(78, 'Corrientes Rusas Muslos', 12, 45000.00, '8000', '0', 'activo', '30', 'SI'),
(79, 'DLM Post laser', 12, 60000.00, '8000', '0', 'activo', '30', 'SI'),
(80, 'DLM Domicilio', 12, 60000.00, '30000', '0', 'activo', '30', 'SI'),
(81, 'Fotodepilación Axilas', 12, 69000.00, '8000', '0', 'activo', '30', 'SI'),
(82, 'Fotodepilación Bikini parcial', 12, 100000.00, '8000', '0', 'activo', '30', 'SI'),
(83, 'Fotodepilación bikini total', 12, 200000.00, '16000', '0', 'activo', '30', 'SI'),
(84, 'Fotodepilación bozo', 1, 65000.00, '8000', '0', 'activo', '30', 'SI'),
(85, 'Fotodepilación Cara', 1, 100000.00, '8000', '0', 'inactivo', '30', 'SI'),
(86, 'Fotodepilación Piernas Completas', 12, 400000.00, '32000', '0', 'activo', '30', 'SI'),
(87, 'Fotodepilación Media Pierna', 12, 200000.00, '16000', '0', 'activo', '30', 'SI'),
(88, 'Infrarrojo', 12, 30000.00, '3000', '0', 'activo', '30', 'SI'),
(89, 'Intradermoterapia Capilar', 12, 120000.00, '0', '0', 'activo', '30', 'SI'),
(90, 'Ionización', 12, 30000.00, '3000', '0', 'activo', '30', 'SI'),
(91, 'IPL MANCHAS', 12, 100000.00, '8000', '0', 'activo', '30', 'SI'),
(92, 'Láser Frio + DLM', 12, 150000.00, '15000', '0', 'activo', '25', 'SI'),
(93, 'Lifting Busto', 12, 80000.00, '10000', '0', 'activo', '30', 'SI'),
(94, 'Masaje Relajante Localizado', 12, 50000.00, '6000', '0', 'activo', '30', 'SI'),
(95, 'Masaje Reductor', 12, 70000.00, '13000', '0', 'inactivo', '30', 'SI'),
(96, 'Masaje Rela. Tessuni Russ', 12, 50000.00, '8000', '0', 'activo', '30', 'SI'),
(97, 'Momificacion', 12, 70000.00, '13000', '0', 'activo', '35', 'SI'),
(98, 'Parafina manos y pies', 12, 45500.00, '9000', '0', 'inactivo', '35', 'SI'),
(99, 'Presupuesto', 28, 0.00, '0', '0', 'activo', '0', 'NO'),
(100, '', 1, 0.00, '0', '0', 'inactivo', '0', 'SI'),
(101, 'Retoque de tatu. Parpado', 1, 70000.00, '13000', '0', 'inactivo', '35', 'SI'),
(102, 'Retoque de tatu. Cejas', 1, 80000.00, '13000', '0', 'inactivo', '35', 'SI'),
(103, 'Revisión', 28, 0.00, '0', '0', 'activo', '0', 'NO'),
(104, 'Revisión de Exámenes', 28, 0.00, '0', '0', 'activo', '0', 'NO'),
(105, 'Revisión Laser', 28, 0.00, '0', '0', 'activo', '0', 'NO'),
(106, 'Valoracion Fotodepilacion', 28, 0.00, '0', '0', 'activo', '0', 'NO'),
(107, 'Vibra Plate', 12, 15000.00, '3000', '0', 'activo', '30', 'SI'),
(108, 'Valoracion Médica', 28, 30000.00, '0', '0', 'activo', '0', 'NO'),
(109, 'Laser frio', 12, 150000.00, '5000', '0', 'inactivo', '25', 'SI'),
(110, 'Reservado', 28, 0.00, '', '', 'activo', '', 'NO'),
(111, 'Visita', 28, 0.00, '0', '0', 'activo', '0', 'NO'),
(112, 'Corrientes Rusas Papada', 1, 45000.00, '8000', '0', 'activo', '30', 'SI'),
(113, 'Depilación bozo, menton', 1, 12000.00, '3100', '', 'inactivo', '', 'SI'),
(114, 'Depilación cejas cuchilla', 1, 5000.00, '1293', '', 'inactivo', '', 'SI'),
(115, 'Depilacion Bozo, cejas', 1, 12000.00, '3100', '', 'inactivo', '', 'SI'),
(116, 'OBSEQUIOS', 0, 0.00, '', '', 'activo', '', 'SI'),
(117, 'Lifting Facial Obsequio', 116, 0.00, '7000', '0', 'activo', '30', 'SI'),
(118, 'Laser FTD Obsequio', 116, 0.00, '0', '0', 'activo', '0', 'SI'),
(119, 'Cold Laser + DLM Regalo', 12, 0.00, '8000', '', 'inactivo', '', 'SI'),
(120, 'Presoterapia regalo', 12, 0.00, '0', '', 'inactivo', '', 'SI'),
(121, 'Carboxiterapia Regalo', 12, 0.00, '2000', '', 'inactivo', '', 'SI'),
(122, 'Laser frio +Dlm obsequio', 116, 0.00, '0', '0', 'activo', '30', 'SI'),
(123, 'Preso obsequio', 116, 0.00, '0', '0', 'activo', '0', 'SI'),
(124, 'Carboxiterapia obsequio', 116, 0.00, '0', '0', 'activo', '0', 'SI'),
(125, 'Hidratación facial Luz de Asia', 1, 100000.00, '19000', '18000', 'inactivo', '35', 'SI'),
(126, 'Retoque Laser', 73, 0.00, '0', '0', 'activo', '0', 'SI'),
(127, 'Higiene, peeling, Mascarilla Golden secret', 1, 150000.00, '16000', '', 'inactivo', '30', 'SI'),
(128, 'Saponificación', 1, 80000.00, '8000', '', 'inactivo', '', 'SI'),
(129, 'Lodoterapia Corporal', 12, 50000.00, '6000', '0', 'activo', '25', 'SI'),
(130, 'Lodoterapia Facial', 1, 90000.00, '20000', '0', 'activo', '30', 'SI'),
(131, 'Mascarilla Golden Secret', 1, 20000.00, '0', '0', 'activo', '0', 'SI'),
(132, 'IPL NUCA OBSEQUIO', 116, 0.00, '0', '0', 'activo', '0', 'SI'),
(133, 'Exfoliación + Mascarilla Anticelulitica', 12, 100000.00, '10000', '0', 'activo', '30', 'SI'),
(134, 'Fotodepilacion barba', 1, 100000.00, '8000', '', 'inactivo', '30', 'SI'),
(135, 'Fotodepilacion Cuello', 1, 65000.00, '8000', '', 'activo', '30', 'SI'),
(136, 'Tatuaje Linea Superior Ojo Beige', 1, 100000.00, '18000', '', 'inactivo', '40', 'SI'),
(137, 'Hidratación con velo de colageno', 1, 25000.00, '0', '0', 'activo', '0', 'SI'),
(138, 'Mascarilla hidroplastica', 1, 30000.00, '0', '0', 'activo', '0', 'SI'),
(139, 'CAV + DLM PROMO', 12, 120000.00, '12000', '0', 'activo', '0', 'SI'),
(140, 'IPL ', 12, 100000.00, '7000', '0', 'inactivo', '0', 'SI'),
(141, 'LASER FRIO + DLM PROMO', 12, 150000.00, '13000', '0', 'inactivo', '0', 'SI'),
(142, 'CX PROMO', 12, 35000.00, '5000', '0', 'activo', '0', 'SI'),
(143, 'VIBRA PLATE PROMO', 12, 15000.00, '0', '0', 'inactivo', '0', 'SI'),
(144, 'Fotodepilacion Pecho', 12, 100000.00, '8000', '', 'activo', '30', 'SI'),
(145, 'Fotodepilacion Abdomen', 12, 200000.00, '16000', '0', 'activo', '30', 'SI'),
(146, 'Fotodepilacion Espalda completa', 12, 200000.00, '15000', '', 'activo', '30', 'SI'),
(147, 'Fotodepilacion Pubis', 12, 100000.00, '8000', '', 'activo', '30', 'SI'),
(148, 'Fotodepilacion Linea Alba', 12, 65000.00, '8000', '', 'activo', '30', 'SI'),
(149, 'Carboxiterapia promo', 12, 35000.00, '0', '0', 'inactivo', '0', 'SI'),
(150, 'Toma de muestra plasma', 12, 0.00, '15000', '0', 'activo', '0', 'SI'),
(151, 'Fotodepilacion coxi', 12, 100000.00, '8000', '0', 'activo', '30', 'SI'),
(152, 'IONIZACION AMP DE SESDERMA', 1, 60000.00, '0', '0', 'activo', '30', 'SI'),
(153, 'PEPTONAS', 12, 450000.00, '0', '0', 'activo', '30', 'SI'),
(154, '', 12, 0.00, '', '', 'inactivo', '', 'SI'),
(155, 'IPL FACIAL', 1, 100000.00, '8000', '0', 'activo', '30', 'SI'),
(156, 'ION', 1, 0.00, '0', '0', 'inactivo', '0', 'SI'),
(157, 'AURICULOTERAPIA', 12, 30000.00, '0', '0', 'inactivo', '0', 'SI'),
(158, 'Fotodepilacion Orejas', 1, 65000.00, '8000', '', 'activo', '30', 'SI'),
(159, 'DP CERA OREJAS', 1, 25000.00, '2500', '', 'inactivo', '35', 'SI'),
(160, 'MASAJE PIEDRAS CALIENTES', 12, 150000.00, '20000', '0', 'activo', '30', 'SI'),
(161, 'Programa nutricional', 12, 20000.00, '0', '0', 'inactivo', '0', 'SI'),
(162, 'Model Shape - Moldeamiento', 12, 220000.00, '20000', '0', 'activo', '30', 'SI'),
(163, 'Model Shape - Criolipolisis', 12, 200000.00, '10000', '0', 'activo', '25', 'SI'),
(164, 'Lipomax', 12, 220000.00, '20000', '0', 'activo', '20', 'SI'),
(165, '', 0, 0.00, '', '', 'inactivo', '', 'SI'),
(166, 'DLM-US', 12, 50000.00, '8000', '', 'activo', '30', 'SI'),
(167, 'Lipo Stem Cell', 73, 0.00, '0', '0', 'activo', '0', 'SI'),
(168, '', 0, 0.00, '', '', 'inactivo', '', 'SI'),
(169, 'LIPOMAX OBSEQUIO', 116, 0.00, '0', '0', 'activo', '0', 'NO'),
(170, 'Bamboterapia', 12, 100000.00, '20000', '0', 'activo', '30', 'SI'),
(171, 'Laser sin confirmar', 73, 0.00, '0', '0', 'activo', '0', 'NO'),
(172, 'Malla Supralingual', 12, 1200000.00, '0', '0', 'inactivo', '0', 'SI'),
(173, 'MODELSHAPE OBSEQUIO', 116, 0.00, '0', '0', 'activo', '0', 'SI'),
(174, 'Valoracion promigas', 28, 0.00, '0', '0', 'inactivo', '0', 'SI'),
(175, 'Microdermoinfusion Obsequio', 116, 0.00, '0', '0', 'activo', '0', 'SI'),
(176, 'Otoplastia', 19, 0.00, '', '', 'activo', '', 'SI'),
(177, 'IPL Vascular', 12, 140000.00, '', '', 'activo', '', 'NO'),
(178, 'Otros procedimientos Dra', 73, 0.00, '0', '0', 'activo', '0', 'SI'),
(179, 'Paquete de post laserlipolisis 10 ss', 12, 450000.00, '450000', '', 'activo', '', 'SI'),
(180, 'Pestañas Postizas', 1, 25000.00, '', '', 'inactivo', '', 'SI'),
(181, 'DP  Cera Barba', 19, 25000.00, '', '', 'activo', '', 'SI'),
(182, 'Biopuntura ', 73, 70000.00, '0', '', 'activo', '0', 'SI'),
(183, 'LipoTransferencia', 73, 4500000.00, '', '', 'activo', '', 'SI'),
(184, 'GluteoStemcell', 73, 6000000.00, '', '', 'activo', '', 'SI'),
(185, 'Lipoinjerto Facial', 1, 0.00, '', '', 'activo', '', 'SI'),
(186, 'skinboosters', 1, 790000.00, '0', '', 'activo', '0', 'SI'),
(187, 'Homeosiniatria Vascular', 12, 90000.00, '', '', 'activo', '', 'NO'),
(188, 'LPG Lipomassage', 12, 240000.00, '20000', '', 'activo', '20', 'SI'),
(189, 'PSO', 28, 0.00, '', '', 'activo', '', 'NO'),
(190, 'FURURA', 12, 130000.00, '10000', '', 'activo', '20', 'SI'),
(191, 'M.A.D. Laser', 73, 0.00, '', '', 'activo', '', 'SI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_efectivo`
--

CREATE TABLE IF NOT EXISTS `caja_efectivo` (
  `personal_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  PRIMARY KEY (`personal_id`),
  KEY `personal_id` (`personal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_efectivo_detalle`
--

CREATE TABLE IF NOT EXISTS `caja_efectivo_detalle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caja_efectivo_id` int(11) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `tipo` varchar(15) NOT NULL,
  `ingreso_id` int(11) DEFAULT NULL,
  `egreso_id` int(11) DEFAULT NULL,
  `venta_id` int(11) DEFAULT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `caja_efectivo_id` (`caja_efectivo_id`),
  KEY `ingreso_id` (`ingreso_id`),
  KEY `egreso_id` (`egreso_id`),
  KEY `venta_id` (`venta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centro_costo`
--

CREATE TABLE IF NOT EXISTS `centro_costo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `estado` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE IF NOT EXISTS `citas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(11) NOT NULL,
  `n_identificacion` varchar(25) NOT NULL,
  `personal_id` int(11) NOT NULL,
  `paciente_orden_id` int(11) DEFAULT NULL,
  `linea_servicio_id` int(11) NOT NULL,
  `estado` varchar(10) NOT NULL,
  `fecha_cita` date NOT NULL,
  `hora_inicio` int(15) NOT NULL,
  `hora_fin` int(15) NOT NULL,
  `correo` char(2) NOT NULL,
  `equipo_adicional` int(11) DEFAULT NULL,
  `comentario` text NOT NULL,
  `contrato_id` int(11) DEFAULT NULL,
  `motivo_cancelacion` text NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha_accion` datetime NOT NULL,
  `confirmacion` text NOT NULL,
  `fecha_confirmacion` datetime NOT NULL,
  `confirmacion_personal_id` int(11) DEFAULT NULL,
  `omitir_seguimiento` char(2) NOT NULL,
  `comentario_cierre` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `paciente_id` (`paciente_id`),
  KEY `personal_id` (`personal_id`),
  KEY `paciente_orden_id` (`paciente_orden_id`),
  KEY `linea_servicio_id` (`linea_servicio_id`),
  KEY `hora_inicio` (`hora_inicio`),
  KEY `hora_fin` (`hora_fin`),
  KEY `contrato_id` (`contrato_id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `confirmacion_personal_id` (`confirmacion_personal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuraciones_generales`
--

CREATE TABLE IF NOT EXISTS `configuraciones_generales` (
  `iva` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos`
--

CREATE TABLE IF NOT EXISTS `contratos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `presupuesto_id` int(11) DEFAULT NULL,
  `paciente_id` int(11) NOT NULL,
  `estado` varchar(25) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total` decimal(10,2) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `observaciones` text NOT NULL,
  `saldo` decimal(10,2) NOT NULL,
  `descuento_liquidacion` decimal(10,2) NOT NULL,
  `porcentaje_descuento_liquidacion` decimal(10,2) NOT NULL,
  `observaciones_liquidacion` text NOT NULL,
  `n_identificacion` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `presupuesto_id` (`presupuesto_id`),
  KEY `paciente_id` (`paciente_id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos_tratamiento_realizados`
--

CREATE TABLE IF NOT EXISTS `contratos_tratamiento_realizados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contrato_id` int(11) NOT NULL,
  `cita_id` int(11) NOT NULL,
  `linea_servicio_id` int(11) NOT NULL,
  `sesion` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `contrato_id` (`contrato_id`,`cita_id`,`linea_servicio_id`),
  KEY `cita_id` (`cita_id`),
  KEY `linea_servicio_id` (`linea_servicio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrato_detalle`
--

CREATE TABLE IF NOT EXISTS `contrato_detalle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contrato_id` int(11) NOT NULL,
  `linea_servicio_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `realizadas` int(11) NOT NULL,
  `vu` decimal(10,2) NOT NULL,
  `desc` int(11) NOT NULL,
  `vu_desc` decimal(10,2) NOT NULL,
  `vt_sin_desc` decimal(10,2) NOT NULL,
  `vt_con_desc` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `estado` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `contrato_id` (`contrato_id`),
  KEY `linea_servicio_id` (`linea_servicio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cosmetologa_orden`
--

CREATE TABLE IF NOT EXISTS `cosmetologa_orden` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contrato_detalle_id` int(11) NOT NULL,
  `sesion` varchar(4) NOT NULL,
  `cosmetologa_id` int(11) NOT NULL,
  `estado` varchar(15) NOT NULL,
  `fecha_servicio` date NOT NULL,
  `fecha_pago` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `contrato_detalle_id` (`contrato_detalle_id`),
  KEY `cosmetologa_id` (`cosmetologa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diagnosticos`
--

CREATE TABLE IF NOT EXISTS `diagnosticos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `diagnostico` varchar(75) NOT NULL,
  `tipo` varchar(25) NOT NULL,
  `estado` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diagnostico_principal`
--

CREATE TABLE IF NOT EXISTS `diagnostico_principal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `diagnostico` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diagnostico_relacionado`
--

CREATE TABLE IF NOT EXISTS `diagnostico_relacionado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `diagnostico` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `egresos`
--

CREATE TABLE IF NOT EXISTS `egresos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proveedor_id` int(11) NOT NULL,
  `n_identificacion` varchar(30) NOT NULL,
  `observaciones` text NOT NULL,
  `aplica_factura` char(2) NOT NULL,
  `factura_id` int(11) DEFAULT NULL,
  `forma_pago` varchar(15) NOT NULL,
  `desc_pronto_pago` char(2) NOT NULL,
  `desc_pronto_pago_tipo` char(1) NOT NULL,
  `desc_pronto_pago_valor` decimal(10,2) NOT NULL,
  `iva_porcentace` decimal(10,2) NOT NULL,
  `valor_egreso` decimal(10,2) NOT NULL,
  `total_descuento` decimal(10,2) NOT NULL,
  `iva_valor` decimal(10,2) NOT NULL,
  `rte_aplica` char(2) NOT NULL,
  `retencion_id` int(11) DEFAULT NULL,
  `a_retener` decimal(10,2) NOT NULL,
  `rte_base` decimal(10,2) NOT NULL,
  `rte_porcenaje` decimal(10,2) NOT NULL,
  `rte_iva` char(2) NOT NULL,
  `rte_iva_porcentaje` decimal(10,2) NOT NULL,
  `rte_iva_valor` decimal(10,2) NOT NULL,
  `rte_ica` char(2) NOT NULL,
  `rte_ica_porcentaje` decimal(10,2) NOT NULL,
  `rte_ica_valor` decimal(10,2) NOT NULL,
  `rte_cree` char(2) NOT NULL,
  `rte_cree_porcentaje` decimal(10,2) NOT NULL,
  `rte_cree_valor` decimal(10,2) NOT NULL,
  `centro_costo_id` int(11) NOT NULL,
  `total_egreso` decimal(10,2) NOT NULL,
  `banco_cuenta_id` int(11) DEFAULT NULL,
  `banco_destino` varchar(30) NOT NULL,
  `cuenta_destino` varchar(30) NOT NULL,
  `fecha` datetime NOT NULL,
  `personal_id` int(11) NOT NULL,
  `estado` varchar(15) NOT NULL,
  `fecha_sola` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `banco_cuenta_id` (`banco_cuenta_id`),
  KEY `personal_id` (`personal_id`),
  KEY `proveedor_id` (`proveedor_id`),
  KEY `factura_id` (`factura_id`),
  KEY `retencion_id` (`retencion_id`),
  KEY `centro_costo_id` (`centro_costo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE IF NOT EXISTS `equipos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) NOT NULL,
  `linea_servicio_id` int(11) DEFAULT NULL,
  `numero` int(11) NOT NULL,
  `Estado` varchar(10) NOT NULL,
  `marca` varchar(25) NOT NULL,
  `modelo` varchar(25) NOT NULL,
  `serial` varchar(50) NOT NULL,
  `voltaje` varchar(10) NOT NULL,
  `ubicacion` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `linea_servicio_id` (`linea_servicio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos_observaciones`
--

CREATE TABLE IF NOT EXISTS `equipos_observaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `equipo_id` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `observacion` text NOT NULL,
  `fecha` datetime NOT NULL,
  `personal_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `equipo_id` (`equipo_id`),
  KEY `personal_id` (`personal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formulacion`
--

CREATE TABLE IF NOT EXISTS `formulacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(75) NOT NULL,
  `presentacion` varchar(75) NOT NULL,
  `unidad_medida` varchar(75) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fuente_contacto`
--

CREATE TABLE IF NOT EXISTS `fuente_contacto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fuente` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_anamnesis`
--

CREATE TABLE IF NOT EXISTS `historial_anamnesis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(11) NOT NULL,
  `cita_id` int(11) DEFAULT NULL,
  `personal_id` int(11) NOT NULL,
  `motivo_consulta` text NOT NULL,
  `enfermedad_actual` text NOT NULL,
  `antecedente_patologico` text NOT NULL,
  `antecedente_quirurgico` text NOT NULL,
  `antecedente_alergico` text NOT NULL,
  `antecedente_traumatico` text NOT NULL,
  `antecedente_medicamento` text NOT NULL,
  `antecedente_ginecologico` text NOT NULL,
  `antecedente_fum` text NOT NULL,
  `antecedente_habitos` text NOT NULL,
  `antecedente_familiares` text NOT NULL,
  `antecedente_nutricionales` text NOT NULL,
  `observaciones_paciente` text NOT NULL,
  `fecha` datetime NOT NULL,
  `estado` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `paciente_id` (`paciente_id`),
  KEY `personal_id` (`personal_id`),
  KEY `cita_id` (`cita_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_descripcion_quirurgica`
--

CREATE TABLE IF NOT EXISTS `historial_descripcion_quirurgica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(11) NOT NULL,
  `cita_id` int(11) NOT NULL,
  `servicio` varchar(75) NOT NULL,
  `diagnostico_preoperatorio` text NOT NULL,
  `diagnostico_posoperatorio` text NOT NULL,
  `cirujano_id` int(11) NOT NULL,
  `ayudante_id` int(11) NOT NULL,
  `anestesiologo_id` int(11) NOT NULL,
  `inst_quirurgico_id` int(11) NOT NULL,
  `fecha_cirugia` date NOT NULL,
  `hora_inicio` varchar(7) NOT NULL,
  `hora_final` varchar(7) NOT NULL,
  `codigo_cups` varchar(25) NOT NULL,
  `intervencion` varchar(150) NOT NULL,
  `control_compresas` varchar(25) NOT NULL,
  `tipo_anestesia` varchar(150) NOT NULL,
  `descripcion_hallazgos` text NOT NULL,
  `personal_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `observaciones` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `paciente_id` (`paciente_id`,`cirujano_id`,`ayudante_id`,`anestesiologo_id`,`inst_quirurgico_id`,`personal_id`),
  KEY `cirujano_id` (`cirujano_id`),
  KEY `ayudante_id` (`ayudante_id`),
  KEY `anestesiologo_id` (`anestesiologo_id`),
  KEY `inst_quirurgico_id` (`inst_quirurgico_id`),
  KEY `personal_id` (`personal_id`),
  KEY `cita_id` (`cita_id`),
  KEY `cita_id_2` (`cita_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_diagnostico`
--

CREATE TABLE IF NOT EXISTS `historial_diagnostico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cita_id` int(11) DEFAULT NULL,
  `paciente_id` int(11) NOT NULL,
  `observaciones` text NOT NULL,
  `personal_id` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cita_id` (`cita_id`),
  KEY `paciente_id` (`paciente_id`),
  KEY `personal_id` (`personal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_diagnostico_detalle`
--

CREATE TABLE IF NOT EXISTS `historial_diagnostico_detalle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `historial_diagnostico_id` int(11) NOT NULL,
  `diagnostico_id` int(11) NOT NULL,
  `observaciones` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `historial_diagnostico_id` (`historial_diagnostico_id`),
  KEY `diagnostico_id` (`diagnostico_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_evaluacion_cosmetologica`
--

CREATE TABLE IF NOT EXISTS `historial_evaluacion_cosmetologica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(11) NOT NULL,
  `cita_id` int(11) DEFAULT NULL,
  `personal_id` int(11) NOT NULL,
  `evaluacion` text NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `paciente_id` (`paciente_id`),
  KEY `cita_id` (`cita_id`),
  KEY `personal_id` (`personal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_evaluacion_enfermeria`
--

CREATE TABLE IF NOT EXISTS `historial_evaluacion_enfermeria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(11) NOT NULL,
  `cita_id` int(11) DEFAULT NULL,
  `personal_id` int(11) NOT NULL,
  `evaluacion` text NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `paciente_id` (`paciente_id`),
  KEY `cita_id` (`cita_id`),
  KEY `personal_id` (`personal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_evaluacion_medica`
--

CREATE TABLE IF NOT EXISTS `historial_evaluacion_medica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(11) NOT NULL,
  `cita_id` int(11) NOT NULL,
  `personal_id` int(11) DEFAULT NULL,
  `diagnostico_principal_id` int(11) NOT NULL,
  `diagnostico_relacional_id` int(11) NOT NULL,
  `evolucion` text NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `paciente_id` (`paciente_id`),
  KEY `cita_id` (`cita_id`),
  KEY `personal_id` (`personal_id`),
  KEY `diagnostico_principal_id` (`diagnostico_principal_id`),
  KEY `diagnostico_relacional_id` (`diagnostico_relacional_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_examen_fisico`
--

CREATE TABLE IF NOT EXISTS `historial_examen_fisico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(11) NOT NULL,
  `cita_id` int(11) DEFAULT NULL,
  `personal_id` int(11) DEFAULT NULL,
  `diagnostico_principal_id` int(11) NOT NULL,
  `diagnostico_relacionado_id` int(11) NOT NULL,
  `peso` decimal(10,2) NOT NULL,
  `altura` decimal(10,2) NOT NULL,
  `imc` decimal(10,2) NOT NULL,
  `cabeza_cuello` text NOT NULL,
  `cardiopulmonar` text NOT NULL,
  `abdomen` text NOT NULL,
  `extremidades` text NOT NULL,
  `sistema_nervioso` text NOT NULL,
  `piel_fanera` text NOT NULL,
  `otros` text NOT NULL,
  `observaciones` text NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `paciente_id` (`paciente_id`),
  KEY `diagnostico_principal_id` (`diagnostico_principal_id`),
  KEY `diagnostico_relacionado_id` (`diagnostico_relacionado_id`),
  KEY `cita_id` (`cita_id`),
  KEY `personal_id` (`personal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_formulacion`
--

CREATE TABLE IF NOT EXISTS `historial_formulacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cita_id` int(11) DEFAULT NULL,
  `paciente_id` int(11) NOT NULL,
  `personal_id` int(11) DEFAULT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cita_id` (`cita_id`),
  KEY `paciente_id` (`paciente_id`),
  KEY `personal_id` (`personal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_formulacion_detalle`
--

CREATE TABLE IF NOT EXISTS `historial_formulacion_detalle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `formulacion_id` int(11) DEFAULT NULL,
  `otra_formulacion` varchar(60) NOT NULL,
  `formulacion` text NOT NULL,
  `historial_formulacion_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `formulacion_id` (`formulacion_id`),
  KEY `historial_formulacion_id` (`historial_formulacion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_laboratorio`
--

CREATE TABLE IF NOT EXISTS `historial_laboratorio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(11) NOT NULL,
  `cita_id` int(11) DEFAULT NULL,
  `personal_id` int(11) NOT NULL,
  `comentarios` text NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `paciente_id` (`paciente_id`),
  KEY `cita_id` (`cita_id`),
  KEY `personal_id` (`personal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_laboratorio_detalle`
--

CREATE TABLE IF NOT EXISTS `historial_laboratorio_detalle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `historial_laboratorio_id` int(11) NOT NULL,
  `laboratorio_id` int(11) NOT NULL,
  `examen` varchar(75) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `historial_laboratorio_id` (`historial_laboratorio_id`),
  KEY `laboratorio_id` (`laboratorio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_medicina_biologica`
--

CREATE TABLE IF NOT EXISTS `historial_medicina_biologica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cita_id` int(11) DEFAULT NULL,
  `paciente_id` int(11) NOT NULL,
  `personal_id` int(11) NOT NULL,
  `observaciones` text NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cita_id` (`cita_id`),
  KEY `paciente_id` (`paciente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_medicina_biologica_detalle`
--

CREATE TABLE IF NOT EXISTS `historial_medicina_biologica_detalle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sesion` int(11) NOT NULL,
  `historial_medicina_biologica_id` int(11) NOT NULL,
  `ciclo` int(11) NOT NULL,
  `medicamentos_biologicos_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `historial_medicina_biologica_id` (`historial_medicina_biologica_id`),
  KEY `medicamentos_biologicos_id` (`medicamentos_biologicos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_notas_enfermeria`
--

CREATE TABLE IF NOT EXISTS `historial_notas_enfermeria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(11) NOT NULL,
  `cita_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `observaciones` text NOT NULL,
  `personal_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `paciente_id` (`paciente_id`),
  KEY `cita_id` (`cita_id`),
  KEY `personal_id` (`personal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_notas_enfermeria_detalles`
--

CREATE TABLE IF NOT EXISTS `historial_notas_enfermeria_detalles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `historial_notas_enfermeria_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` varchar(7) NOT NULL,
  `nota` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `historial_notas_enfermeria_id` (`historial_notas_enfermeria_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_plan_tratamiento`
--

CREATE TABLE IF NOT EXISTS `historial_plan_tratamiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(11) NOT NULL,
  `cita_id` int(11) DEFAULT NULL,
  `personal_id` int(11) NOT NULL,
  `observaciones` text NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `paciente_id` (`paciente_id`),
  KEY `cita_id` (`cita_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_plan_tratamiento_detalle`
--

CREATE TABLE IF NOT EXISTS `historial_plan_tratamiento_detalle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `historial_plan_tratamiento_id` int(11) NOT NULL,
  `linea_servicio_id` int(11) NOT NULL,
  `observacion` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `historial_plan_tratamiento_id` (`historial_plan_tratamiento_id`),
  KEY `linea_servicio_id` (`linea_servicio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_revision_sistema`
--

CREATE TABLE IF NOT EXISTS `historial_revision_sistema` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(11) NOT NULL,
  `cita_id` int(11) DEFAULT NULL,
  `personal_id` int(11) NOT NULL,
  `c_c_c` text NOT NULL,
  `cardio_respiratorio` text NOT NULL,
  `sistema_digestivo` text NOT NULL,
  `sistema_genitoUrinario` text NOT NULL,
  `sistema_locomotor` text NOT NULL,
  `sistema_nervioso` text NOT NULL,
  `sistema_tegumentario` text NOT NULL,
  `observaciones` text NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `paciente_id` (`paciente_id`),
  KEY `cita_id` (`cita_id`),
  KEY `personal_id` (`personal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_tabla_medidas`
--

CREATE TABLE IF NOT EXISTS `historial_tabla_medidas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cita_id` int(11) DEFAULT NULL,
  `paciente_id` int(11) NOT NULL,
  `personal_id` int(11) NOT NULL,
  `imc` decimal(10,2) NOT NULL,
  `peso` decimal(10,2) NOT NULL,
  `busto` decimal(10,2) NOT NULL,
  `contorno` decimal(10,2) NOT NULL,
  `cintura` decimal(10,2) NOT NULL,
  `umbilical` decimal(10,2) NOT NULL,
  `abd_inferior` decimal(10,2) NOT NULL,
  `abd_superior` decimal(10,2) NOT NULL,
  `cadera` decimal(10,2) NOT NULL,
  `piernas` decimal(10,2) NOT NULL,
  `muslo_derecho` decimal(10,2) NOT NULL,
  `muslo_izquierdo` decimal(10,2) NOT NULL,
  `brazo_derecho` decimal(10,2) NOT NULL,
  `brazo_izquierdo` decimal(10,2) NOT NULL,
  `fecha` date NOT NULL,
  `observaciones` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cita_id` (`cita_id`),
  KEY `paciente_id` (`paciente_id`),
  KEY `personal_id` (`personal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hoja_gastos`
--

CREATE TABLE IF NOT EXISTS `hoja_gastos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(11) NOT NULL,
  `cita_id` int(11) NOT NULL,
  `personal_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `observaciones` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `paciente_id` (`paciente_id`,`cita_id`,`personal_id`),
  KEY `cita_id` (`cita_id`),
  KEY `personal_id` (`personal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hoja_gastos_cirugia`
--

CREATE TABLE IF NOT EXISTS `hoja_gastos_cirugia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(11) NOT NULL,
  `cita_id` int(11) NOT NULL,
  `fecha_cirugia` date NOT NULL,
  `sala` int(11) NOT NULL,
  `peso` decimal(10,2) NOT NULL,
  `tipo_paciente` varchar(20) NOT NULL,
  `tipo_anestesia` varchar(20) NOT NULL,
  `tipo_cirugia` varchar(20) NOT NULL,
  `cirugia` varchar(150) NOT NULL,
  `cirugia_codigo` varchar(20) NOT NULL,
  `hora_ingreso` varchar(7) NOT NULL,
  `hora_inicio_cirugia` varchar(7) NOT NULL,
  `hora_final_cirugia` varchar(7) NOT NULL,
  `cirujano_id` int(11) NOT NULL,
  `ayudante_id` int(11) NOT NULL,
  `anestesiologo_id` int(11) NOT NULL,
  `rotadora_id` int(11) NOT NULL,
  `instrumentadora_id` int(11) NOT NULL,
  `cantidad_productos` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `personal_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `paciente_id` (`paciente_id`,`cita_id`),
  KEY `cirujano_id` (`cirujano_id`,`ayudante_id`,`anestesiologo_id`,`rotadora_id`,`instrumentadora_id`,`personal_id`),
  KEY `cita_id` (`cita_id`),
  KEY `ayudante_id` (`ayudante_id`),
  KEY `anestesiologo_id` (`anestesiologo_id`),
  KEY `rotadora_id` (`rotadora_id`),
  KEY `instrumentadora_id` (`instrumentadora_id`),
  KEY `personal_id` (`personal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hoja_gastos_cirugia_detalle`
--

CREATE TABLE IF NOT EXISTS `hoja_gastos_cirugia_detalle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hoja_gastos_cirugia_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hoja_gastos_cirugia_id` (`hoja_gastos_cirugia_id`),
  KEY `producto_id` (`producto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hoja_gastos_detalle`
--

CREATE TABLE IF NOT EXISTS `hoja_gastos_detalle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hoja_gastos_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hoja_gastos_id` (`hoja_gastos_id`,`producto_id`),
  KEY `producto_id` (`producto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horas_servicio`
--

CREATE TABLE IF NOT EXISTS `horas_servicio` (
  `id` int(11) NOT NULL,
  `hr` char(2) NOT NULL,
  `minutos` char(2) NOT NULL,
  `tiempo` varchar(2) NOT NULL,
  `hora` char(7) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `horas_servicio`
--

INSERT INTO `horas_servicio` (`id`, `hr`, `minutos`, `tiempo`, `hora`) VALUES
(1, '06', '00', 'am', '06:00am'),
(2, '06', '05', 'am', '06:05am'),
(3, '06', '10', 'am', '06:10am'),
(4, '06', '15', 'am', '06:15am'),
(5, '06', '20', 'am', '06:20am'),
(6, '06', '25', 'am', '06:25am'),
(7, '06', '30', 'am', '06:30am'),
(8, '06', '35', 'am', '06:35am'),
(9, '06', '40', 'am', '06:40am'),
(10, '06', '45', 'am', '06:45am'),
(11, '06', '50', 'am', '06:50am'),
(12, '06', '55', 'am', '06:55am'),
(13, '07', '00', 'am', '07:00am'),
(14, '07', '05', 'am', '07:05am'),
(15, '07', '10', 'am', '07:10am'),
(16, '07', '15', 'am', '07:15am'),
(17, '07', '20', 'am', '07:20am'),
(18, '07', '25', 'am', '07:25am'),
(19, '07', '30', 'am', '07:30am'),
(20, '07', '35', 'am', '07:35am'),
(21, '07', '40', 'am', '07:40am'),
(22, '07', '45', 'am', '07:45am'),
(23, '07', '50', 'am', '07:50am'),
(24, '07', '55', 'am', '07:55am'),
(25, '08', '00', 'am', '08:00am'),
(26, '08', '05', 'am', '08:05am'),
(27, '08', '10', 'am', '08:10am'),
(28, '08', '15', 'am', '08:15am'),
(29, '08', '20', 'am', '08:20am'),
(30, '08', '25', 'am', '08:25am'),
(31, '08', '30', 'am', '08:30am'),
(32, '08', '35', 'am', '08:35am'),
(33, '08', '40', 'am', '08:40am'),
(34, '08', '45', 'am', '08:45am'),
(35, '08', '50', 'am', '08:50am'),
(36, '08', '55', 'am', '08:55am'),
(37, '09', '00', 'am', '09:00am'),
(38, '09', '05', 'am', '09:05am'),
(39, '09', '10', 'am', '09:10am'),
(40, '09', '15', 'am', '09:15am'),
(41, '09', '20', 'am', '09:20am'),
(42, '09', '25', 'am', '09:25am'),
(43, '09', '30', 'am', '09:30am'),
(44, '09', '35', 'am', '09:35am'),
(45, '09', '40', 'am', '09:40am'),
(46, '09', '45', 'am', '09:45am'),
(47, '09', '50', 'am', '09:50am'),
(48, '09', '55', 'am', '09:55am'),
(49, '10', '00', 'am', '10:00am'),
(50, '10', '05', 'am', '10:05am'),
(51, '10', '10', 'am', '10:10am'),
(52, '10', '15', 'am', '10:15am'),
(53, '10', '20', 'am', '10:20am'),
(54, '10', '25', 'am', '10:25am'),
(55, '10', '30', 'am', '10:30am'),
(56, '10', '35', 'am', '10:35am'),
(57, '10', '40', 'am', '10:40am'),
(58, '10', '45', 'am', '10:45am'),
(59, '10', '50', 'am', '10:50am'),
(60, '10', '55', 'am', '10:55am'),
(61, '11', '00', 'am', '11:00am'),
(62, '11', '05', 'am', '11:05am'),
(63, '11', '10', 'am', '11:10am'),
(64, '11', '15', 'am', '11:15am'),
(65, '11', '20', 'am', '11:20am'),
(66, '11', '25', 'am', '11:25am'),
(67, '11', '30', 'am', '11:30am'),
(68, '11', '35', 'am', '11:35am'),
(69, '11', '40', 'am', '11:40am'),
(70, '11', '45', 'am', '11:45am'),
(71, '11', '50', 'am', '11:50am'),
(72, '11', '55', 'am', '11:55am'),
(73, '12', '00', 'pm', '12:00pm'),
(74, '12', '05', 'pm', '12:05pm'),
(75, '12', '10', 'pm', '12:10pm'),
(76, '12', '15', 'pm', '12:15pm'),
(77, '12', '20', 'pm', '12:20pm'),
(78, '12', '25', 'pm', '12:25pm'),
(79, '12', '30', 'pm', '12:30pm'),
(80, '12', '35', 'pm', '12:35pm'),
(81, '12', '40', 'pm', '12:40pm'),
(82, '12', '45', 'pm', '12:45pm'),
(83, '12', '50', 'pm', '12:50pm'),
(84, '12', '55', 'pm', '12:55pm'),
(85, '01', '00', 'pm', '01:00pm'),
(86, '01', '05', 'pm', '01:05pm'),
(87, '01', '10', 'pm', '01:10pm'),
(88, '01', '15', 'pm', '01:15pm'),
(89, '01', '20', 'pm', '01:20pm'),
(90, '01', '25', 'pm', '01:25pm'),
(91, '01', '30', 'pm', '01:30pm'),
(92, '01', '35', 'pm', '01:35pm'),
(93, '01', '40', 'pm', '01:40pm'),
(94, '01', '45', 'pm', '01:45pm'),
(95, '01', '50', 'pm', '01:50pm'),
(96, '01', '55', 'pm', '01:55pm'),
(97, '02', '00', 'pm', '02:00pm'),
(98, '02', '05', 'pm', '02:05pm'),
(99, '02', '10', 'pm', '02:10pm'),
(100, '02', '15', 'pm', '02:15pm'),
(101, '02', '20', 'pm', '02:20pm'),
(102, '02', '25', 'pm', '02:25pm'),
(103, '02', '30', 'pm', '02:30pm'),
(104, '02', '35', 'pm', '02:35pm'),
(105, '02', '40', 'pm', '02:40pm'),
(106, '02', '45', 'pm', '02:45pm'),
(107, '02', '50', 'pm', '02:50pm'),
(108, '02', '55', 'pm', '02:55pm'),
(109, '03', '00', 'pm', '03:00pm'),
(110, '03', '05', 'pm', '03:05pm'),
(111, '03', '10', 'pm', '03:10pm'),
(112, '03', '15', 'pm', '03:15pm'),
(113, '03', '20', 'pm', '03:20pm'),
(114, '03', '25', 'pm', '03:25pm'),
(115, '03', '30', 'pm', '03:30pm'),
(116, '03', '35', 'pm', '03:35pm'),
(117, '03', '40', 'pm', '03:40pm'),
(118, '03', '45', 'pm', '03:45pm'),
(119, '03', '50', 'pm', '03:50pm'),
(120, '03', '55', 'pm', '03:55pm'),
(121, '04', '00', 'pm', '04:00pm'),
(122, '04', '05', 'pm', '04:05pm'),
(123, '04', '10', 'pm', '04:10pm'),
(124, '04', '15', 'pm', '04:15pm'),
(125, '04', '20', 'pm', '04:20pm'),
(126, '04', '25', 'pm', '04:25pm'),
(127, '04', '30', 'pm', '04:30pm'),
(128, '04', '35', 'pm', '04:35pm'),
(129, '04', '40', 'pm', '04:40pm'),
(130, '04', '45', 'pm', '04:45pm'),
(131, '04', '50', 'pm', '04:50pm'),
(132, '04', '55', 'pm', '04:55pm'),
(133, '05', '00', 'pm', '05:00pm'),
(134, '05', '05', 'pm', '05:05pm'),
(135, '05', '10', 'pm', '05:10pm'),
(136, '05', '15', 'pm', '05:15pm'),
(137, '05', '20', 'pm', '05:20pm'),
(138, '05', '25', 'pm', '05:25pm'),
(139, '05', '30', 'pm', '05:30pm'),
(140, '05', '35', 'pm', '05:35pm'),
(141, '05', '40', 'pm', '05:40pm'),
(142, '05', '45', 'pm', '05:45pm'),
(143, '05', '50', 'pm', '05:50pm'),
(144, '05', '55', 'pm', '05:55pm'),
(145, '06', '00', 'pm', '06:00pm'),
(146, '06', '05', 'pm', '06:05pm'),
(147, '06', '10', 'pm', '06:10pm'),
(148, '06', '15', 'pm', '06:15pm'),
(149, '06', '20', 'pm', '06:20pm'),
(150, '06', '25', 'pm', '06:25pm'),
(151, '06', '30', 'pm', '06:30pm'),
(152, '06', '35', 'pm', '06:35pm'),
(153, '06', '40', 'pm', '06:40pm'),
(154, '06', '45', 'pm', '06:45pm'),
(155, '06', '50', 'pm', '06:50pm'),
(156, '06', '55', 'pm', '06:55pm'),
(157, '07', '00', 'pm', '07:00pm'),
(158, '07', '05', 'pm', '07:05pm'),
(159, '07', '10', 'pm', '07:10pm'),
(160, '07', '15', 'pm', '07:15pm'),
(161, '07', '20', 'pm', '07:20pm'),
(162, '07', '25', 'pm', '07:25pm'),
(163, '07', '30', 'pm', '07:30pm'),
(164, '07', '35', 'pm', '07:35pm'),
(165, '07', '40', 'pm', '07:40pm'),
(166, '07', '45', 'pm', '07:45pm'),
(167, '07', '50', 'pm', '07:50pm'),
(168, '07', '55', 'pm', '07:55pm'),
(169, '08', '00', 'pm', '08:00pm');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos`
--

CREATE TABLE IF NOT EXISTS `ingresos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(11) NOT NULL,
  `n_identificacion` varchar(100) NOT NULL,
  `contrato_id` int(11) DEFAULT NULL,
  `valor` decimal(10,2) NOT NULL,
  `descripcion` text NOT NULL,
  `centro_costo_id` int(11) NOT NULL,
  `forma_pago` varchar(20) NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_sola` date NOT NULL,
  `cheques_cantidad` int(11) NOT NULL,
  `cheques_banco_cuenta_id` int(11) DEFAULT NULL,
  `cheques_total` decimal(10,2) NOT NULL,
  `tarjeta_tipo` varchar(20) NOT NULL,
  `tarjeta_aprobacion` varchar(25) NOT NULL,
  `tarjeta_entidad` varchar(25) NOT NULL,
  `tarjeta_banco_cuenta_id` int(11) DEFAULT NULL,
  `consigna_banco_o` varchar(25) NOT NULL,
  `consigna_cuenta_o` varchar(25) NOT NULL,
  `consigna_banco_d_cuenta_id` int(11) DEFAULT NULL,
  `personal_id` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `paciente_id` (`paciente_id`),
  KEY `contrato_id` (`contrato_id`),
  KEY `centro_costo_id` (`centro_costo_id`),
  KEY `cheques_banco_cuenta_id` (`cheques_banco_cuenta_id`),
  KEY `cheques_banco_cuenta_id_2` (`cheques_banco_cuenta_id`),
  KEY `tarjeta_banco_cuenta_id` (`tarjeta_banco_cuenta_id`),
  KEY `consigna_banco_d_cuenta_id` (`consigna_banco_d_cuenta_id`),
  KEY `personal_id` (`personal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos_cheques`
--

CREATE TABLE IF NOT EXISTS `ingresos_cheques` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ingresos_id` int(11) NOT NULL,
  `numero` varchar(25) NOT NULL,
  `entidad` varchar(25) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `f_cobro` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ingresos_id` (`ingresos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_personal`
--

CREATE TABLE IF NOT EXISTS `inventario_personal` (
  `personal_id` int(11) NOT NULL,
  `comentario` text NOT NULL,
  PRIMARY KEY (`personal_id`),
  KEY `personal_id` (`personal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_personal_detalle`
--

CREATE TABLE IF NOT EXISTS `inventario_personal_detalle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inventario_personal_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `producto_id` (`producto_id`),
  KEY `personal_id` (`inventario_personal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laboratorio`
--

CREATE TABLE IF NOT EXISTS `laboratorio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(75) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea_servicio`
--

CREATE TABLE IF NOT EXISTS `linea_servicio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(254) DEFAULT NULL,
  `tipo_id` int(11) NOT NULL DEFAULT '0',
  `precio` decimal(10,2) NOT NULL,
  `precio_pago` decimal(10,2) NOT NULL,
  `insumo` decimal(10,2) NOT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'Activo',
  `porcentaje` int(254) NOT NULL,
  `restringido` varchar(2) NOT NULL DEFAULT 'SI',
  `equipo_id` int(11) DEFAULT NULL,
  `tipo_hoja_gastos` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tipo_id` (`tipo_id`),
  KEY `equipo_id` (`equipo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamentos_biologicos`
--

CREATE TABLE IF NOT EXISTS `medicamentos_biologicos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `medicamento` varchar(75) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota_credito`
--

CREATE TABLE IF NOT EXISTS `nota_credito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(11) NOT NULL,
  `n_documento` varchar(20) NOT NULL,
  `contrato_id` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `observaciones` text NOT NULL,
  `fecha` date NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `personal_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`,`paciente_id`,`contrato_id`),
  KEY `paciente_id` (`paciente_id`),
  KEY `contrato_id` (`contrato_id`),
  KEY `personal_id` (`personal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_pedido`
--

CREATE TABLE IF NOT EXISTS `orden_pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `personal_entrega_id` int(11) NOT NULL,
  `personal_recibe_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `observacion` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `personal_entrega_id` (`personal_entrega_id`),
  KEY `personal_recibe_id` (`personal_recibe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_pedido_detalle`
--

CREATE TABLE IF NOT EXISTS `orden_pedido_detalle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orden_pedido_id` int(11) NOT NULL,
  `tipo_orden_pedido_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `area` varchar(50) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `orden_pedido_id` (`orden_pedido_id`),
  KEY `tipo_orden_pedido_id` (`tipo_orden_pedido_id`),
  KEY `producto_id` (`producto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE IF NOT EXISTS `paciente` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(254) DEFAULT NULL,
  `apellido` varchar(254) DEFAULT NULL,
  `n_identificacion` varchar(254) NOT NULL DEFAULT '',
  `genero` tinyint(4) NOT NULL DEFAULT '0',
  `fecha_nacimiento` date NOT NULL DEFAULT '0000-00-00',
  `fecha_registro` datetime DEFAULT NULL,
  `email` varchar(254) NOT NULL DEFAULT '',
  `email2` varchar(254) NOT NULL DEFAULT '',
  `telefono1` varchar(254) NOT NULL DEFAULT '',
  `telefono2` varchar(254) NOT NULL DEFAULT '',
  `celular` varchar(254) NOT NULL DEFAULT '',
  `direccion` varchar(254) NOT NULL DEFAULT '',
  `ciudad` varchar(254) NOT NULL DEFAULT '',
  `pais` varchar(254) NOT NULL DEFAULT '',
  `referer_contact` varchar(254) NOT NULL,
  `estado_civil` varchar(20) NOT NULL,
  `ocupacion` varchar(254) NOT NULL,
  `tipo_vinculacion` varchar(254) NOT NULL,
  `Aseguradora` varchar(254) NOT NULL,
  `nombre_acompanante` varchar(254) NOT NULL,
  `acompanante_telefono` varchar(254) NOT NULL,
  `nombre_responsable` varchar(254) NOT NULL,
  `relacion_responsable` varchar(254) NOT NULL,
  `telefono_responsable` varchar(254) NOT NULL,
  `responsable` varchar(100) NOT NULL,
  `historia_id` varchar(254) NOT NULL,
  `tratamiento_interes_id` int(10) DEFAULT NULL,
  `fuente_contacto_id` int(11) NOT NULL DEFAULT '10',
  PRIMARY KEY (`id`),
  KEY `fuente_contacto_id` (`fuente_contacto_id`),
  KEY `tratamiento_interes_id` (`tratamiento_interes_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente_fotografias`
--

CREATE TABLE IF NOT EXISTS `paciente_fotografias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(11) NOT NULL,
  `cita_id` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `fecha` datetime NOT NULL,
  `personal_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `paciente_id` (`paciente_id`),
  KEY `personal_id` (`personal_id`),
  KEY `cita_id` (`cita_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente_fotografias_detalle`
--

CREATE TABLE IF NOT EXISTS `paciente_fotografias_detalle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_fotografias_id` int(11) NOT NULL,
  `archivo` varchar(75) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `paciente_fotografias_id` (`paciente_fotografias_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente_orden`
--

CREATE TABLE IF NOT EXISTS `paciente_orden` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(11) NOT NULL,
  `observaciones` text NOT NULL,
  `vendedor` int(11) NOT NULL,
  `estado` varchar(10) NOT NULL,
  `abierto_cerrado` varchar(10) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `responsable` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `vendedor` (`vendedor`),
  KEY `responsable` (`responsable`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente_orden_detalle`
--

CREATE TABLE IF NOT EXISTS `paciente_orden_detalle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_orden_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `paciente_orden_id` (`paciente_orden_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente_resultados_lab`
--

CREATE TABLE IF NOT EXISTS `paciente_resultados_lab` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(11) DEFAULT NULL,
  `cita_id` int(11) DEFAULT NULL,
  `descripcion` text NOT NULL,
  `fecha` datetime NOT NULL,
  `personal_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `paciente_id` (`paciente_id`),
  KEY `personal_id` (`personal_id`),
  KEY `cita_id` (`cita_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente_resultados_lab_detalle`
--

CREATE TABLE IF NOT EXISTS `paciente_resultados_lab_detalle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_resultados_lab_id` int(11) NOT NULL,
  `archivo` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `paciente_resultados_lab_id` (`paciente_resultados_lab_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_cxp`
--

CREATE TABLE IF NOT EXISTS `pagos_cxp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_compra_id` int(11) NOT NULL,
  `pago` decimal(10,2) NOT NULL,
  `comentario` text NOT NULL,
  `fecha` datetime NOT NULL,
  `personal_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `personal_id` (`personal_id`),
  KEY `producto_compra_id` (`producto_compra_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_cosmetologas`
--

CREATE TABLE IF NOT EXISTS `pago_cosmetologas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(11) NOT NULL,
  `n_identificacion` varchar(25) NOT NULL,
  `cita_id` int(11) NOT NULL,
  `linea_servicio_id` int(11) NOT NULL,
  `contrato_id` int(11) NOT NULL,
  `misma_persona` char(2) NOT NULL,
  `porcentaje` decimal(10,2) NOT NULL,
  `valor_comision` decimal(10,2) NOT NULL,
  `valor_tratamiento` decimal(10,2) NOT NULL,
  `estado` varchar(25) NOT NULL,
  `descarga` char(2) NOT NULL,
  `fecha` datetime NOT NULL,
  `vendedor_id` int(11) NOT NULL,
  `personal_id` int(11) NOT NULL,
  `aprobo_id` int(11) NOT NULL,
  `total_pago` decimal(10,2) NOT NULL,
  `sesion` varchar(5) NOT NULL,
  `fecha_pago` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cita_id` (`cita_id`),
  KEY `personal_id` (`personal_id`),
  KEY `personal_id_2` (`personal_id`),
  KEY `contrato_id` (`contrato_id`),
  KEY `paciente_id` (`paciente_id`),
  KEY `aprobo_id` (`aprobo_id`),
  KEY `linea_servicio_id` (`linea_servicio_id`),
  KEY `vendedor_id` (`vendedor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) NOT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'Activo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id`, `nombre`, `estado`) VALUES
(1, 'Médico', 'Activo'),
(2, 'Cosmetóloga', 'Activo'),
(3, 'Aux Enfermeria', 'Activo'),
(4, 'Nutricionista', 'Activo'),
(5, 'Administración', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE IF NOT EXISTS `personal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cc` varchar(254) NOT NULL,
  `expedicion` varchar(254) NOT NULL,
  `titulo` varchar(15) NOT NULL,
  `nombres` varchar(50) NOT NULL DEFAULT '',
  `apellidos` varchar(50) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `lugar_nacimiento` varchar(60) NOT NULL,
  `genero` varchar(10) NOT NULL,
  `direccion` varchar(254) NOT NULL,
  `barrio` varchar(120) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `telefono2` varchar(20) NOT NULL,
  `departamento` varchar(25) NOT NULL,
  `ciudad` varchar(20) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `celular2` varchar(20) NOT NULL,
  `correo` varchar(60) NOT NULL,
  `correo2` varchar(60) NOT NULL,
  `arp` varchar(2) NOT NULL,
  `cualarp` varchar(60) NOT NULL,
  `pension` varchar(2) NOT NULL,
  `cualpension` varchar(60) NOT NULL,
  `salud` varchar(2) NOT NULL,
  `cualsalud` varchar(254) NOT NULL,
  `sangre` varchar(60) NOT NULL,
  `aprueba_ordenes` varchar(2) NOT NULL,
  `office` varchar(60) NOT NULL,
  `activo` varchar(2) NOT NULL,
  `medico` varchar(2) NOT NULL,
  `seguimiento` varchar(2) NOT NULL,
  `id_perfil` int(11) DEFAULT NULL,
  `nombres_f` varchar(25) NOT NULL,
  `apellidos_f` varchar(25) NOT NULL,
  `direccion_f` text NOT NULL,
  `telefono_f` varchar(20) NOT NULL,
  `celular_f` varchar(20) NOT NULL,
  `parentesco` varchar(20) NOT NULL,
  `agenda` char(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_perfil` (`id_perfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`id`, `cc`, `expedicion`, `titulo`, `nombres`, `apellidos`, `fecha_nacimiento`, `lugar_nacimiento`, `genero`, `direccion`, `barrio`, `telefono`, `telefono2`, `departamento`, `ciudad`, `celular`, `celular2`, `correo`, `correo2`, `arp`, `cualarp`, `pension`, `cualpension`, `salud`, `cualsalud`, `sangre`, `aprueba_ordenes`, `office`, `activo`, `medico`, `seguimiento`, `id_perfil`, `nombres_f`, `apellidos_f`, `direccion_f`, `telefono_f`, `celular_f`, `parentesco`, `agenda`) VALUES
(1, '123456789', '30-04-1999', '', 'Administrador', 'del Sistema', '0000-00-00', '', 'Masculino', 'Colombia', '', '1234567', '', 'San Salvador', 'San Salvador', '1234567', '', 'ricardo@elcorreo.com', '', 'NO', '', 'NO', '', '', '', 'O+', 'SI', '', 'SI', '', 'No', 5, 'Nombre Familiar', 'Apellido Familiar', 'El Salvador', '9999999', '99999999', 'Familiar', 'SI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuesto`
--

CREATE TABLE IF NOT EXISTS `presupuesto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(11) DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha` date NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `estado` varchar(25) NOT NULL,
  `observaciones` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `paciente_id` (`paciente_id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuesto_detalle`
--

CREATE TABLE IF NOT EXISTS `presupuesto_detalle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `presupuesto_id` int(11) NOT NULL,
  `linea_servicio_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `vu` decimal(10,2) NOT NULL,
  `desc` decimal(10,2) NOT NULL,
  `vu_desc` decimal(10,2) NOT NULL,
  `vt_sin_desc` decimal(10,2) NOT NULL,
  `vt_con_desc` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `presupuesto_id` (`presupuesto_id`),
  KEY `linea_servicio_id` (`linea_servicio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_categoria`
--

CREATE TABLE IF NOT EXISTS `producto_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(75) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categoria` (`categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_compras`
--

CREATE TABLE IF NOT EXISTS `producto_compras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_proveedor_id` int(11) NOT NULL,
  `nit` varchar(30) NOT NULL,
  `factura_n` varchar(25) NOT NULL,
  `forma_pago` varchar(15) NOT NULL,
  `descuento` char(2) NOT NULL,
  `descuento_tipo` int(11) NOT NULL,
  `descuento_valor` decimal(10,2) NOT NULL,
  `descuento_total` decimal(10,2) NOT NULL,
  `iva` decimal(10,2) NOT NULL,
  `iva_total` decimal(10,2) NOT NULL,
  `aplica_retencion` char(2) NOT NULL,
  `retencion_id` int(11) DEFAULT NULL,
  `retencion_retener` decimal(10,2) NOT NULL,
  `retencion_base` decimal(10,2) NOT NULL,
  `retencion_porcentaje` decimal(10,2) NOT NULL,
  `rte_iva` char(2) NOT NULL,
  `rte_iva_valor` decimal(10,2) NOT NULL,
  `rte_ica` char(2) NOT NULL,
  `rte_ica_porcentaje` decimal(10,2) NOT NULL,
  `rte_ica_valor` decimal(10,2) NOT NULL,
  `cantidad_productos` int(11) NOT NULL,
  `total_orden` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `total_compra` decimal(10,2) NOT NULL,
  `saldo` decimal(10,2) NOT NULL,
  `centro_costo_id` int(11) NOT NULL,
  `personal_id` int(11) NOT NULL,
  `credito_dias` int(11) NOT NULL,
  `credito_fecha` date NOT NULL,
  `banco_cuenta_id` int(11) DEFAULT NULL,
  `banco_destino` varchar(35) NOT NULL,
  `cuenta_destino` varchar(30) NOT NULL,
  `fecha` datetime NOT NULL,
  `estado` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `banco_cuenta_id` (`banco_cuenta_id`),
  KEY `producto_proveedor_id` (`producto_proveedor_id`),
  KEY `centro_costo_id` (`centro_costo_id`),
  KEY `personal_id` (`personal_id`),
  KEY `retencion_id` (`retencion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_compra_detalle`
--

CREATE TABLE IF NOT EXISTS `producto_compra_detalle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_compra_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `iva` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `lote` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `producto_id` (`producto_id`),
  KEY `producto_compra_id` (`producto_compra_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_inventario`
--

CREATE TABLE IF NOT EXISTS `producto_inventario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_producto` varchar(75) NOT NULL,
  `producto_referencia` varchar(25) NOT NULL,
  `lote` varchar(30) NOT NULL,
  `costo_iva` decimal(10,2) NOT NULL,
  `precio_publico` decimal(10,2) NOT NULL,
  `iva` decimal(10,2) NOT NULL,
  `producto_presentacion_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `producto_unidad_medida_id` int(11) NOT NULL,
  `stock_minimo` int(11) NOT NULL,
  `producto_proveedor_id` int(11) NOT NULL,
  `tipo_inventario` varchar(25) NOT NULL,
  `producto_categoria_id` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `personal_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `producto_presentacion_id` (`producto_presentacion_id`),
  KEY `producto_unidad_medida_id` (`producto_unidad_medida_id`),
  KEY `producto_proveedor_id` (`producto_proveedor_id`),
  KEY `producto_categoria_id` (`producto_categoria_id`),
  KEY `personal_id` (`personal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_presentacion`
--

CREATE TABLE IF NOT EXISTS `producto_presentacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `presentacion` varchar(75) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `presentacion` (`presentacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_proveedor`
--

CREATE TABLE IF NOT EXISTS `producto_proveedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_nit` varchar(30) NOT NULL,
  `nombre` varchar(75) NOT NULL,
  `direccion` text NOT NULL,
  `ciudad` varchar(25) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `nombre_contacto` varchar(60) NOT NULL,
  `email_contacto` varchar(60) NOT NULL,
  `telefono_contacto` varchar(15) NOT NULL,
  `celular_contacto` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_retenciones`
--

CREATE TABLE IF NOT EXISTS `producto_retenciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `retencion` varchar(75) NOT NULL,
  `a_retener` decimal(10,2) NOT NULL,
  `base` decimal(10,2) NOT NULL,
  `porcentaje` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `retencion` (`retencion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_unidad_medida`
--

CREATE TABLE IF NOT EXISTS `producto_unidad_medida` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `medida` varchar(75) NOT NULL,
  `corto` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `medida` (`medida`),
  UNIQUE KEY `corto` (`corto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relacion_hoja_gastos`
--

CREATE TABLE IF NOT EXISTS `relacion_hoja_gastos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(11) NOT NULL,
  `n_identificacion` varchar(30) NOT NULL,
  `hoja` varchar(30) NOT NULL,
  `asistencial_id` int(11) NOT NULL,
  `cita_id` int(11) NOT NULL,
  `linea_servicio_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `costo` decimal(10,2) NOT NULL,
  `personal_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `paciente_id` (`paciente_id`,`asistencial_id`),
  KEY `asistencial_id` (`asistencial_id`),
  KEY `cita_id` (`cita_id`),
  KEY `linea_servicio_id` (`linea_servicio_id`),
  KEY `personal_id` (`personal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimiento_comercial`
--

CREATE TABLE IF NOT EXISTS `seguimiento_comercial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_registro` date NOT NULL,
  `tipo` varchar(25) NOT NULL,
  `cita_id` int(11) DEFAULT NULL,
  `n_identificacion` varchar(25) NOT NULL,
  `paciente_id` int(11) DEFAULT NULL,
  `fecha_accion` date NOT NULL,
  `fecha_atencion` date NOT NULL,
  `tema_id` int(11) NOT NULL,
  `id_personal` int(11) DEFAULT NULL,
  `observaciones` text NOT NULL,
  `estado` varchar(25) NOT NULL,
  `comentario_estado` text NOT NULL,
  `paciente_documento` varchar(25) NOT NULL,
  `ultimo_seguimiento` text NOT NULL,
  `responsable_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_personal` (`id_personal`),
  KEY `cita_id` (`cita_id`),
  KEY `paciente_id` (`paciente_id`),
  KEY `tema_id` (`tema_id`),
  KEY `cita_id_2` (`cita_id`),
  KEY `paciente_id_2` (`paciente_id`),
  KEY `tema_id_2` (`tema_id`),
  KEY `id_personal_2` (`id_personal`),
  KEY `responsable_id` (`responsable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimiento_comercial_detalle`
--

CREATE TABLE IF NOT EXISTS `seguimiento_comercial_detalle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seguimiento_comercial_id` int(11) NOT NULL,
  `fecha_seguimiento` datetime NOT NULL,
  `seguimiento` text NOT NULL,
  `responsable_id` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `id_personal` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `responsable_id` (`responsable_id`),
  KEY `seguimiento_comercial_id` (`seguimiento_comercial_id`),
  KEY `id_personal` (`id_personal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimiento_tema`
--

CREATE TABLE IF NOT EXISTS `seguimiento_tema` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(120) NOT NULL,
  `estado` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `seguimiento_tema`
--

INSERT INTO `seguimiento_tema` (`id`, `nombre`, `estado`) VALUES
(1, 'Promoción', 'Activo'),
(2, 'Valoracion', 'Activo'),
(3, 'Llamada de Primera Vez', 'Activo'),
(4, 'Citas Fallidas', 'Activo'),
(5, 'Cita Cancelada', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temp_examenes`
--

CREATE TABLE IF NOT EXISTS `temp_examenes` (
  `archivo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temp_imagenes`
--

CREATE TABLE IF NOT EXISTS `temp_imagenes` (
  `archivo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `testimonios`
--

CREATE TABLE IF NOT EXISTS `testimonios` (
  `id` int(11) NOT NULL,
  `paciente_id` int(11) NOT NULL,
  `testimonio` text NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `paciente_id` (`paciente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_linea_servicio`
--

CREATE TABLE IF NOT EXISTS `tipo_linea_servicio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL DEFAULT 'Activo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_orden_pedido`
--

CREATE TABLE IF NOT EXISTS `tipo_orden_pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(40) NOT NULL,
  `tipo_corto` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tipo_orden_pedido`
--

INSERT INTO `tipo_orden_pedido` (`id`, `tipo`, `tipo_corto`) VALUES
(1, 'Papelería o Elemento de Oficina', 'P/O'),
(2, 'Aseo o Cafetería', 'A/C'),
(3, 'Producto', 'PRO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamiento_interes`
--

CREATE TABLE IF NOT EXISTS `tratamiento_interes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(254) NOT NULL DEFAULT '',
  `estado` varchar(10) NOT NULL,
  `mostrar` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `personal_id` int(11) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `clave` varchar(20) NOT NULL,
  `estado` varchar(20) NOT NULL,
  PRIMARY KEY (`personal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`personal_id`, `usuario`, `clave`, `estado`) VALUES
(1, 'admin', '123', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE IF NOT EXISTS `ventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(11) NOT NULL,
  `n_identificacion` varchar(25) NOT NULL,
  `descripcion` text NOT NULL,
  `sub_total` decimal(10,2) NOT NULL,
  `total_iva` decimal(10,2) NOT NULL,
  `descuento` char(2) NOT NULL,
  `descuento_tipo` char(1) NOT NULL,
  `descuento_valor` decimal(10,2) NOT NULL,
  `descuento_total` decimal(10,2) NOT NULL,
  `cant_productos` int(11) NOT NULL,
  `total_orden` decimal(10,2) NOT NULL,
  `forma_pago` varchar(25) NOT NULL,
  `dinero_recibido` decimal(10,0) NOT NULL,
  `dinero_cambio` decimal(10,2) NOT NULL,
  `total_venta` decimal(10,2) NOT NULL,
  `credito_dias` int(11) NOT NULL,
  `credito_fecha` date NOT NULL,
  `cheques_cantidad` int(11) NOT NULL,
  `cheques_total` decimal(10,2) NOT NULL,
  `cheques_cuenta_banco` int(11) DEFAULT NULL,
  `tarjeta_tipo` varchar(25) NOT NULL,
  `tarjeta_aprobacion` varchar(25) NOT NULL,
  `tarjeta_entidad` varchar(25) NOT NULL,
  `tarjeta_cuenta_banco` int(11) DEFAULT NULL,
  `consignacion_cuenta_banco` int(11) DEFAULT NULL,
  `consignacion_banco` varchar(25) NOT NULL,
  `consignacion_cuenta` varchar(25) NOT NULL,
  `personal` int(11) NOT NULL,
  `vendedor_id` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `fecha` date NOT NULL,
  `estado` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `paciente_id` (`paciente_id`,`cheques_cuenta_banco`,`tarjeta_cuenta_banco`,`consignacion_cuenta_banco`,`personal`),
  KEY `cheques_cuenta_banco` (`cheques_cuenta_banco`),
  KEY `tarjeta_cuenta_banco` (`tarjeta_cuenta_banco`),
  KEY `personal` (`personal`),
  KEY `consignacion_cuenta_banco` (`consignacion_cuenta_banco`),
  KEY `vendedor_id` (`vendedor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_cheques`
--

CREATE TABLE IF NOT EXISTS `ventas_cheques` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ventas_id` int(11) NOT NULL,
  `numero` varchar(25) NOT NULL,
  `entidad` varchar(25) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `f_cobro` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ventas_id` (`ventas_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_detalle`
--

CREATE TABLE IF NOT EXISTS `ventas_detalle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `venta_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `iva` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `paciente_id` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `venta_id` (`venta_id`),
  KEY `producto_id` (`producto_id`),
  KEY `paciente_id` (`paciente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `activo_inventario`
--
ALTER TABLE `activo_inventario`
  ADD CONSTRAINT `activo_inventario_ibfk_1` FOREIGN KEY (`activo_tipo_id`) REFERENCES `activos_tipo` (`id`);

--
-- Filtros para la tabla `activo_observaciones`
--
ALTER TABLE `activo_observaciones`
  ADD CONSTRAINT `activo_observaciones_ibfk_1` FOREIGN KEY (`activo_inventario_id`) REFERENCES `activo_inventario` (`id`),
  ADD CONSTRAINT `activo_observaciones_ibfk_2` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id`);

--
-- Filtros para la tabla `bancos_cuentas`
--
ALTER TABLE `bancos_cuentas`
  ADD CONSTRAINT `bancos_cuentas_ibfk_1` FOREIGN KEY (`id_banco`) REFERENCES `bancos` (`id`);

--
-- Filtros para la tabla `caja_efectivo`
--
ALTER TABLE `caja_efectivo`
  ADD CONSTRAINT `caja_efectivo_ibfk_1` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id`);

--
-- Filtros para la tabla `caja_efectivo_detalle`
--
ALTER TABLE `caja_efectivo_detalle`
  ADD CONSTRAINT `caja_efectivo_detalle_ibfk_2` FOREIGN KEY (`ingreso_id`) REFERENCES `ingresos` (`id`),
  ADD CONSTRAINT `caja_efectivo_detalle_ibfk_3` FOREIGN KEY (`egreso_id`) REFERENCES `egresos` (`id`),
  ADD CONSTRAINT `caja_efectivo_detalle_ibfk_4` FOREIGN KEY (`caja_efectivo_id`) REFERENCES `caja_efectivo` (`personal_id`);

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`),
  ADD CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id`),
  ADD CONSTRAINT `citas_ibfk_3` FOREIGN KEY (`paciente_orden_id`) REFERENCES `paciente_orden` (`id`),
  ADD CONSTRAINT `citas_ibfk_4` FOREIGN KEY (`linea_servicio_id`) REFERENCES `linea_servicio` (`id`),
  ADD CONSTRAINT `citas_ibfk_5` FOREIGN KEY (`hora_inicio`) REFERENCES `horas_servicio` (`id`),
  ADD CONSTRAINT `citas_ibfk_6` FOREIGN KEY (`hora_fin`) REFERENCES `horas_servicio` (`id`),
  ADD CONSTRAINT `citas_ibfk_7` FOREIGN KEY (`confirmacion_personal_id`) REFERENCES `personal` (`id`);

--
-- Filtros para la tabla `contratos`
--
ALTER TABLE `contratos`
  ADD CONSTRAINT `contratos_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`),
  ADD CONSTRAINT `contratos_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `personal` (`id`),
  ADD CONSTRAINT `contratos_ibfk_3` FOREIGN KEY (`presupuesto_id`) REFERENCES `presupuesto` (`id`);

--
-- Filtros para la tabla `contratos_tratamiento_realizados`
--
ALTER TABLE `contratos_tratamiento_realizados`
  ADD CONSTRAINT `contratos_tratamiento_realizados_ibfk_1` FOREIGN KEY (`contrato_id`) REFERENCES `contratos` (`id`),
  ADD CONSTRAINT `contratos_tratamiento_realizados_ibfk_2` FOREIGN KEY (`cita_id`) REFERENCES `citas` (`id`),
  ADD CONSTRAINT `contratos_tratamiento_realizados_ibfk_3` FOREIGN KEY (`linea_servicio_id`) REFERENCES `linea_servicio` (`id`);

--
-- Filtros para la tabla `egresos`
--
ALTER TABLE `egresos`
  ADD CONSTRAINT `egresos_ibfk_1` FOREIGN KEY (`proveedor_id`) REFERENCES `producto_proveedor` (`id`),
  ADD CONSTRAINT `egresos_ibfk_2` FOREIGN KEY (`factura_id`) REFERENCES `producto_compras` (`id`),
  ADD CONSTRAINT `egresos_ibfk_3` FOREIGN KEY (`retencion_id`) REFERENCES `producto_retenciones` (`id`),
  ADD CONSTRAINT `egresos_ibfk_4` FOREIGN KEY (`centro_costo_id`) REFERENCES `centro_costo` (`id`),
  ADD CONSTRAINT `egresos_ibfk_5` FOREIGN KEY (`banco_cuenta_id`) REFERENCES `bancos_cuentas` (`id`),
  ADD CONSTRAINT `egresos_ibfk_6` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id`);

--
-- Filtros para la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD CONSTRAINT `equipos_ibfk_1` FOREIGN KEY (`linea_servicio_id`) REFERENCES `linea_servicio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `equipos_observaciones`
--
ALTER TABLE `equipos_observaciones`
  ADD CONSTRAINT `equipos_observaciones_ibfk_1` FOREIGN KEY (`equipo_id`) REFERENCES `equipos` (`id`),
  ADD CONSTRAINT `equipos_observaciones_ibfk_2` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id`);

--
-- Filtros para la tabla `historial_descripcion_quirurgica`
--
ALTER TABLE `historial_descripcion_quirurgica`
  ADD CONSTRAINT `historial_descripcion_quirurgica_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`),
  ADD CONSTRAINT `historial_descripcion_quirurgica_ibfk_2` FOREIGN KEY (`cirujano_id`) REFERENCES `personal` (`id`),
  ADD CONSTRAINT `historial_descripcion_quirurgica_ibfk_3` FOREIGN KEY (`ayudante_id`) REFERENCES `personal` (`id`),
  ADD CONSTRAINT `historial_descripcion_quirurgica_ibfk_4` FOREIGN KEY (`anestesiologo_id`) REFERENCES `personal` (`id`),
  ADD CONSTRAINT `historial_descripcion_quirurgica_ibfk_5` FOREIGN KEY (`inst_quirurgico_id`) REFERENCES `personal` (`id`),
  ADD CONSTRAINT `historial_descripcion_quirurgica_ibfk_6` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id`),
  ADD CONSTRAINT `historial_descripcion_quirurgica_ibfk_7` FOREIGN KEY (`cita_id`) REFERENCES `citas` (`id`);

--
-- Filtros para la tabla `historial_diagnostico`
--
ALTER TABLE `historial_diagnostico`
  ADD CONSTRAINT `historial_diagnostico_ibfk_2` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`),
  ADD CONSTRAINT `historial_diagnostico_ibfk_3` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id`);

--
-- Filtros para la tabla `historial_evaluacion_enfermeria`
--
ALTER TABLE `historial_evaluacion_enfermeria`
  ADD CONSTRAINT `historial_evaluacion_enfermeria_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`),
  ADD CONSTRAINT `historial_evaluacion_enfermeria_ibfk_2` FOREIGN KEY (`cita_id`) REFERENCES `citas` (`id`),
  ADD CONSTRAINT `historial_evaluacion_enfermeria_ibfk_3` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id`);

--
-- Filtros para la tabla `historial_laboratorio`
--
ALTER TABLE `historial_laboratorio`
  ADD CONSTRAINT `historial_laboratorio_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`);

--
-- Filtros para la tabla `historial_notas_enfermeria`
--
ALTER TABLE `historial_notas_enfermeria`
  ADD CONSTRAINT `historial_notas_enfermeria_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`),
  ADD CONSTRAINT `historial_notas_enfermeria_ibfk_2` FOREIGN KEY (`cita_id`) REFERENCES `citas` (`id`),
  ADD CONSTRAINT `historial_notas_enfermeria_ibfk_3` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id`);

--
-- Filtros para la tabla `historial_notas_enfermeria_detalles`
--
ALTER TABLE `historial_notas_enfermeria_detalles`
  ADD CONSTRAINT `historial_notas_enfermeria_detalles_ibfk_1` FOREIGN KEY (`historial_notas_enfermeria_id`) REFERENCES `historial_notas_enfermeria` (`id`);

--
-- Filtros para la tabla `hoja_gastos`
--
ALTER TABLE `hoja_gastos`
  ADD CONSTRAINT `hoja_gastos_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`),
  ADD CONSTRAINT `hoja_gastos_ibfk_2` FOREIGN KEY (`cita_id`) REFERENCES `citas` (`id`),
  ADD CONSTRAINT `hoja_gastos_ibfk_3` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id`);

--
-- Filtros para la tabla `hoja_gastos_cirugia`
--
ALTER TABLE `hoja_gastos_cirugia`
  ADD CONSTRAINT `hoja_gastos_cirugia_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`),
  ADD CONSTRAINT `hoja_gastos_cirugia_ibfk_2` FOREIGN KEY (`cirujano_id`) REFERENCES `personal` (`id`),
  ADD CONSTRAINT `hoja_gastos_cirugia_ibfk_3` FOREIGN KEY (`cita_id`) REFERENCES `citas` (`id`),
  ADD CONSTRAINT `hoja_gastos_cirugia_ibfk_4` FOREIGN KEY (`ayudante_id`) REFERENCES `personal` (`id`),
  ADD CONSTRAINT `hoja_gastos_cirugia_ibfk_5` FOREIGN KEY (`anestesiologo_id`) REFERENCES `personal` (`id`),
  ADD CONSTRAINT `hoja_gastos_cirugia_ibfk_6` FOREIGN KEY (`rotadora_id`) REFERENCES `personal` (`id`),
  ADD CONSTRAINT `hoja_gastos_cirugia_ibfk_7` FOREIGN KEY (`instrumentadora_id`) REFERENCES `personal` (`id`),
  ADD CONSTRAINT `hoja_gastos_cirugia_ibfk_8` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id`);

--
-- Filtros para la tabla `hoja_gastos_cirugia_detalle`
--
ALTER TABLE `hoja_gastos_cirugia_detalle`
  ADD CONSTRAINT `hoja_gastos_cirugia_detalle_ibfk_1` FOREIGN KEY (`hoja_gastos_cirugia_id`) REFERENCES `hoja_gastos_cirugia` (`id`),
  ADD CONSTRAINT `hoja_gastos_cirugia_detalle_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `producto_inventario` (`id`);

--
-- Filtros para la tabla `hoja_gastos_detalle`
--
ALTER TABLE `hoja_gastos_detalle`
  ADD CONSTRAINT `hoja_gastos_detalle_ibfk_1` FOREIGN KEY (`hoja_gastos_id`) REFERENCES `hoja_gastos` (`id`),
  ADD CONSTRAINT `hoja_gastos_detalle_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `producto_inventario` (`id`);

--
-- Filtros para la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD CONSTRAINT `ingresos_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`),
  ADD CONSTRAINT `ingresos_ibfk_2` FOREIGN KEY (`contrato_id`) REFERENCES `contratos` (`id`),
  ADD CONSTRAINT `ingresos_ibfk_3` FOREIGN KEY (`centro_costo_id`) REFERENCES `centro_costo` (`id`),
  ADD CONSTRAINT `ingresos_ibfk_4` FOREIGN KEY (`cheques_banco_cuenta_id`) REFERENCES `bancos_cuentas` (`id`),
  ADD CONSTRAINT `ingresos_ibfk_5` FOREIGN KEY (`tarjeta_banco_cuenta_id`) REFERENCES `bancos_cuentas` (`id`),
  ADD CONSTRAINT `ingresos_ibfk_6` FOREIGN KEY (`consigna_banco_d_cuenta_id`) REFERENCES `bancos` (`id`),
  ADD CONSTRAINT `ingresos_ibfk_7` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id`);

--
-- Filtros para la tabla `ingresos_cheques`
--
ALTER TABLE `ingresos_cheques`
  ADD CONSTRAINT `ingresos_cheques_ibfk_1` FOREIGN KEY (`ingresos_id`) REFERENCES `ingresos` (`id`);

--
-- Filtros para la tabla `inventario_personal`
--
ALTER TABLE `inventario_personal`
  ADD CONSTRAINT `inventario_personal_ibfk_1` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id`);

--
-- Filtros para la tabla `inventario_personal_detalle`
--
ALTER TABLE `inventario_personal_detalle`
  ADD CONSTRAINT `inventario_personal_detalle_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `producto_inventario` (`id`),
  ADD CONSTRAINT `inventario_personal_detalle_ibfk_2` FOREIGN KEY (`inventario_personal_id`) REFERENCES `inventario_personal` (`personal_id`);

--
-- Filtros para la tabla `linea_servicio`
--
ALTER TABLE `linea_servicio`
  ADD CONSTRAINT `linea_servicio_ibfk_1` FOREIGN KEY (`equipo_id`) REFERENCES `equipos` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `nota_credito`
--
ALTER TABLE `nota_credito`
  ADD CONSTRAINT `nota_credito_ibfk_3` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id`),
  ADD CONSTRAINT `nota_credito_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`),
  ADD CONSTRAINT `nota_credito_ibfk_2` FOREIGN KEY (`contrato_id`) REFERENCES `contratos` (`id`);

--
-- Filtros para la tabla `orden_pedido`
--
ALTER TABLE `orden_pedido`
  ADD CONSTRAINT `orden_pedido_ibfk_1` FOREIGN KEY (`personal_entrega_id`) REFERENCES `personal` (`id`),
  ADD CONSTRAINT `orden_pedido_ibfk_2` FOREIGN KEY (`personal_recibe_id`) REFERENCES `personal` (`id`);

--
-- Filtros para la tabla `orden_pedido_detalle`
--
ALTER TABLE `orden_pedido_detalle`
  ADD CONSTRAINT `orden_pedido_detalle_ibfk_1` FOREIGN KEY (`orden_pedido_id`) REFERENCES `orden_pedido` (`id`),
  ADD CONSTRAINT `orden_pedido_detalle_ibfk_2` FOREIGN KEY (`tipo_orden_pedido_id`) REFERENCES `tipo_orden_pedido` (`id`),
  ADD CONSTRAINT `orden_pedido_detalle_ibfk_3` FOREIGN KEY (`producto_id`) REFERENCES `producto_inventario` (`id`);

--
-- Filtros para la tabla `paciente_fotografias`
--
ALTER TABLE `paciente_fotografias`
  ADD CONSTRAINT `paciente_fotografias_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`),
  ADD CONSTRAINT `paciente_fotografias_ibfk_2` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id`),
  ADD CONSTRAINT `paciente_fotografias_ibfk_3` FOREIGN KEY (`cita_id`) REFERENCES `citas` (`id`);

--
-- Filtros para la tabla `paciente_fotografias_detalle`
--
ALTER TABLE `paciente_fotografias_detalle`
  ADD CONSTRAINT `paciente_fotografias_detalle_ibfk_1` FOREIGN KEY (`paciente_fotografias_id`) REFERENCES `paciente_fotografias` (`id`);

--
-- Filtros para la tabla `paciente_resultados_lab`
--
ALTER TABLE `paciente_resultados_lab`
  ADD CONSTRAINT `paciente_resultados_lab_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`),
  ADD CONSTRAINT `paciente_resultados_lab_ibfk_2` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id`),
  ADD CONSTRAINT `paciente_resultados_lab_ibfk_3` FOREIGN KEY (`cita_id`) REFERENCES `citas` (`id`);

--
-- Filtros para la tabla `paciente_resultados_lab_detalle`
--
ALTER TABLE `paciente_resultados_lab_detalle`
  ADD CONSTRAINT `paciente_resultados_lab_detalle_ibfk_1` FOREIGN KEY (`paciente_resultados_lab_id`) REFERENCES `paciente_resultados_lab` (`id`);

--
-- Filtros para la tabla `pagos_cxp`
--
ALTER TABLE `pagos_cxp`
  ADD CONSTRAINT `pagos_cxp_ibfk_1` FOREIGN KEY (`producto_compra_id`) REFERENCES `producto_compras` (`id`),
  ADD CONSTRAINT `pagos_cxp_ibfk_2` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id`);

--
-- Filtros para la tabla `pago_cosmetologas`
--
ALTER TABLE `pago_cosmetologas`
  ADD CONSTRAINT `pago_cosmetologas_ibfk_1` FOREIGN KEY (`cita_id`) REFERENCES `citas` (`id`),
  ADD CONSTRAINT `pago_cosmetologas_ibfk_2` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id`),
  ADD CONSTRAINT `pago_cosmetologas_ibfk_3` FOREIGN KEY (`contrato_id`) REFERENCES `contratos` (`id`),
  ADD CONSTRAINT `pago_cosmetologas_ibfk_4` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`),
  ADD CONSTRAINT `pago_cosmetologas_ibfk_5` FOREIGN KEY (`aprobo_id`) REFERENCES `personal` (`id`),
  ADD CONSTRAINT `pago_cosmetologas_ibfk_6` FOREIGN KEY (`linea_servicio_id`) REFERENCES `linea_servicio` (`id`),
  ADD CONSTRAINT `pago_cosmetologas_ibfk_7` FOREIGN KEY (`vendedor_id`) REFERENCES `personal` (`id`);

--
-- Filtros para la tabla `presupuesto`
--
ALTER TABLE `presupuesto`
  ADD CONSTRAINT `presupuesto_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`),
  ADD CONSTRAINT `presupuesto_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `personal` (`id`);

--
-- Filtros para la tabla `presupuesto_detalle`
--
ALTER TABLE `presupuesto_detalle`
  ADD CONSTRAINT `presupuesto_detalle_ibfk_1` FOREIGN KEY (`presupuesto_id`) REFERENCES `presupuesto` (`id`),
  ADD CONSTRAINT `presupuesto_detalle_ibfk_2` FOREIGN KEY (`linea_servicio_id`) REFERENCES `linea_servicio` (`id`);

--
-- Filtros para la tabla `producto_compras`
--
ALTER TABLE `producto_compras`
  ADD CONSTRAINT `producto_compras_ibfk_1` FOREIGN KEY (`retencion_id`) REFERENCES `producto_retenciones` (`id`),
  ADD CONSTRAINT `producto_compras_ibfk_2` FOREIGN KEY (`centro_costo_id`) REFERENCES `centro_costo` (`id`),
  ADD CONSTRAINT `producto_compras_ibfk_3` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id`),
  ADD CONSTRAINT `producto_compras_ibfk_4` FOREIGN KEY (`producto_proveedor_id`) REFERENCES `producto_proveedor` (`id`),
  ADD CONSTRAINT `producto_compras_ibfk_5` FOREIGN KEY (`banco_cuenta_id`) REFERENCES `bancos_cuentas` (`id`);

--
-- Filtros para la tabla `producto_compra_detalle`
--
ALTER TABLE `producto_compra_detalle`
  ADD CONSTRAINT `producto_compra_detalle_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `producto_inventario` (`id`),
  ADD CONSTRAINT `producto_compra_detalle_ibfk_2` FOREIGN KEY (`producto_compra_id`) REFERENCES `producto_compras` (`id`);

--
-- Filtros para la tabla `relacion_hoja_gastos`
--
ALTER TABLE `relacion_hoja_gastos`
  ADD CONSTRAINT `relacion_hoja_gastos_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`),
  ADD CONSTRAINT `relacion_hoja_gastos_ibfk_2` FOREIGN KEY (`asistencial_id`) REFERENCES `personal` (`id`),
  ADD CONSTRAINT `relacion_hoja_gastos_ibfk_3` FOREIGN KEY (`cita_id`) REFERENCES `citas` (`id`),
  ADD CONSTRAINT `relacion_hoja_gastos_ibfk_4` FOREIGN KEY (`linea_servicio_id`) REFERENCES `linea_servicio` (`id`),
  ADD CONSTRAINT `relacion_hoja_gastos_ibfk_5` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id`);

--
-- Filtros para la tabla `seguimiento_comercial`
--
ALTER TABLE `seguimiento_comercial`
  ADD CONSTRAINT `seguimiento_comercial_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`),
  ADD CONSTRAINT `seguimiento_comercial_ibfk_3` FOREIGN KEY (`id_personal`) REFERENCES `personal` (`id`),
  ADD CONSTRAINT `seguimiento_comercial_ibfk_4` FOREIGN KEY (`cita_id`) REFERENCES `citas` (`id`),
  ADD CONSTRAINT `seguimiento_comercial_ibfk_5` FOREIGN KEY (`tema_id`) REFERENCES `seguimiento_tema` (`id`),
  ADD CONSTRAINT `seguimiento_comercial_ibfk_6` FOREIGN KEY (`responsable_id`) REFERENCES `personal` (`id`);

--
-- Filtros para la tabla `seguimiento_comercial_detalle`
--
ALTER TABLE `seguimiento_comercial_detalle`
  ADD CONSTRAINT `seguimiento_comercial_detalle_ibfk_1` FOREIGN KEY (`id_personal`) REFERENCES `personal` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`),
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`cheques_cuenta_banco`) REFERENCES `bancos_cuentas` (`id`),
  ADD CONSTRAINT `ventas_ibfk_3` FOREIGN KEY (`tarjeta_cuenta_banco`) REFERENCES `bancos_cuentas` (`id`),
  ADD CONSTRAINT `ventas_ibfk_4` FOREIGN KEY (`personal`) REFERENCES `personal` (`id`),
  ADD CONSTRAINT `ventas_ibfk_5` FOREIGN KEY (`consignacion_cuenta_banco`) REFERENCES `bancos_cuentas` (`id`),
  ADD CONSTRAINT `ventas_ibfk_6` FOREIGN KEY (`vendedor_id`) REFERENCES `personal` (`id`);

--
-- Filtros para la tabla `ventas_cheques`
--
ALTER TABLE `ventas_cheques`
  ADD CONSTRAINT `ventas_cheques_ibfk_1` FOREIGN KEY (`ventas_id`) REFERENCES `ventas` (`id`);

--
-- Filtros para la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  ADD CONSTRAINT `ventas_detalle_ibfk_1` FOREIGN KEY (`venta_id`) REFERENCES `ventas` (`id`),
  ADD CONSTRAINT `ventas_detalle_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `producto_inventario` (`id`),
  ADD CONSTRAINT `ventas_detalle_ibfk_3` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
