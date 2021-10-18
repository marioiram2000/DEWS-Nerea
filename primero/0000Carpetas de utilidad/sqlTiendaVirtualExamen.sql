-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-01-2020 a las 00:17:57
-- Versión del servidor: 5.7.14
-- Versión de PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdtienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `domicilio` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `password`, `domicilio`, `telefono`, `email`) VALUES
(2, 'Juan Gil', '123', '555', '555', '555'),
(4, 'Jon Agirre', '123', 'qqqqqqqqqqq', '11', '11'),
(5, 'Jim Carrey', '123', 'aaa', 'aaa', 'aaa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencias`
--

CREATE TABLE `incidencias` (
  `idincidencia` int(11) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `idpedido` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `incidencias`
--

INSERT INTO `incidencias` (`idincidencia`, `descripcion`, `idpedido`, `fecha`) VALUES
(11, 'Items en mal estado', 2, '2019-01-19'),
(20, 'Destinatario ausente en repetidas ocasiones', 2, '2019-01-11'),
(21, 'Pedido extraviado', 4, '2020-01-12'),
(22, 'Destinatario no conforme con el envío', 4, '2019-12-23'),
(23, 'Devolución de la empresa de transporte', 4, '2019-12-22'),
(24, 'Faltan varias unidades', 5, '2020-01-27'),
(25, 'Pago denegado', 2, '2020-01-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `precio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `items`
--

INSERT INTO `items` (`id`, `nombre`, `precio`) VALUES
(1, 'Hombre de Vitrubio', 10),
(2, 'Bailarinas de Degas', 20),
(3, 'Delacroix', 40),
(4, 'Autorretrato de Van Gogh', 30),
(5, 'Girasoles de Van Gogh', 18.5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineaspedido`
--

CREATE TABLE `lineaspedido` (
  `id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `idpedido` int(11) NOT NULL,
  `iditem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `lineaspedido`
--

INSERT INTO `lineaspedido` (`id`, `cantidad`, `idpedido`, `iditem`) VALUES
(2, 4, 2, 2),
(3, 2, 2, 4),
(4, 2, 2, 5),
(5, 1, 3, 1),
(6, 2, 3, 2),
(7, 1, 3, 4),
(8, 1, 3, 5),
(9, 3, 4, 4),
(10, 2, 5, 1),
(11, 1, 5, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `total` double NOT NULL,
  `fecha` datetime NOT NULL,
  `idcliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `total`, `fecha`, `idcliente`) VALUES
(2, 177, '2019-01-06 00:00:00', 2),
(3, 98.5, '2020-01-06 00:00:00', 4),
(4, 90, '2019-12-20 00:00:00', 4),
(5, 40, '2020-01-11 00:00:00', 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD PRIMARY KEY (`idincidencia`);

--
-- Indices de la tabla `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lineaspedido`
--
ALTER TABLE `lineaspedido`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  MODIFY `idincidencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;