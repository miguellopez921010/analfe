-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-08-2016 a las 00:50:49
-- Versión del servidor: 5.6.25
-- Versión de PHP: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `analfe`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE IF NOT EXISTS `cursos` (
  `id` int(11) NOT NULL,
  `curso` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `curso`, `created`, `modified`) VALUES
(1, 'DESARROLLO DE SOFTWARE', '2016-07-08 15:12:21', '2016-07-08 15:12:21'),
(2, 'CONTABILIDAD', '2016-07-08 15:12:23', '2016-07-08 15:12:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `type_users`
--

CREATE TABLE IF NOT EXISTS `type_users` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `type_users`
--

INSERT INTO `type_users` (`id`, `name`) VALUES
(1, 'super_administrador'),
(2, 'administrador'),
(3, 'estudiante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `document_type` varchar(3) NOT NULL,
  `document_number` varchar(15) NOT NULL,
  `name` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `type_user_id` tinyint(4) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `change_password` tinyint(4) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `document_type`, `document_number`, `name`, `lastname`, `email`, `password`, `type_user_id`, `active`, `change_password`, `created`, `modified`) VALUES
(1, 'CC', '1144162860', 'MIGUEL ANDRES', 'LOPEZ CABRERA', 'miguel_20@hotmail.es', '2849ffd85806d874b6b62b288c1a0bba484250d9', 1, 1, 0, '2016-06-17 15:25:49', '2016-06-17 15:25:49'),
(10, 'CC', '3651818154', 'ANDRES FELIPE', 'ROBAYO VILLALOBOS', 'anfe924@gmail.com', 'f1e27ec4c278ff524dfc05f25305744c93ea7cef', 2, 1, 0, '2016-07-06 13:23:41', '2016-07-06 13:23:41'),
(11, 'CC', '1144044700', 'CRESPITOS', 'HOYOS', 'crespi@prueba.com', '3d2cf4c4fd9b35f86574200159458ff5181241c4', 3, 1, 0, '2016-07-08 15:12:15', '2016-07-08 15:12:15'),
(12, 'CC', '66958301', 'DIANA PATRICIA', 'CABRERA NOGUERA', 'patty2530@hotmail.com', '726c31617f38311926c453030afeb10ccb9058ba', 3, 1, 0, '2016-07-08 15:12:23', '2016-07-08 15:12:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_cursos`
--

CREATE TABLE IF NOT EXISTS `users_cursos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL,
  `ciudad` varchar(255) NOT NULL,
  `fecha_diplomado` date NOT NULL,
  `codigo_de_descarga` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users_cursos`
--

INSERT INTO `users_cursos` (`id`, `user_id`, `curso_id`, `ciudad`, `fecha_diplomado`, `codigo_de_descarga`) VALUES
(1, 11, 1, 'Cali', '2016-04-20', 'ZG9jdW1lbnRfdHlwZT1DQyZkb2N1bWVudF9udW1iZXI9MTE0NDA0NDcwMCZuYW1lPUNSRVNQSVRPUyZsYXN0bmFtZT1IT1lPUyZjdXJzbz1ERVNBUlJPTExPIERFIFNPRlRXQVJFJmZlY2hhX2RpcGxvbWFkbz0yMDE2LTA0LTIwJmNpdWRhZD1DYWxp'),
(2, 12, 2, 'Cali', '2016-06-01', 'ZG9jdW1lbnRfdHlwZT1DQyZkb2N1bWVudF9udW1iZXI9NjY5NTgzMDEmbmFtZT1ESUFOQSBQQVRSSUNJQSZsYXN0bmFtZT1DQUJSRVJBIE5PR1VFUkEmY3Vyc289Q09OVEFCSUxJREFEJmZlY2hhX2RpcGxvbWFkbz0yMDE2LTA2LTAxJmNpdWRhZD1DYWxp');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `type_users`
--
ALTER TABLE `type_users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users_cursos`
--
ALTER TABLE `users_cursos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `type_users`
--
ALTER TABLE `type_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `users_cursos`
--
ALTER TABLE `users_cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
