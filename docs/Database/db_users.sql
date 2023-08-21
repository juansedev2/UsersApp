-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-08-2023 a las 20:56:43
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_users`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `rol_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `rol_name`) VALUES
(1, 'administrator'),
(2, 'general');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `type_identifications`
--

CREATE TABLE `type_identifications` (
  `id` int(11) NOT NULL,
  `identification_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `type_identifications`
--

INSERT INTO `type_identifications` (`id`, `identification_name`) VALUES
(1, 'C.C'),
(2, 'Tarjeta de identidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) NOT NULL,
  `age` int(11) NOT NULL,
  `email` varchar(62) NOT NULL,
  `password` varchar(255) NOT NULL,
  `identification_type` int(11) NOT NULL,
  `identification_number` varchar(20) NOT NULL,
  `role_id` int(11) NOT NULL,
  `registred_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `first_name`, `middle_name`, `last_name`, `age`, `email`, `password`, `identification_type`, `identification_number`, `role_id`, `registred_on`, `update_on`) VALUES
(1, 'rescueadmin@21', 'rescueadmin@21', 'rescueadmin@21', 100, 'rescueadmin@21@email.com', '$2y$11$zdBK8tWrxLR/EN4moWVXyuIWijoXJ8.7uYvueBqhBCaCyehOYfVpy', 1, '1111111111', 1, '2023-08-21 01:41:58', '2023-08-21 01:41:58'),
(2, 'Juan', 'Sebastian', 'Arias', 21, 'jadmin2v@email.com', '$2y$11$Y.wlkaUdPN5BpVLuJiTsKOpDOUTcmjl8voXjFD8Z64elmb6LbD6.C', 1, '1234567890', 1, '2023-08-21 01:49:27', '2023-08-21 01:49:27'),
(3, 'Marin', NULL, 'Kitagawa', 21, 'marinlove@email.com', '$2y$11$mTJ3wCYsNZzUHn47SvQH1ePgctilkY.T9HSTxC3oGNQ9erOFLKRXC', 1, '1275819203', 2, '2023-08-21 01:53:32', '2023-08-21 01:53:32');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `type_identifications`
--
ALTER TABLE `type_identifications`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_role_id` (`role_id`),
  ADD KEY `fk_identification_type` (`identification_type`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `type_identifications`
--
ALTER TABLE `type_identifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`identification_type`) REFERENCES `type_identifications` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
