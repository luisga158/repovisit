-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 11-10-2019 a las 17:54:21
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
-- Estructura de tabla para la tabla `dirterglobal`
--

CREATE TABLE `dirterglobal` (
  `Nit` int(10) DEFAULT NULL,
  `DV` int(1) DEFAULT NULL,
  `1erAp` varchar(50) DEFAULT NULL,
  `2oAp` varchar(50) DEFAULT NULL,
  `1erNom` varchar(50) DEFAULT NULL,
  `2oNom` varchar(50) DEFAULT NULL,
  `RznScl` varchar(200) DEFAULT NULL,
  `Dir` varchar(60) DEFAULT NULL,
  `CodMun` varchar(2) DEFAULT NULL,
  `CodCiudad` varchar(3) DEFAULT NULL,
  `CodPais` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `dirterglobal`
--

INSERT INTO `dirterglobal` (`Nit`, `DV`, `1erAp`, `2oAp`, `1erNom`, `2oNom`, `RznScl`, `Dir`, `CodMun`, `CodCiudad`, `CodPais`) VALUES
(94460466, 3, 'HERNANDEZ', NULL, 'LUIS', 'GABRIEL', NULL, 'CR 25 18A 46', '76', '001', 169);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
