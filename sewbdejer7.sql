-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-12-2020 a las 19:29:09
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sewbdejer7`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `dni` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `dni`, `nombre`, `apellidos`, `email`, `telefono`) VALUES
(1, '58435649D', 'Andrea', 'García Cernuda', 'uo270115@uniovi.es', 681067832),
(2, '58435649D', 'Andrea', 'García Cernuda', 'uo270115@uniovi.es', 681067832),
(3, '12345678A', 'Marta', 'Fernández', 'marta@gmail.com', 123456789),
(4, '13467985F', 'Marcos', 'García García', 'marcos@gmail.com', 134679852),
(5, '34976128G', 'María del Carmen', 'Acosta', 'mari@gmail.com', 349761285),
(6, '34976128G', 'María del Carmen', 'Acosta', 'mari@gmail.com', 349761285),
(7, '31647948H', 'Paula', 'Rubio Rodríguez', 'paula@gmail.com', 316479485);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion`
--

CREATE TABLE `habitacion` (
  `nHabitacion` int(2) NOT NULL,
  `planta` enum('1','2','3','4','5') COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `habitacion`
--

INSERT INTO `habitacion` (`nHabitacion`, `planta`) VALUES
(1, '1'),
(2, '1'),
(3, '1'),
(4, '1'),
(5, '1'),
(6, '1'),
(7, '1'),
(8, '1'),
(9, '1'),
(10, '2'),
(11, '2'),
(12, '2'),
(13, '2'),
(14, '2'),
(15, '2'),
(16, '2'),
(17, '2'),
(18, '2'),
(19, '2'),
(20, '2'),
(21, '3'),
(22, '3'),
(23, '3'),
(24, '3'),
(25, '3'),
(26, '3'),
(27, '3'),
(28, '3'),
(29, '3'),
(30, '3'),
(31, '4'),
(32, '4'),
(33, '4'),
(34, '4'),
(35, '4'),
(36, '4'),
(37, '4'),
(38, '4'),
(39, '4'),
(40, '4'),
(41, '5'),
(42, '5'),
(43, '5'),
(44, '5'),
(45, '5'),
(46, '5'),
(47, '5'),
(48, '5'),
(49, '5'),
(50, '5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `idReserva` int(11) NOT NULL,
  `fechaEntrada` date NOT NULL,
  `fechaSalida` date NOT NULL,
  `idCliente` int(11) NOT NULL,
  `nHabitacion` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`idReserva`, `fechaEntrada`, `fechaSalida`, `idCliente`, `nHabitacion`) VALUES
(2, '2020-12-18', '2020-12-22', 2, 1),
(3, '2021-02-13', '2021-02-16', 1, 2),
(4, '2020-12-19', '2020-12-21', 3, 3),
(5, '2020-12-22', '2020-12-26', 4, 4),
(6, '2020-12-30', '2021-01-02', 5, 5),
(7, '2020-12-30', '2021-01-02', 6, 6),
(8, '2020-12-31', '2021-01-03', 7, 7);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD PRIMARY KEY (`nHabitacion`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`idReserva`),
  ADD KEY `idCliente` (`idCliente`),
  ADD KEY `nHabitacion` (`nHabitacion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `idReserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `reserva_ibfk_2` FOREIGN KEY (`nHabitacion`) REFERENCES `habitacion` (`nHabitacion`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
