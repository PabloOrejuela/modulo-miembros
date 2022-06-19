-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-06-2022 a las 15:48:37
-- Versión del servidor: 8.0.29-0ubuntu0.20.04.3
-- Versión de PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `miembros`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `idasistencia` int UNSIGNED NOT NULL,
  `idmembresias` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`idasistencia`, `idmembresias`, `created_at`, `updated_at`) VALUES
(1, 2, '2022-06-11 23:10:11', '2022-06-11 23:10:11'),
(2, 1, '2022-06-17 00:58:11', '2022-06-17 00:58:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `membresias`
--

CREATE TABLE `membresias` (
  `idmembresias` int UNSIGNED NOT NULL,
  `idpaquete` int UNSIGNED NOT NULL,
  `idmiembros` int UNSIGNED NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_final` date DEFAULT NULL,
  `asistencias` smallint UNSIGNED NOT NULL DEFAULT '0',
  `total` smallint UNSIGNED NOT NULL,
  `status` tinyint UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `membresias`
--

INSERT INTO `membresias` (`idmembresias`, `idpaquete`, `idmiembros`, `fecha_inicio`, `fecha_final`, `asistencias`, `total`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '2022-06-10', '2022-07-10', 1, 30, 1, '2022-06-10 05:17:30', '2022-06-17 00:58:11'),
(2, 2, 2, '2022-06-10', '2022-09-08', 1, 90, 1, '2022-06-10 05:17:30', '2022-06-11 23:10:11'),
(3, 10, 4, '2022-06-17', '2022-07-17', 0, 12, 1, '2022-06-17 21:17:21', '2022-06-17 21:17:21'),
(4, 10, 1, '2022-06-17', '2022-07-17', 0, 12, 1, '2022-06-17 21:17:21', '2022-06-17 21:17:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `miembros`
--

CREATE TABLE `miembros` (
  `idmiembros` int UNSIGNED NOT NULL,
  `nombre` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8_general_ci DEFAULT 'J Doe',
  `cedula` varchar(13) CHARACTER SET utf8mb3 COLLATE utf8_general_ci DEFAULT '17055000000',
  `telefono` varchar(11) CHARACTER SET utf8mb3 COLLATE utf8_general_ci DEFAULT '9999999999',
  `email` varchar(120) CHARACTER SET utf8mb3 COLLATE utf8_general_ci NOT NULL DEFAULT 'jdoe@gmail.com',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `miembros`
--

INSERT INTO `miembros` (`idmiembros`, `nombre`, `cedula`, `telefono`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Pablo Orejuela', '1705520227', '0982927991', 'hostill@gmail.com', '2022-05-21 19:24:18', '2022-05-21 19:24:18'),
(2, 'Juan Francisco Orejuela', '1705520235', '0995651785', 'jfco@gmail.com', '2022-06-04 03:20:20', '2022-06-04 03:20:20'),
(3, 'Nadia Alejandra López', '1714410550', '0982827667', 'naya@gmail.com', '2022-06-10 05:17:30', '2022-06-10 05:17:30'),
(4, 'Carlos Orejuela', '1705520458', '0982827345', 'carlos@gmail.com', '2022-06-17 21:17:21', '2022-06-17 21:17:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquetes`
--

CREATE TABLE `paquetes` (
  `idpaquete` int UNSIGNED NOT NULL,
  `paquete` varchar(45) DEFAULT NULL,
  `entradas` varchar(45) DEFAULT NULL,
  `dias` smallint UNSIGNED NOT NULL DEFAULT '30',
  `tipo` tinyint UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `paquetes`
--

INSERT INTO `paquetes` (`idpaquete`, `paquete`, `entradas`, `dias`, `tipo`) VALUES
(1, 'Mensual', '30', 30, 1),
(2, 'Trimestral', '90', 90, 1),
(3, 'Semestral', '180', 180, 1),
(4, 'Anual', '360', 360, 1),
(5, 'Clase Escalada 4', '4', 30, 2),
(6, 'Clase Escalada 8', '8', 30, 2),
(7, 'Escalada Escuela mes (5-12)', '8', 30, 2),
(8, 'Escalada Escuela mes (13+)', '4', 30, 2),
(9, 'Parkour 8 mes (5-12)', '8', 30, 2),
(10, 'Parkour 12 mes (13+)', '12', 30, 2),
(11, 'Telas 8 mes (5-12)', '8', 30, 2),
(12, 'Telas 8 mes (13+)', '8', 30, 2),
(13, 'Funcional 12 mes (18+)', '12', 30, 2),
(14, 'Funcional 8 mes (18+)', '8', 30, 2),
(15, 'Calistenia 12 mes (18+)', '12', 30, 2),
(16, 'Calistenia 8 mes (18+)', '8', 30, 2),
(17, 'Yoga 8 mes (18+)', '8', 30, 2),
(18, 'Boxfit 12 mes (18+)', '12', 30, 2),
(19, 'MMAfit 12 mes (18+)', '12', 30, 2),
(20, 'Capoeira 8 mes (5-12)', '8', 30, 2),
(21, 'Capoeira 8 mes (13+)', '8', 30, 2),
(22, 'Highline / Slack 8 mes (5-12)', '8', 30, 2),
(23, 'Highline / Slack 8 mes (13+)', '8', 30, 2),
(24, 'Escal/Parkour/Calist 12 mes (18+)', '12', 30, 2),
(25, 'Escal/Parkour/Capoei 12 mes (5-12)', '12', 30, 2),
(26, 'Escal/Parkour/Capoei 12 mes (13+)', '12', 30, 2),
(27, 'Escal/Parkour/Telas 12 mes (5-12)', '12', 30, 2),
(28, 'Escal/Parkour/Telas 12 mes (13+)', '12', 30, 2),
(29, 'Escal/Parkour 8 mes (5-12)', '8', 30, 2),
(30, 'Escal/Parkour 8 mes (13+)', '8', 30, 2),
(31, 'Vacacional 20 mes (5-12)', '20', 30, 2),
(32, 'Inaugural 5 años', '1800', 1800, 1),
(33, 'Inaugural 3 años', '1080', 1800, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`idasistencia`),
  ADD KEY `fk_asistencia_membresias_idx` (`idmembresias`);

--
-- Indices de la tabla `membresias`
--
ALTER TABLE `membresias`
  ADD PRIMARY KEY (`idmembresias`),
  ADD KEY `fk_membresias_paquetes_idx` (`idpaquete`),
  ADD KEY `fk_membresias_miembros_idx` (`idmiembros`);

--
-- Indices de la tabla `miembros`
--
ALTER TABLE `miembros`
  ADD PRIMARY KEY (`idmiembros`);

--
-- Indices de la tabla `paquetes`
--
ALTER TABLE `paquetes`
  ADD PRIMARY KEY (`idpaquete`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `idasistencia` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `membresias`
--
ALTER TABLE `membresias`
  MODIFY `idmembresias` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `miembros`
--
ALTER TABLE `miembros`
  MODIFY `idmiembros` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `paquetes`
--
ALTER TABLE `paquetes`
  MODIFY `idpaquete` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `fk_asistencia_membresias` FOREIGN KEY (`idmembresias`) REFERENCES `membresias` (`idmembresias`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `membresias`
--
ALTER TABLE `membresias`
  ADD CONSTRAINT `fk_membresias_miembros` FOREIGN KEY (`idmiembros`) REFERENCES `miembros` (`idmiembros`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_membresias_paquetes` FOREIGN KEY (`idpaquete`) REFERENCES `paquetes` (`idpaquete`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
