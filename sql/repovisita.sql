-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 11-10-2019 a las 17:54:04
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
-- Estructura de tabla para la tabla `repovisita`
--

CREATE TABLE `repovisita` (
  `Marca_temporal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Seleccione_el_cliente` varchar(500) NOT NULL,
  `Concepto_Cuenta_de_cobro` text NOT NULL,
  `Valor` int(11) NOT NULL,
  `Observaciones` text,
  `Pago` enum('Si','No') DEFAULT NULL,
  `Ord` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `repovisita`
--

INSERT INTO `repovisita` (`Marca_temporal`, `Seleccione_el_cliente`, `Concepto_Cuenta_de_cobro`, `Valor`, `Observaciones`, `Pago`, `Ord`) VALUES
('0000-00-00 00:00:00', 'Luis Gabriel, Hernández Valderrama', 'Probando el reporte de visita y cuenta de cobro este es el concepto de la cuenta de cobro.', 1500000, 'Probando el reporte de visita y cuenta de cobro este es el concepto de la cuenta de cobro.', 'Si', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `repovisita`
--
ALTER TABLE `repovisita`
  ADD PRIMARY KEY (`Ord`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `repovisita`
--
ALTER TABLE `repovisita`
  MODIFY `Ord` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
