-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 11-10-2019 a las 17:54:39
-- Versión del servidor: 5.6.41-84.1
-- Versión de PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `luisga15_compulg`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bdter`
--

CREATE TABLE `bdter` (
  `IdTer` int(50) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `fp` varchar(50) DEFAULT NULL,
  `tels` varchar(200) DEFAULT NULL,
  `mail` varchar(200) DEFAULT NULL,
  `nitemp` int(50) DEFAULT NULL,
  `emp` varchar(200) DEFAULT NULL,
  `diremp` varchar(200) DEFAULT NULL,
  `city` varchar(12) DEFAULT NULL,
  `telemp` varchar(200) DEFAULT NULL,
  `dir` varchar(69) DEFAULT NULL,
  `obs` text,
  `origen` varchar(11) DEFAULT NULL,
  `error` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `bdter`
--

INSERT INTO `bdter` (`IdTer`, `name`, `fp`, `tels`, `mail`, `nitemp`, `emp`, `diremp`, `city`, `telemp`, `dir`, `obs`, `origen`, `error`) VALUES
(94460466, 'LUIS GABRIEL HERNANDEZ VALDERRAMA', 'Efectivo', '3154383999', 'luisga158@gmail.com', NULL, NULL, NULL, NULL, NULL, 'CR 25 18A 46', NULL, 'BDN', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
