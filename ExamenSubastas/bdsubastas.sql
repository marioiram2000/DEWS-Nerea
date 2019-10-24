-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-10-2019 a las 09:14:20
-- Versión del servidor: 5.7.14
-- Versión de PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdsubastas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`) VALUES
(1, 'joyas'),
(2, 'relojes'),
(3, 'coches'),
(4, 'muebles'),
(5, 'motos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `imagenblob` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id`, `id_item`, `imagen`, `imagenblob`) VALUES
(1, 1, 'imagenes\\moto1.jpg', ''),
(2, 2, 'imagenes\\moto2.jpg', ''),
(3, 3, 'imagenes\\moto3.jpg', ''),
(4, 4, 'imagenes\\moto4.jpg', ''),
(59, 37, 'imagenes/collar1-1.jfif', ''),
(60, 37, 'imagenes/collar1-2.jfif', ''),
(61, 38, 'imagenes/coche1.jpg', ''),
(63, 40, 'imagenes/coche3.jpg', ''),
(66, 41, 'imagenes/pendietes-cleopatra2.jpg', ''),
(67, 41, 'imagenes/pendietes-cleopatra1.jpg', ''),
(68, 39, 'imagenes/coche2.jpg', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `preciopartida` float NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `fechafin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `items`
--

INSERT INTO `items` (`id`, `id_cat`, `id_user`, `nombre`, `preciopartida`, `descripcion`, `fechafin`) VALUES
(1, 5, 2, 'moto1', 1000, 'Una moto rechulona', '2019-09-24 09:11:42'),
(2, 5, 2, 'moto2', 500, 'Una moto', '2019-10-23 00:00:00'),
(3, 5, 2, 'moto3', 500, 'Una moto', '2019-11-23 00:00:00'),
(4, 5, 2, 'moto 4', 1200, 'Una moto chachi', '2019-10-24 07:00:00'),
(37, 1, 3, 'Collar', 300, 'UN collar', '2010-01-01 01:00:00'),
(38, 3, 3, 'coche1', 20000, 'Un coche', '2018-01-01 01:00:00'),
(39, 3, 4, 'Coche2', 20000, 'Un coche', '2020-02-01 01:00:00'),
(40, 3, 4, 'Coche3', 22000, 'un coche', '2022-01-01 01:00:00'),
(41, 1, 4, 'pendientes', 30, 'unos pendientes', '2017-01-01 01:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pujas`
--

CREATE TABLE `pujas` (
  `id` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `cantidad` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pujas`
--

INSERT INTO `pujas` (`id`, `id_item`, `id_user`, `cantidad`) VALUES
(1, 2, 3, 9000),
(2, 4, 3, 30000),
(4, 2, 2, 520),
(10, 1, 2, 3000),
(12, 1, 2, 4000),
(15, 39, 2, 30000),
(16, 40, 3, 50000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cadenaverificacion` varchar(100) NOT NULL,
  `activo` tinyint(4) NOT NULL,
  `falso` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `nombre`, `password`, `email`, `cadenaverificacion`, `activo`, `falso`) VALUES
(1, 'admin', 'admin', '123', 'admin@admin.com', '65416516', 1, 0),
(2, 'mario', 'MARIO OROZCO', '123', 'marioiram2000@gmail.com', '6545641', 1, 0),
(3, 'comprador1', 'COMPRADOR 1', '123', 'comprador1@comprador1.com', '98491', 1, 0),
(4, 'comprador2', 'COMPRADOR 2', '123', 'comprador2@gmail.com', 'abcdefghijklmnop', 1, 0),
(12, 'comprador3', 'COMPRADOR 3', '123', 'marioiram2000@gmail.com', 'SVVBeMvoPPjFZwrE', 1, 0),
(13, 'comprador4', 'COMPRADOR 4', '123', 'marioiram2000@gmail.com', 'SmfyMTh6lSbFnjzX', 0, 0),
(14, 'comprador5', 'COMPRADOR 5', '123', 'marioiram2000@gmail.com', 'v9UxdC91oYo00NnO', 1, 0),
(15, 'comprador6', 'COMPRADOR 6', '123', 'marioiram2000@gmail.com', 'gEwcORE6op1UPgej', 1, 0),
(16, 'comprador7', 'COMPRADOR 7', '123', 'marioiram2000@gmail.com', 'U34T46AN53FFLTTd', 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_item` (`id_item`);

--
-- Indices de la tabla `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cat` (`id_cat`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_cat_2` (`id_cat`);

--
-- Indices de la tabla `pujas`
--
ALTER TABLE `pujas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_item` (`id_item`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cadenaverificacion` (`cadenaverificacion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT de la tabla `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT de la tabla `pujas`
--
ALTER TABLE `pujas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD CONSTRAINT `imagenes_ibfk_1` FOREIGN KEY (`id_item`) REFERENCES `items` (`id`);

--
-- Filtros para la tabla `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`id_cat`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `items_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `pujas`
--
ALTER TABLE `pujas`
  ADD CONSTRAINT `pujas_ibfk_1` FOREIGN KEY (`id_item`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `pujas_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
