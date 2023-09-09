-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-09-2023 a las 21:49:21
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
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
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
  `update_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `registred_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `first_name`, `middle_name`, `last_name`, `age`, `email`, `password`, `identification_type`, `identification_number`, `role_id`, `update_on`, `registred_on`) VALUES
(1, 'rescueadmin@21', 'rescueadmin@21', 'rescueadmin@21', 100, 'rescueadmin21@email.com', '$2y$11$zdBK8tWrxLR/EN4moWVXyuIWijoXJ8.7uYvueBqhBCaCyehOYfVpy', 1, '1111111111', 1, '2023-09-05 21:42:56', '2023-08-21 01:41:58'),
(2, 'Juanito', 'Sebastian', 'Arias', 22, 'jadmin2v@email.com', '$2y$11$29TOvaffXtKDoPqrkpvIaOMe.LyRd/ulYB/pVhB3bgahJ.RREjMGW', 1, '1234567890', 1, '2023-09-09 02:32:12', '2023-08-21 01:49:27'),
(3, 'Marin', NULL, 'Kitagawa', 21, 'marinlove@email.com', '$2y$11$i3CcyKj2ZKwcwB7SLXFDK.J3WIN5V0z4ZAXJ6xn0q4lK6iLXYWCSi', 1, '1275819203', 2, '2023-09-09 02:33:41', '2023-08-21 01:53:32'),
(4, 'Ijiranaide', NULL, 'Nagatoro', 18, 'nagatoroxd@email.com', '$2y$11$LNHL6Yu5PTfXJ3EiJunSyuvNePFfFgGn8Nzze7HvSQb3aVFYVREqC', 1, '213867867', 2, '2023-09-09 00:17:09', '2023-09-09 00:17:09'),
(5, 'Sasuke', NULL, 'Uchiha', 19, 'elsasukexd@email.com', '$2y$11$UtkWaxEDAjVDkqrtvm4/Ee2q4BZBKnt07oDDc.jnKoNncPmCtV18C', 1, '1234325411', 1, '2023-09-09 02:35:25', '2023-09-09 00:20:07');

--
-- Índices para tablas volcadas
--

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
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
