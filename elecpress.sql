-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 25-01-2026 a las 18:38:39
-- Versión del servidor: 9.1.0
-- Versión de PHP: 8.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `elecpress`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `assigned_equipment`
--

DROP TABLE IF EXISTS `assigned_equipment`;
CREATE TABLE IF NOT EXISTS `assigned_equipment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `equipment_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_equipamiento` (`equipment_id`),
  KEY `id_usuario` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `assigned_equipment`
--

INSERT INTO `assigned_equipment` (`id`, `user_id`, `equipment_id`) VALUES
(1, 4, 1),
(2, 5, 14),
(3, 1, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `assigned_materials`
--

DROP TABLE IF EXISTS `assigned_materials`;
CREATE TABLE IF NOT EXISTS `assigned_materials` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `material_id` int DEFAULT NULL,
  `project_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_material` (`material_id`),
  KEY `id_usuario` (`user_id`),
  KEY `id_proyecto` (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `assigned_materials`
--

INSERT INTO `assigned_materials` (`id`, `user_id`, `material_id`, `project_id`) VALUES
(1, 3, 6, 1),
(2, 4, 9, 3),
(3, 5, 8, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `assigned_projects`
--

DROP TABLE IF EXISTS `assigned_projects`;
CREATE TABLE IF NOT EXISTS `assigned_projects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `client_id` int DEFAULT NULL,
  `project_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cliente` (`client_id`),
  KEY `id_usuario` (`user_id`),
  KEY `id_proyecto` (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `assigned_projects`
--

INSERT INTO `assigned_projects` (`id`, `user_id`, `client_id`, `project_id`) VALUES
(1, 2, 2, 1),
(2, 7, 4, 2),
(3, 1, 3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `last_name` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `company` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` bigint DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clients`
--

INSERT INTO `clients` (`id`, `first_name`, `last_name`, `company`, `phone`, `email`) VALUES
(1, 'Juan', 'García', 'HonyePop', 639136785, 'honeypop@official.com'),
(2, 'María', 'Pérez', 'ElectroVal', 612345678, 'maria.perez@electroval.com'),
(3, 'Carlos', 'Ruiz', 'NetPro', 698765432, 'carlos.ruiz@netpro.com'),
(4, 'Lucía', 'Sánchez', 'Reformas LS', 655112233, 'lucia.sanchez@reformasls.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipment`
--

DROP TABLE IF EXISTS `equipment`;
CREATE TABLE IF NOT EXISTS `equipment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `stock` int DEFAULT NULL,
  `id_category` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_categoria` (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `equipment`
--

INSERT INTO `equipment` (`id`, `name`, `stock`, `id_category`) VALUES
(1, 'Taladro Eléctrico', 11, 2),
(2, 'Arnes', 21, 4),
(3, 'Radial', 13, 2),
(4, 'Escalera 9 metros', 6, 3),
(5, 'Ford Transit ', 2, 1),
(6, 'Peugeot Partner', 1, 1),
(7, 'Opel Combo', 2, 1),
(8, 'Fiat Dobló', 2, 1),
(9, 'Telurómetro', 3, 5),
(10, 'Tester de Cables Redes RJ45', 5, 5),
(11, 'Ponchadora Hidráulica-Eléctrica', 2, 2),
(12, 'Soldador', 2, 2),
(13, 'Sierra Eléctrica ', 5, 2),
(14, 'Generador Portátil 3kW', 1, 7),
(15, 'Juego de Destornilladores', 10, 8),
(16, 'Casco de Seguridad', 12, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipment_categories`
--

DROP TABLE IF EXISTS `equipment_categories`;
CREATE TABLE IF NOT EXISTS `equipment_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `equipment_categories`
--

INSERT INTO `equipment_categories` (`id`, `name`) VALUES
(1, 'Vehículo'),
(2, 'Herramientas Eléctricas '),
(3, 'Escalera'),
(4, 'Epis'),
(5, 'Herramientas de Medición '),
(7, 'Generadores'),
(8, 'Herramientas Manuales'),
(9, 'Equipos de Protección Extra');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materials`
--

DROP TABLE IF EXISTS `materials`;
CREATE TABLE IF NOT EXISTS `materials` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_general_ci,
  `category_id_material` int DEFAULT NULL,
  `stock` int DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_categoriaMaterial` (`category_id_material`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materials`
--

INSERT INTO `materials` (`id`, `name`, `category_id_material`, `stock`, `price`) VALUES
(1, 'Cinta azul 20x19', 10, 22, 3.00),
(2, 'Cinta Marrón 20x19', 10, 17, 3.00),
(3, 'Cinta Gris 20x19', 10, 19, 3.00),
(4, 'Cinta Negra 20x19', 10, 23, 3.00),
(5, 'Cinta TT 20x19', 10, 8, 3.00),
(6, 'Tubo 20mm 30m', 1, 3, 22.00),
(7, 'Tubo 25mm 30m', 1, 4, 27.00),
(8, 'Canaleta 40x20 2m', 15, 25, 4.50),
(9, 'Conector Wago 221 (x10)', 16, 40, 6.90),
(10, 'Borne Regleta 12 polos', 17, 30, 2.20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material_categories`
--

DROP TABLE IF EXISTS `material_categories`;
CREATE TABLE IF NOT EXISTS `material_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `material_categories`
--

INSERT INTO `material_categories` (`id`, `name`) VALUES
(1, 'Tubo Corrugado'),
(2, 'Tubo PVC'),
(3, 'Tubos Acero Inoxidable '),
(4, 'Cables unifilares'),
(5, 'Magueras'),
(6, 'Interruptores'),
(7, 'Enchufes'),
(8, 'Regletas'),
(9, 'Bridas'),
(10, 'Cinta Aislante'),
(11, 'Cajas Empotrables'),
(12, 'Cajas de Superficie'),
(13, 'Tornilleria '),
(14, 'Magnetotérmico'),
(15, 'Canaleta'),
(16, 'Conectores'),
(17, 'Bornes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `budget` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `projects`
--

INSERT INTO `projects` (`id`, `name`, `created_at`, `budget`) VALUES
(1, 'Instalación Nave Industrial', '2026-01-10', 12000.00),
(2, 'Reforma Eléctrica Oficina', '2026-01-15', 4500.00),
(3, 'Cableado Red Local', '2026-01-20', 2800.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `last_name` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` bigint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `role`, `first_name`, `last_name`, `password`, `email`, `birth_date`, `created_at`, `image`, `phone`) VALUES
(1, 'superAdmin', 'Jesús', 'Clemente', '123456', 'jclementeuroz@gmail.com', '1996-09-12', '2026-01-24', '', 608164665),
(2, 'admin', 'Jose Miguel', 'López', '123456', 'jesemiguel@elecpress.com', '1988-04-02', '2026-01-25', '', 638125687),
(3, 'oficinista', 'Luis', 'Murcia', '123456', 'luismur@elecpress', '1978-07-15', '2026-01-25', '', 639195697),
(4, 'electricista', 'Antonio', 'Navarro', '123456', 'antonionav@elecpress.com', '1974-11-13', '2026-01-26', '', 672158627),
(5, 'electricista', 'Pablo', 'Gómez', '123456', 'pablo.gomez@elecpress.com', '1990-03-08', '2026-01-24', '', 611223344),
(6, 'oficinista', 'Sara', 'Linares', '123456', 'sara.linares@elecpress.com', '1994-06-21', '2026-01-24', '', 622334455),
(7, 'admin', 'David', 'Ortega', '123456', 'david.ortega@elecpress.com', '1986-12-05', '2026-01-24', '', 633445566);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `assigned_equipment`
--
ALTER TABLE `assigned_equipment`
  ADD CONSTRAINT `asignadoEquipamiento_ibfk_1` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`),
  ADD CONSTRAINT `asignadoEquipamiento_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `assigned_materials`
--
ALTER TABLE `assigned_materials`
  ADD CONSTRAINT `asignadoMaterial_ibfk_1` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`),
  ADD CONSTRAINT `asignadoMaterial_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `asignadoMaterial_ibfk_3` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);

--
-- Filtros para la tabla `assigned_projects`
--
ALTER TABLE `assigned_projects`
  ADD CONSTRAINT `asignadoProyecto_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `asignadoProyecto_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `asignadoProyecto_ibfk_3` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);

--
-- Filtros para la tabla `equipment`
--
ALTER TABLE `equipment`
  ADD CONSTRAINT `equipment_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `equipment_categories` (`id`);

--
-- Filtros para la tabla `materials`
--
ALTER TABLE `materials`
  ADD CONSTRAINT `materials_ibfk_1` FOREIGN KEY (`category_id_material`) REFERENCES `material_categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
