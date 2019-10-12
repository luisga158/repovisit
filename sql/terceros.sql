-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 11-10-2019 a las 17:53:50
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
-- Estructura de tabla para la tabla `terceros`
--

CREATE TABLE `terceros` (
  `Marca_temporal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Tipo_de_persona` varchar(50) NOT NULL COMMENT 'Tipo de persona',
  `Tipo_de_documento_de_identidad` varchar(129) NOT NULL COMMENT 'Tipo de Identificación',
  `Numero_de_identidad` int(50) NOT NULL COMMENT 'Número de documento de identidad',
  `Nombre_o_Razon_Social` varchar(200) NOT NULL COMMENT 'Nombre o Razón Social',
  `Correo_electronico` varchar(200) NOT NULL COMMENT 'Correo electrónico',
  `Direccion` varchar(200) NOT NULL COMMENT 'Dirección',
  `Ciudad` varchar(28) NOT NULL COMMENT 'Ciudad',
  `Es_Cliente` tinyint(1) DEFAULT NULL COMMENT 'Es Cliente',
  `Es_Proveedor` tinyint(1) DEFAULT NULL COMMENT 'Es Proveedor',
  `Es_Acreedor` tinyint(1) DEFAULT NULL COMMENT 'Es Acreedor',
  `Primer_Nombre` varchar(50) DEFAULT NULL COMMENT 'Primer Nombre',
  `Otros_Nombres` varchar(100) DEFAULT NULL COMMENT 'Otros Nombres',
  `Primer_Apellido` varchar(50) DEFAULT NULL COMMENT 'Primer Apellido',
  `Otros_Apellidos` varchar(200) DEFAULT NULL COMMENT 'Otros Apellidos',
  `ICA_Cali` tinyint(1) DEFAULT NULL COMMENT 'ICA Cali',
  `Forma_de_pago` varchar(50) DEFAULT NULL COMMENT 'Forma de pago',
  `Nombre_Representante_Legal` varchar(300) DEFAULT NULL COMMENT 'Nombre Representante Legal',
  `Tipo_de_Identificación_Representante_Legal` varchar(20) DEFAULT NULL COMMENT 'Tipo de Identificación Representante Legal',
  `No_Identificacion_Representante_Legal` int(50) DEFAULT NULL COMMENT 'No Identificación Representante Legal',
  `Campo_Libre_1` text COMMENT 'Campo Libre 1',
  `Campo_Libre_2` text COMMENT 'Campo Libre 2',
  `Campo_Libre_3` text COMMENT 'Campo Libre 3',
  `Campo_Libre_4` text COMMENT 'Campo Libre 4',
  `Campo_Libre_5` text COMMENT 'Campo Libre 5'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `terceros`
--

INSERT INTO `terceros` (`Marca_temporal`, `Tipo_de_persona`, `Tipo_de_documento_de_identidad`, `Numero_de_identidad`, `Nombre_o_Razon_Social`, `Correo_electronico`, `Direccion`, `Ciudad`, `Es_Cliente`, `Es_Proveedor`, `Es_Acreedor`, `Primer_Nombre`, `Otros_Nombres`, `Primer_Apellido`, `Otros_Apellidos`, `ICA_Cali`, `Forma_de_pago`, `Nombre_Representante_Legal`, `Tipo_de_Identificación_Representante_Legal`, `No_Identificacion_Representante_Legal`, `Campo_Libre_1`, `Campo_Libre_2`, `Campo_Libre_3`, `Campo_Libre_4`, `Campo_Libre_5`) VALUES
('0000-00-00 00:00:00', 'Natural', 'Cédula de ciudadanía', 94460466, 'Luis Gabriel Hernández Valderrama', 'luisga158@gmail.com', 'Cra 25 18A 46', 'CALI - VALLE DEL CAUCA', 0, 0, 0, '', NULL, NULL, NULL, 0, 'Contado', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `terceros`
--
ALTER TABLE `terceros`
  ADD UNIQUE KEY `IdTer` (`Numero_de_identidad`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
