-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306:3307
-- Tiempo de generación: 20-02-2025 a las 18:46:45
-- Versión del servidor: 10.3.16-MariaDB
-- Versión de PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `codeigniter_tests`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `Nombre`, `Email`, `Telefono`, `ImagenPerfil`, `FechaCreacion`) VALUES
(1, 'Rogelio Sanchez', 'ramon@gmail.com', '2645425741', 'test.jpg', '2025-02-20 16:07:08'),
(5, 'Koke Sanchez', 'ramon1@gmail.com', '2645541236', 'imagen_10.jpg', '2025-02-20 16:26:57'),
(7, 'Poque Sanchez', 'ramon2@gmail.com', '2646457841', 'Imagen_3.jpg', '2025-02-20 16:28:42'),
(9, 'Juan Sanchez', 'ramon3@gmail.com', '2645425741', 'Imagen_3.jpg', '2025-02-20 16:29:03'),
(11, 'Rogelio Sanchez', 'admin@gmail.com', '2645425741', '480px-Sol_de_Mayo-Bandera_de_Argentina.png', '2025-02-20 16:34:29'),
(13, 'Rogelio Sanchez', 'koke@gmail.com', '26454257411', 'camera4.png', '2025-02-20 16:35:09'),
(16, 'Juan Perez', 'jperez@prueba.com', NULL, NULL, '2025-02-20 17:23:03'),
(17, 'Marcelo J. Ruiz', 'marceruiz@gmail.com', NULL, 'Imagen_2.jpg', '2025-02-20 17:24:30'),
(18, 'Pedro Aguilar', 'pedritocrack@gmail.com', NULL, 'imagen_5.jpg', '2025-02-20 17:25:38'),
(19, 'Miguel Gimenez', 'miguegimenez@gmail.com', NULL, 'eclipse.jpg', '2025-02-20 17:42:31');

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
