-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-10-2018 a las 13:12:19
-- Versión del servidor: 10.1.35-MariaDB
-- Versión de PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `lindavista`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viviendas`
--

CREATE TABLE `viviendas` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `tipo` enum('Piso','Adosado','Chalet','Casa') COLLATE utf8_spanish_ci NOT NULL,
  `zona` enum('Centro','Nervion','Triana','Aljarafe','Macarena') COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `ndormitorios` enum('1','2','3','4','5') COLLATE utf8_spanish_ci NOT NULL DEFAULT '3',
  `precio` decimal(10,0) NOT NULL,
  `tamano` decimal(10,0) NOT NULL,
  `extras` set('Piscina','Jardín','Garage') COLLATE utf8_spanish_ci NOT NULL,
  `foto` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `observaciones` text COLLATE utf8_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `viviendas`
--

INSERT INTO `viviendas` (`id`, `tipo`, `zona`, `direccion`, `ndormitorios`, `precio`, `tamano`, `extras`, `foto`, `observaciones`) VALUES
(1, 'Piso', 'Centro', 'C/ Flor Nº 45 3º A', '1', '100000', '98', 'Jardín,Garage', '../imagenes/casa1.png', 'Muy bonita'),
(2, 'Piso', 'Centro', 'C/ Naranja Nº 5 1º A', '3', '200000', '120', 'Garage', '../imagenes/casa2.png', 'Preciosa'),
(3, 'Chalet', 'Aljarafe', 'C/ Vergara Nº 11', '5', '150000', '87', 'Jardín', '../imagenes/casa3.png', NULL),
(4, 'Casa', 'Macarena', 'C/ Luna Nº 12 1º D', '4', '80000', '95', 'Piscina', '../imagenes/casa4.png', NULL),
(5, 'Chalet', 'Triana', 'C/ Calvario Nº 52 1º H', '3', '430000', '212', 'Piscina,Jardín,Garage', '../imagenes/casa5.png', NULL),
(6, 'Adosado', 'Aljarafe', 'C/ Muy lejos Nº 16 3º G', '2', '103000', '98', '', '../imagenes/casa6.png', NULL),
(7, 'Adosado', 'Triana', 'C/ Boyero Nº 22 4-4', '2', '250000', '65', 'Garage', '../imagenes/casa7.png', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `viviendas`
--
ALTER TABLE `viviendas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `viviendas`
--
ALTER TABLE `viviendas`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
