-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-11-2019 a las 22:47:56
-- Versión del servidor: 5.7.14
-- Versión de PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdbus`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `averias`
--

CREATE TABLE `averias` (
  `id_averia` int(11) NOT NULL,
  `motivo` varchar(300) NOT NULL,
  `fecha` date NOT NULL,
  `coste` double NOT NULL,
  `reparada` tinyint(1) NOT NULL,
  `id_placa` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `buses`
--

CREATE TABLE `buses` (
  `Id_Placa` char(10) NOT NULL,
  `Capacidad` int(10) UNSIGNED NOT NULL,
  `imagen` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `buses`
--

INSERT INTO `buses` (`Id_Placa`, `Capacidad`, `imagen`) VALUES
('WMX-0001', 18, 'mercedes 1721.jpg'),
('WMX-0002', 20, 'otokar 2130.jpg'),
('WMX-0003', 35, 'tata 8000.jpg'),
('WMX-0004', 21, 'volvo b12.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `Id_DNI` char(10) NOT NULL,
  `Nombre` char(60) NOT NULL,
  `Direccion` char(60) NOT NULL,
  `Email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`Id_DNI`, `Nombre`, `Direccion`, `Email`) VALUES
('10845812', 'Jesus Maita', 'Av. Los portales 754', 'jmaita@gmail.com'),
('10858871', 'Nicolas Sanchez', 'Av. Ica 578', 'utnico@gmail.com'),
('30190900', 'Pedro Orbea', 'Paseo Acacias 309 - Lima', 'porbea@correo.pe'),
('41352696', 'Carlos Morales', 'Jr.Aguarico 875', 'cmorales@gmail.com'),
('41522188', 'Lesly Briceno', 'Calle Larco 111', 'lbricen.b@gmail.com'),
('42539687', 'Martin Ramirez', 'Jr.Aguarico 555', 'mramirez@gmail.com'),
('42558685', 'Juan Carlos Damian', 'Jr. Iquitos 235', 'jdamian@gmail.com'),
('44531258', 'Yessel Briceno', 'Jr.Aguarico 649', 'ybricen.b@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `Id_Ticket` int(10) UNSIGNED NOT NULL,
  `Pagado` tinyint(1) NOT NULL,
  `NumAsiento` int(10) UNSIGNED NOT NULL,
  `Id_DNI` char(10) NOT NULL,
  `Id_Ruta` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`Id_Ticket`, `Pagado`, `NumAsiento`, `Id_DNI`, `Id_Ruta`) VALUES
(1, 0, 1, '44531258', 1),
(2, 0, 1, '41522188', 2),
(3, 0, 1, '10845812', 3),
(4, 0, 1, '41352696', 4),
(5, 0, 2, '10845812', 1),
(6, 1, 2, '30190900', 2),
(7, 1, 3, '30190900', 2),
(8, 1, 4, '30190900', 2),
(9, 1, 5, '30190900', 2),
(10, 1, 6, '30190900', 2),
(13, 1, 31, '44531258', 6),
(14, 1, 18, '30190900', 1),
(17, 1, 15, '30190900', 5),
(18, 1, 12, '30190900', 5),
(19, 1, 15, '10845812', 7),
(24, 1, 1, '10845812', 9),
(25, 1, 2, '10845812', 9),
(26, 1, 3, '10845812', 9),
(27, 1, 19, '10845812', 9),
(28, 1, 20, '10845812', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutas`
--

CREATE TABLE `rutas` (
  `Id_Ruta` int(10) UNSIGNED NOT NULL,
  `CiudadOrigen` char(60) NOT NULL,
  `CiudadDestino` char(60) NOT NULL,
  `HoraSalida` datetime NOT NULL,
  `HoraLlegada` datetime NOT NULL,
  `Tarifa` double NOT NULL,
  `Id_Placa` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rutas`
--

INSERT INTO `rutas` (`Id_Ruta`, `CiudadOrigen`, `CiudadDestino`, `HoraSalida`, `HoraLlegada`, `Tarifa`, `Id_Placa`) VALUES
(1, 'Tumbes', 'Barranca', '2020-05-11 11:40:00', '2020-05-25 00:00:00', 74, 'WMX-0002'),
(2, 'Lima', 'Ica', '2020-05-11 09:36:00', '2020-05-25 14:00:00', 88, 'WMX-0004'),
(3, 'Chiclayo', 'Arequipa', '2020-05-26 09:00:00', '2020-05-26 00:00:00', 45, 'WMX-0003'),
(4, 'Lima', 'Barranca', '2019-10-09 18:00:00', '2019-10-09 21:40:00', 35, 'WMX-0002'),
(5, 'Tumbes', 'Arequipa', '2020-05-28 20:15:00', '2020-05-28 00:00:00', 86, 'WMX-0001'),
(6, 'Tumbes', 'Barranca', '2020-01-05 13:10:00', '2020-01-06 14:21:00', 22, 'WMX-0003'),
(7, 'Chiclayo', 'Barranca', '2020-01-22 08:30:00', '2020-01-22 10:00:00', 14, 'WMX-0001'),
(8, 'Tumbes', 'Barranca', '2020-01-16 18:45:00', '2020-01-16 20:30:00', 25, 'WMX-0003'),
(9, 'Chiclayo', 'Ica', '2020-01-22 06:30:00', '2020-01-23 00:00:00', 56, 'WMX-0004');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `averias`
--
ALTER TABLE `averias`
  ADD PRIMARY KEY (`id_averia`),
  ADD KEY `id_placa` (`id_placa`);

--
-- Indices de la tabla `buses`
--
ALTER TABLE `buses`
  ADD PRIMARY KEY (`Id_Placa`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`Id_DNI`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`Id_Ticket`),
  ADD KEY `FK_reservas_1` (`Id_DNI`),
  ADD KEY `FK_reservas_2` (`Id_Ruta`);

--
-- Indices de la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD PRIMARY KEY (`Id_Ruta`),
  ADD KEY `FK_rutas_1` (`Id_Placa`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `averias`
--
ALTER TABLE `averias`
  MODIFY `id_averia` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `Id_Ticket` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT de la tabla `rutas`
--
ALTER TABLE `rutas`
  MODIFY `Id_Ruta` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `averias`
--
ALTER TABLE `averias`
  ADD CONSTRAINT `averias_ibfk_1` FOREIGN KEY (`id_placa`) REFERENCES `buses` (`Id_Placa`);

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `FK_reservas_1` FOREIGN KEY (`Id_DNI`) REFERENCES `clientes` (`Id_DNI`),
  ADD CONSTRAINT `FK_reservas_2` FOREIGN KEY (`Id_Ruta`) REFERENCES `rutas` (`Id_Ruta`);

--
-- Filtros para la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD CONSTRAINT `FK_rutas_1` FOREIGN KEY (`Id_Placa`) REFERENCES `buses` (`Id_Placa`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
