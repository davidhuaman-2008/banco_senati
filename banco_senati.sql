-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-10-2026 a las 00:52:59
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `banco_senati`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(10) UNSIGNED NOT NULL,
  `n_cuenta` varchar(20) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `apellido` varchar(60) NOT NULL,
  `dni` char(8) NOT NULL,
  `email` varchar(120) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `n_cuenta`, `nombre`, `apellido`, `dni`, `email`, `telefono`, `created_at`, `updated_at`) VALUES
(1, '1001', 'Daniel', 'Calzada', '25805514', 'daniel@example.com', '999111222', '2026-10-15 05:13:59', '2026-10-15 05:13:59'),
(2, '1002', 'Cecilia', 'Arias', '09903285', 'cecilia@example.com', '999333444', '2026-10-15 05:13:59', '2026-10-15 05:13:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `depositos`
--

CREATE TABLE `depositos` (
  `id` int(10) UNSIGNED NOT NULL,
  `cliente_id` int(10) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `monto` decimal(12,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `depositos`
--

INSERT INTO `depositos` (`id`, `cliente_id`, `fecha`, `monto`, `created_at`) VALUES
(1, 1, '2017-02-01', 1000.00, '2026-10-15 05:13:59'),
(2, 1, '2017-02-02', 500.00, '2026-10-15 05:13:59'),
(3, 2, '2017-02-01', 2500.00, '2026-10-15 05:13:59'),
(4, 2, '2017-02-02', 500.00, '2026-10-15 05:13:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_servicios`
--

CREATE TABLE `pago_servicios` (
  `id` int(10) UNSIGNED NOT NULL,
  `cliente_id` int(10) UNSIGNED NOT NULL,
  `concepto` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `monto` decimal(12,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pago_servicios`
--

INSERT INTO `pago_servicios` (`id`, `cliente_id`, `concepto`, `fecha`, `monto`, `created_at`) VALUES
(1, 1, 'Pago de teléfono', '2017-02-20', 75.00, '2026-10-15 05:13:59'),
(2, 2, 'Pago del agua', '2017-02-27', 95.00, '2026-10-15 05:13:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `retiros`
--

CREATE TABLE `retiros` (
  `id` int(10) UNSIGNED NOT NULL,
  `cliente_id` int(10) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `monto` decimal(12,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `retiros`
--

INSERT INTO `retiros` (`id`, `cliente_id`, `fecha`, `monto`, `created_at`) VALUES
(1, 1, '2017-02-18', 100.00, '2026-10-15 05:13:59'),
(2, 1, '2017-02-25', 100.00, '2026-10-15 05:13:59'),
(3, 2, '2017-02-18', 500.00, '2026-10-15 05:13:59'),
(4, 2, '2017-02-25', 100.00, '2026-10-15 05:13:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('admin','empleado','obrero') DEFAULT 'empleado',
  `activo` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`, `rol`, `activo`, `created_at`, `updated_at`) VALUES
(2, 'admin', '$2y$10$wlhcR.9plNznq5umVqjY/edFC7RQ9dulCW2mNZpL0BMCzCbjaFbuO', 'admin', 1, '2026-10-15 05:28:50', '2026-10-15 05:28:50');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `n_cuenta` (`n_cuenta`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD KEY `idx_dni` (`dni`);

--
-- Indices de la tabla `depositos`
--
ALTER TABLE `depositos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dep_cliente` (`cliente_id`),
  ADD KEY `idx_fecha` (`fecha`);

--
-- Indices de la tabla `pago_servicios`
--
ALTER TABLE `pago_servicios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pag_cliente` (`cliente_id`),
  ADD KEY `idx_fecha` (`fecha`);

--
-- Indices de la tabla `retiros`
--
ALTER TABLE `retiros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ret_cliente` (`cliente_id`),
  ADD KEY `idx_fecha` (`fecha`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `depositos`
--
ALTER TABLE `depositos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pago_servicios`
--
ALTER TABLE `pago_servicios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `retiros`
--
ALTER TABLE `retiros`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `depositos`
--
ALTER TABLE `depositos`
  ADD CONSTRAINT `fk_dep_cliente` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pago_servicios`
--
ALTER TABLE `pago_servicios`
  ADD CONSTRAINT `fk_pag_cliente` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `retiros`
--
ALTER TABLE `retiros`
  ADD CONSTRAINT `fk_ret_cliente` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
