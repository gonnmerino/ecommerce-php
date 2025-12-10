-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.4.3 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para web2
CREATE DATABASE IF NOT EXISTS `web2` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `web2`;

-- Volcando estructura para tabla web2.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `categoria_padre_id` int DEFAULT NULL,
  `mostrar_en_nav` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`),
  KEY `categoria_padre_id` (`categoria_padre_id`),
  CONSTRAINT `categorias_ibfk_1` FOREIGN KEY (`categoria_padre_id`) REFERENCES `categorias` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla web2.categorias: ~18 rows (aproximadamente)
INSERT INTO `categorias` (`id`, `nombre`, `categoria_padre_id`, `mostrar_en_nav`) VALUES
	(44, 'Componentes', NULL, 1),
	(45, 'Ofertas', NULL, 0),
	(46, 'Notebooks', NULL, 1),
	(47, 'PC Armadas', NULL, 1),
	(48, 'Monitores', NULL, 1),
	(49, 'Perifericos', NULL, 1),
	(50, 'Procesadores', 44, 0),
	(51, 'Tarjetas Gráficas', 44, 0),
	(52, 'Memorias RAM', 44, 0),
	(53, 'Discos Duros', 44, 0),
	(54, 'Placas Madre', 44, 0),
	(55, 'Fuentes de Poder', 44, 0),
	(56, 'Gabinetes', 44, 0),
	(57, 'Teclados', 49, 0),
	(58, 'Mouse', 49, 0),
	(59, 'Audífonos', 49, 0),
	(60, 'Webcams', 49, 0),
	(61, 'Micrófonos', 49, 0);

-- Volcando estructura para tabla web2.cfg_panel
CREATE TABLE IF NOT EXISTS `cfg_panel` (
  `id` int NOT NULL AUTO_INCREMENT,
  `stock_bajo_numero` int NOT NULL,
  `por_pagina` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla web2.cfg_panel: ~1 rows (aproximadamente)
INSERT INTO `cfg_panel` (`id`, `stock_bajo_numero`, `por_pagina`) VALUES
	(1, 40, 15);

-- Volcando estructura para tabla web2.productos
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text,
  `precio` decimal(10,2) NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `activo` tinyint(1) DEFAULT '1',
  `sku` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `categoria_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sku` (`sku`),
  KEY `categoria_id` (`categoria_id`),
  CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla web2.productos: ~158 rows (aproximadamente)
INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `stock`, `activo`, `sku`, `imagen`, `fecha_creacion`, `categoria_id`) VALUES
	(1, 'Ryzen 5 5600g', 'Procesador', 160.00, 5, 1, 'ryzen-5-5600g-1', 'ryzen-5-5600g-1.jpeg', '2025-12-05 22:09:55', 50),
	(2, 'Intel Core i9-13900K', 'Procesador de 24 núcleos, 5.8GHz Turbo', 589.99, 25, 1, 'intel-core-i9-13900k-1', NULL, '2025-12-05 22:30:44', 50),
	(3, 'AMD Ryzen 9 7950X', 'Procesador 16 núcleos, 4.5GHz base', 549.99, 30, 1, 'amd-ryzen-9-7950x-2', NULL, '2025-12-05 22:30:44', 50),
	(4, 'Intel Core i7-13700K', 'Procesador 16 núcleos, 5.4GHz Turbo', 409.99, 40, 1, 'intel-core-i7-13700k-3', NULL, '2025-12-05 22:30:44', 50),
	(5, 'AMD Ryzen 7 7800X3D', 'Procesador 8 núcleos con tecnología 3D V-Cache', 449.99, 35, 1, 'amd-ryzen-7-7800x3d-4', NULL, '2025-12-05 22:30:44', 50),
	(6, 'Intel Core i5-13600K', 'Procesador 14 núcleos para gaming', 319.99, 50, 1, 'intel-core-i5-13600k-5', NULL, '2025-12-05 22:30:44', 50),
	(7, 'AMD Ryzen 5 7600X', 'Procesador 6 núcleos, 4.7GHz base', 229.99, 60, 1, 'amd-ryzen-5-7600x-6', NULL, '2025-12-05 22:30:44', 50),
	(8, 'Intel Core i3-13100', 'Procesador 4 núcleos, 4.5GHz Turbo', 149.99, 80, 1, 'intel-core-i3-13100-7', NULL, '2025-12-05 22:30:44', 50),
	(9, 'AMD Ryzen 9 7900X', 'Procesador 12 núcleos, 5.6GHz max', 429.99, 28, 1, 'amd-ryzen-9-7900x-8', NULL, '2025-12-05 22:30:44', 50),
	(10, 'Intel Xeon W-3375', 'Procesador workstation 38 núcleos', 3499.99, 8, 1, 'intel-xeon-w-3375-9', NULL, '2025-12-05 22:30:44', 50),
	(11, 'AMD Threadripper 7970X', 'Procesador HEDT 32 núcleos', 2499.99, 12, 1, 'amd-threadripper-7970x-10', NULL, '2025-12-05 22:30:44', 50),
	(12, 'Intel Core i9-12900KS', 'Edición especial, 5.5GHz all-core', 739.99, 15, 1, 'intel-core-i9-12900ks-11', NULL, '2025-12-05 22:30:44', 50),
	(13, 'AMD Ryzen 7 7700X', '8 núcleos, arquitectura Zen 4', 349.99, 45, 1, 'amd-ryzen-7-7700x-12', NULL, '2025-12-05 22:30:44', 50),
	(14, 'Intel Core i5-13400F', '10 núcleos, sin gráfica integrada', 199.99, 65, 1, 'intel-core-i5-13400f-13', NULL, '2025-12-05 22:30:44', 50),
	(15, 'AMD Ryzen 5 5600X', '6 núcleos, compatible AM4', 199.99, 90, 1, 'amd-ryzen-5-5600x-14', NULL, '2025-12-05 22:30:44', 50),
	(16, 'Intel Core i7-12700K', '12 núcleos, arquitectura Alder Lake', 349.99, 38, 1, 'intel-core-i7-12700k-15', NULL, '2025-12-05 22:30:44', 50),
	(17, 'AMD Ryzen 9 5950X', '16 núcleos, plataforma AM4', 499.99, 22, 1, 'amd-ryzen-9-5950x-16', NULL, '2025-12-05 22:30:44', 50),
	(18, 'Intel Core i9-11900K', '8 núcleos, 5.3GHz Turbo', 399.99, 30, 1, 'intel-core-i9-11900k-17', NULL, '2025-12-05 22:30:44', 50),
	(19, 'AMD Ryzen 3 4100', '4 núcleos, económico para office', 99.99, 120, 1, 'amd-ryzen-3-4100-18', NULL, '2025-12-05 22:30:44', 50),
	(20, 'Intel Pentium Gold G7400', '2 núcleos, gráficos UHD 710', 89.99, 150, 1, 'intel-pentium-gold-g7400-19', NULL, '2025-12-05 22:30:44', 50),
	(21, 'AMD Athlon 3000G', '2 núcleos, con gráficos Vega', 59.99, 200, 1, 'amd-athlon-3000g-20', NULL, '2025-12-05 22:30:44', 50),
	(22, 'NVIDIA RTX 4090', '24GB GDDR6X, arquitectura Ada Lovelace', 1599.99, 15, 1, 'nvidia-rtx-4090-21', NULL, '2025-12-05 22:30:44', 51),
	(23, 'AMD Radeon RX 7900 XTX', '24GB GDDR6, arquitectura RDNA 3', 999.99, 20, 1, 'amd-radeon-rx-7900-xtx-22', NULL, '2025-12-05 22:30:44', 51),
	(24, 'NVIDIA RTX 4080 SUPER', '16GB GDDR6X, DLSS 3.5', 1199.99, 18, 1, 'nvidia-rtx-4080-super-23', NULL, '2025-12-05 22:30:44', 51),
	(25, 'AMD Radeon RX 7800 XT', '16GB GDDR6, 64MB Infinity Cache', 549.99, 25, 1, 'amd-radeon-rx-7800-xt-24', NULL, '2025-12-05 22:30:44', 51),
	(26, 'NVIDIA RTX 4070 Ti SUPER', '16GB GDDR6X, 256-bit bus', 799.99, 22, 1, 'nvidia-rtx-4070-ti-super-25', NULL, '2025-12-05 22:30:44', 51),
	(27, 'AMD Radeon RX 7700 XT', '12GB GDDR6, 192-bit bus', 449.99, 30, 1, 'amd-radeon-rx-7700-xt-26', NULL, '2025-12-05 22:30:44', 51),
	(28, 'NVIDIA RTX 4060 Ti', '8GB GDDR6, 128-bit bus', 399.99, 35, 1, 'nvidia-rtx-4060-ti-27', NULL, '2025-12-05 22:30:44', 51),
	(29, 'AMD Radeon RX 7600', '8GB GDDR6, arquitectura RDNA 3', 269.99, 40, 1, 'amd-radeon-rx-7600-28', NULL, '2025-12-05 22:30:44', 51),
	(30, 'NVIDIA RTX 3050', '8GB GDDR6, para 1080p gaming', 249.99, 50, 1, 'nvidia-rtx-3050-29', NULL, '2025-12-05 22:30:44', 51),
	(31, 'AMD Radeon RX 6600', '8GB GDDR6, económico para gaming', 229.99, 55, 1, 'amd-radeon-rx-6600-30', NULL, '2025-12-05 22:30:44', 51),
	(32, 'NVIDIA RTX 3090 Ti', '24GB GDDR6X, última gen Ampere', 1199.99, 12, 1, 'nvidia-rtx-3090-ti-31', NULL, '2025-12-05 22:30:44', 51),
	(33, 'AMD Radeon RX 6950 XT', '16GB GDDR6, alta gama RDNA 2', 649.99, 16, 1, 'amd-radeon-rx-6950-xt-32', NULL, '2025-12-05 22:30:44', 51),
	(34, 'NVIDIA RTX 3070', '8GB GDDR6, 1440p gaming', 499.99, 20, 1, 'nvidia-rtx-3070-33', NULL, '2025-12-05 22:30:44', 51),
	(35, 'AMD Radeon RX 6750 XT', '12GB GDDR6, 1440p performance', 379.99, 28, 1, 'amd-radeon-rx-6750-xt-34', NULL, '2025-12-05 22:30:44', 51),
	(36, 'NVIDIA GTX 1660 SUPER', '6GB GDDR6, presupuesto gaming', 229.99, 45, 1, 'nvidia-gtx-1660-super-35', NULL, '2025-12-05 22:30:44', 51),
	(37, 'AMD Radeon RX 6400', '4GB GDDR6, low profile', 159.99, 60, 1, 'amd-radeon-rx-6400-36', NULL, '2025-12-05 22:30:44', 51),
	(38, 'NVIDIA RTX A6000', '48GB GDDR6, workstation profesional', 3999.99, 5, 1, 'nvidia-rtx-a6000-37', NULL, '2025-12-05 22:30:44', 51),
	(39, 'AMD Radeon Pro W7800', '32GB GDDR6, para estaciones de trabajo', 2499.99, 8, 1, 'amd-radeon-pro-w7800-38', NULL, '2025-12-05 22:30:44', 51),
	(40, 'NVIDIA T1000', '4GB GDDR6, para CAD/rendering', 349.99, 25, 1, 'nvidia-t1000-39', NULL, '2025-12-05 22:30:44', 51),
	(41, 'AMD FirePro W7100', '8GB GDDR5, workstation 3D', 499.99, 18, 1, 'amd-firepro-w7100-40', NULL, '2025-12-05 22:30:44', 51),
	(42, 'Corsair Vengeance RGB 32GB', 'DDR5 6000MHz CL36, 2x16GB', 129.99, 40, 1, 'corsair-vengeance-rgb-32gb-41', NULL, '2025-12-05 22:30:44', 52),
	(43, 'G.Skill Trident Z5 64GB', 'DDR5 6400MHz CL32, 2x32GB', 249.99, 25, 1, 'gskill-trident-z5-64gb-42', NULL, '2025-12-05 22:30:44', 52),
	(44, 'Kingston Fury Beast 16GB', 'DDR5 5600MHz CL40, 1x16GB', 69.99, 60, 1, 'kingston-fury-beast-16gb-43', NULL, '2025-12-05 22:30:44', 52),
	(45, 'Crucial Pro 32GB', 'DDR5 4800MHz, 2x16GB', 89.99, 50, 1, 'crucial-pro-32gb-44', NULL, '2025-12-05 22:30:44', 52),
	(46, 'TeamGroup T-Force Delta 16GB', 'DDR5 6000MHz CL30, RGB', 89.99, 45, 1, 'teamgroup-t-force-delta-16gb-45', NULL, '2025-12-05 22:30:44', 52),
	(47, 'Patriot Viper Steel 64GB', 'DDR4 3200MHz, 4x16GB', 149.99, 30, 1, 'patriot-viper-steel-64gb-46', NULL, '2025-12-05 22:30:44', 52),
	(48, 'HyperX Predator 32GB', 'DDR4 3600MHz CL17, 2x16GB', 109.99, 35, 1, 'hyperx-predator-32gb-47', NULL, '2025-12-05 22:30:44', 52),
	(49, 'Corsair Dominator Platinum 128GB', 'DDR5 5200MHz, 4x32GB', 549.99, 10, 1, 'corsair-dominator-platinum-128gb-48', NULL, '2025-12-05 22:30:44', 52),
	(50, 'G.Skill Ripjaws V 16GB', 'DDR4 3200MHz CL16, 2x8GB', 49.99, 80, 1, 'gskill-ripjaws-v-16gb-49', NULL, '2025-12-05 22:30:44', 52),
	(51, 'Silicon Power XPOWER 32GB', 'DDR4 2666MHz, 2x16GB', 59.99, 70, 1, 'silicon-power-xpower-32gb-50', NULL, '2025-12-05 22:30:44', 52),
	(52, 'ADATA XPG Lancer 16GB', 'DDR5 6000MHz CL40, RGB', 79.99, 55, 1, 'adata-xpg-lancer-16gb-51', NULL, '2025-12-05 22:30:44', 52),
	(53, 'OLOy Blade RGB 32GB', 'DDR4 3600MHz, 2x16GB', 84.99, 40, 1, 'oloy-blade-rgb-32gb-52', NULL, '2025-12-05 22:30:44', 52),
	(54, 'PNY XLR8 16GB', 'DDR4 3200MHz, single module', 44.99, 90, 1, 'pny-xlr8-16gb-53', NULL, '2025-12-05 22:30:44', 52),
	(55, 'Mushkin Redline 64GB', 'DDR5 6000MHz, 2x32GB', 219.99, 20, 1, 'mushkin-redline-64gb-54', NULL, '2025-12-05 22:30:44', 52),
	(56, 'GeIL Orion RGB 16GB', 'DDR5 5200MHz, AMD EXPO', 74.99, 65, 1, 'geil-orion-rgb-16gb-55', NULL, '2025-12-05 22:30:44', 52),
	(57, 'ZADAK Spark RGB 32GB', 'DDR5 6400MHz, premium design', 179.99, 28, 1, 'zadak-spark-rgb-32gb-56', NULL, '2025-12-05 22:30:44', 52),
	(58, 'V-Color Skywalker 16GB', 'DDR4 3600MHz, low profile', 52.99, 75, 1, 'v-color-skywalker-16gb-57', NULL, '2025-12-05 22:30:44', 52),
	(59, 'Crucial Ballistix 32GB', 'DDR4 3200MHz CL16, gaming', 99.99, 42, 1, 'crucial-ballistix-32gb-58', NULL, '2025-12-05 22:30:44', 52),
	(60, 'Kingston HyperX Fury 8GB', 'DDR3 1866MHz, para antiguos sistemas', 39.99, 100, 1, 'kingston-hyperx-fury-8gb-59', NULL, '2025-12-05 22:30:44', 52),
	(61, 'TeamGroup Vulcan Z 16GB', 'DDR4 3200MHz, sin RGB', 47.99, 85, 1, 'teamgroup-vulcan-z-16gb-60', NULL, '2025-12-05 22:30:44', 52),
	(62, 'Samsung 980 Pro 2TB', 'NVMe PCIe 4.0, 7000MB/s', 149.99, 35, 1, 'samsung-980-pro-2tb-61', NULL, '2025-12-05 22:30:44', 53),
	(63, 'Western Digital Black SN850X 1TB', 'NVMe PCIe 4.0, gaming', 99.99, 45, 1, 'wd-black-sn850x-1tb-62', NULL, '2025-12-05 22:30:44', 53),
	(64, 'Crucial P5 Plus 2TB', 'NVMe PCIe 4.0, 6600MB/s', 129.99, 40, 1, 'crucial-p5-plus-2tb-63', NULL, '2025-12-05 22:30:44', 53),
	(65, 'Seagate FireCuda 530 4TB', 'NVMe PCIe 4.0, 7300MB/s', 399.99, 20, 1, 'seagate-firecuda-530-4tb-64', NULL, '2025-12-05 22:30:44', 53),
	(66, 'Kingston KC3000 1TB', 'NVMe PCIe 4.0, alta resistencia', 89.99, 50, 1, 'kingston-kc3000-1tb-65', NULL, '2025-12-05 22:30:44', 53),
	(67, 'Sabrent Rocket 4 Plus 2TB', 'NVMe PCIe 4.0, con disipador', 139.99, 30, 1, 'sabrent-rocket-4-plus-2tb-66', NULL, '2025-12-05 22:30:44', 53),
	(68, 'ADATA XPG Gammix S70 Blade 1TB', 'NVMe PCIe 4.0, 7400MB/s', 79.99, 55, 1, 'adata-xpg-gammix-s70-blade-1tb-67', NULL, '2025-12-05 22:30:44', 53),
	(69, 'TeamGroup Cardea Zero Z440 2TB', 'NVMe PCIe 4.0, 5000MB/s', 109.99, 38, 1, 'teamgroup-cardea-zero-z440-2tb-68', NULL, '2025-12-05 22:30:44', 53),
	(70, 'Samsung 870 EVO 1TB', 'SATA III SSD, 560MB/s', 89.99, 60, 1, 'samsung-870-evo-1tb-69', NULL, '2025-12-05 22:30:44', 53),
	(71, 'Crucial MX500 2TB', 'SATA III SSD, 560MB/s', 119.99, 42, 1, 'crucial-mx500-2tb-70', NULL, '2025-12-05 22:30:44', 53),
	(72, 'Western Digital Blue 4TB', 'HDD 3.5", 5400RPM', 79.99, 70, 1, 'wd-blue-4tb-71', NULL, '2025-12-05 22:30:44', 53),
	(73, 'Seagate Barracuda 2TB', 'HDD 3.5", 7200RPM', 59.99, 80, 1, 'seagate-barracuda-2tb-72', NULL, '2025-12-05 22:30:44', 53),
	(74, 'Toshiba X300 6TB', 'HDD 3.5", 7200RPM para gaming', 149.99, 25, 1, 'toshiba-x300-6tb-73', NULL, '2025-12-05 22:30:44', 53),
	(75, 'SanDisk Ultra 3D 1TB', 'SATA III SSD, 560MB/s', 74.99, 65, 1, 'sandisk-ultra-3d-1tb-74', NULL, '2025-12-05 22:30:44', 53),
	(76, 'Intel 670p 2TB', 'NVMe PCIe 3.0, QLC', 99.99, 48, 1, 'intel-670p-2tb-75', NULL, '2025-12-05 22:30:44', 53),
	(77, 'Kingston NV2 1TB', 'NVMe PCIe 4.0, económico', 54.99, 90, 1, 'kingston-nv2-1tb-76', NULL, '2025-12-05 22:30:44', 53),
	(78, 'PNY CS1030 500GB', 'NVMe PCIe 3.0, entrada', 39.99, 120, 1, 'pny-cs1030-500gb-77', NULL, '2025-12-05 22:30:44', 53),
	(79, 'HP EX950 1TB', 'NVMe PCIe 3.0, 3500MB/s', 69.99, 58, 1, 'hp-ex950-1tb-78', NULL, '2025-12-05 22:30:44', 53),
	(80, 'Gigabyte AORUS 2TB', 'NVMe PCIe 4.0, con RGB', 159.99, 32, 1, 'gigabyte-aorus-2tb-79', NULL, '2025-12-05 22:30:44', 53),
	(81, 'Lexar NM710 1TB', 'NVMe PCIe 4.0, 5000MB/s', 59.99, 75, 1, 'lexar-nm710-1tb-80', NULL, '2025-12-05 22:30:44', 53),
	(82, 'ASUS ROG Strix Z790-E', 'Socket LGA1700, WiFi 6E', 499.99, 20, 1, 'asus-rog-strix-z790-e-81', NULL, '2025-12-05 22:30:44', 54),
	(83, 'MSI MAG B650 TOMAHAWK', 'Socket AM5, DDR5', 219.99, 35, 1, 'msi-mag-b650-tomahawk-82', NULL, '2025-12-05 22:30:44', 54),
	(84, 'Gigabyte B760 AORUS Elite', 'Socket LGA1700, DDR4', 179.99, 40, 1, 'gigabyte-b760-aorus-elite-83', NULL, '2025-12-05 22:30:44', 54),
	(85, 'ASRock X670E Steel Legend', 'Socket AM5, PCIe 5.0', 329.99, 25, 1, 'asrock-x670e-steel-legend-84', NULL, '2025-12-05 22:30:44', 54),
	(86, 'ASUS TUF Gaming B550-PLUS', 'Socket AM4, WiFi', 149.99, 50, 1, 'asus-tuf-gaming-b550-plus-85', NULL, '2025-12-05 22:30:44', 54),
	(87, 'MSI PRO Z790-A', 'Socket LGA1700, DDR5', 249.99, 30, 1, 'msi-pro-z790-a-86', NULL, '2025-12-05 22:30:44', 54),
	(88, 'Gigabyte X670 AORUS Elite AX', 'Socket AM5, WiFi 6', 299.99, 28, 1, 'gigabyte-x670-aorus-elite-ax-87', NULL, '2025-12-05 22:30:44', 54),
	(89, 'ASUS Prime Z690-P', 'Socket LGA1700, básica', 189.99, 45, 1, 'asus-prime-z690-p-88', NULL, '2025-12-05 22:30:44', 54),
	(90, 'ASRock B660M Pro RS', 'Micro-ATX, Socket LGA1700', 119.99, 60, 1, 'asrock-b660m-pro-rs-89', NULL, '2025-12-05 22:30:44', 54),
	(91, 'MSI MPG B550 Gaming Edge', 'Socket AM4, WiFi 6', 179.99, 42, 1, 'msi-mpg-b550-gaming-edge-90', NULL, '2025-12-05 22:30:44', 54),
	(92, 'Gigabyte Z690 UD', 'Socket LGA1700, DDR4', 199.99, 38, 1, 'gigabyte-z690-ud-91', NULL, '2025-12-05 22:30:44', 54),
	(93, 'ASUS ROG Crosshair X670E Hero', 'Socket AM5, alta gama', 699.99, 12, 1, 'asus-rog-crosshair-x670e-hero-92', NULL, '2025-12-05 22:30:44', 54),
	(94, 'MSI MAG B660M Mortar', 'Micro-ATX, DDR4', 159.99, 48, 1, 'msi-mag-b660m-mortar-93', NULL, '2025-12-05 22:30:44', 54),
	(95, 'ASRock B550M Steel Legend', 'Micro-ATX, Socket AM4', 129.99, 55, 1, 'asrock-b550m-steel-legend-94', NULL, '2025-12-05 22:30:44', 54),
	(96, 'ASUS Prime B450M-A', 'Socket AM4, económica', 79.99, 70, 1, 'asus-prime-b450m-a-95', NULL, '2025-12-05 22:30:44', 54),
	(97, 'Gigabyte B550 AORUS Pro', 'Socket AM4, ATX', 169.99, 44, 1, 'gigabyte-b550-aorus-pro-96', NULL, '2025-12-05 22:30:44', 54),
	(98, 'MSI MEG Z790 Ace', 'Socket LGA1700, premium', 599.99, 15, 1, 'msi-meg-z790-ace-97', NULL, '2025-12-05 22:30:44', 54),
	(99, 'ASRock Z590 Phantom Gaming', 'Socket LGA1200, RGB', 199.99, 32, 1, 'asrock-z590-phantom-gaming-98', NULL, '2025-12-05 22:30:44', 54),
	(100, 'ASUS ROG Maximus Z790 Hero', 'Socket LGA1700, flagship', 649.99, 18, 1, 'asus-rog-maximus-z790-hero-99', NULL, '2025-12-05 22:30:44', 54),
	(101, 'Gigabyte H610M S2H', 'Socket LGA1700, micro-ATX', 89.99, 65, 1, 'gigabyte-h610m-s2h-100', NULL, '2025-12-05 22:30:44', 54),
	(102, 'Corsair RM850x', '850W 80 Plus Gold, modular', 149.99, 40, 1, 'corsair-rm850x-101', NULL, '2025-12-05 22:30:44', 55),
	(103, 'EVGA SuperNOVA 1000 G6', '1000W 80 Plus Gold, full modular', 199.99, 25, 1, 'evga-supernova-1000-g6-102', NULL, '2025-12-05 22:30:44', 55),
	(104, 'Seasonic Focus GX-750', '750W 80 Plus Gold, modular', 129.99, 45, 1, 'seasonic-focus-gx-750-103', NULL, '2025-12-05 22:30:44', 55),
	(105, 'Thermaltake Toughpower GF1 850W', '850W 80 Plus Gold, RGB', 139.99, 35, 1, 'thermaltake-toughpower-gf1-850w-104', NULL, '2025-12-05 22:30:44', 55),
	(106, 'be quiet! Straight Power 11 750W', '750W 80 Plus Platinum', 149.99, 38, 1, 'be-quiet-straight-power-11-750w-105', NULL, '2025-12-05 22:30:44', 55),
	(107, 'Cooler Master V850 Gold', '850W 80 Plus Gold, SFX', 159.99, 30, 1, 'cooler-master-v850-gold-106', NULL, '2025-12-05 22:30:44', 55),
	(108, 'NZXT C850', '850W 80 Plus Gold, modular', 144.99, 42, 1, 'nzxt-c850-107', NULL, '2025-12-05 22:30:44', 55),
	(109, 'ASUS ROG Strix 750G', '750W 80 Plus Gold, Aura Sync', 159.99, 33, 1, 'asus-rog-strix-750g-108', NULL, '2025-12-05 22:30:44', 55),
	(110, 'FSP Hydro G Pro 1000W', '1000W 80 Plus Gold, modular', 179.99, 28, 1, 'fsp-hydro-g-pro-1000w-109', NULL, '2025-12-05 22:30:44', 55),
	(111, 'SilverStone DA850', '850W 80 Plus Gold, semi-modular', 129.99, 40, 1, 'silverstone-da850-110', NULL, '2025-12-05 22:30:44', 55),
	(112, 'Corsair CX650M', '650W 80 Plus Bronze, semi-modular', 84.99, 60, 1, 'corsair-cx650m-111', NULL, '2025-12-05 22:30:44', 55),
	(113, 'EVGA 600 BR', '600W 80 Plus Bronze, básica', 59.99, 80, 1, 'evga-600-br-112', NULL, '2025-12-05 22:30:44', 55),
	(114, 'Thermaltake Smart 500W', '500W 80 Plus White', 49.99, 100, 1, 'thermaltake-smart-500w-113', NULL, '2025-12-05 22:30:44', 55),
	(115, 'be quiet! System Power 9 600W', '600W 80 Plus Bronze', 69.99, 70, 1, 'be-quiet-system-power-9-600w-114', NULL, '2025-12-05 22:30:44', 55),
	(116, 'Cooler Master MWE 750', '750W 80 Plus Bronze', 89.99, 55, 1, 'cooler-master-mwe-750-115', NULL, '2025-12-05 22:30:44', 55),
	(117, 'SeaSonic PRIME TX-1000', '1000W 80 Plus Titanium', 299.99, 18, 1, 'seasonic-prime-tx-1000-116', NULL, '2025-12-05 22:30:44', 55),
	(118, 'Phanteks AMP 750W', '750W 80 Plus Gold', 119.99, 48, 1, 'phanteks-amp-750w-117', NULL, '2025-12-05 22:30:44', 55),
	(119, 'Super Flower Leadex III 850W', '850W 80 Plus Gold', 139.99, 36, 1, 'super-flower-leadex-iii-850w-118', NULL, '2025-12-05 22:30:44', 55),
	(120, 'Gigabyte P850GM', '850W 80 Plus Gold', 119.99, 44, 1, 'gigabyte-p850gm-119', NULL, '2025-12-05 22:30:44', 55),
	(121, 'Antec Earthwatts Gold Pro 750W', '750W 80 Plus Gold', 124.99, 39, 1, 'antec-earthwatts-gold-pro-750w-120', NULL, '2025-12-05 22:30:44', 55),
	(122, 'NZXT H9 Flow', 'Mid-tower, dual chamber, tempered glass', 149.99, 35, 1, 'nzxt-h9-flow-121', NULL, '2025-12-05 22:30:44', 56),
	(123, 'Lian Li O11 Dynamic EVO', 'Mid-tower, modular, triple chamber', 169.99, 28, 1, 'lian-li-o11-dynamic-evo-122', NULL, '2025-12-05 22:30:44', 56),
	(124, 'Corsair 4000D Airflow', 'Mid-tower, mesh front, excellent airflow', 104.99, 50, 1, 'corsair-4000d-airflow-123', NULL, '2025-12-05 22:30:44', 56),
	(125, 'Fractal Design North', 'Mid-tower, wood accents, mesh front', 149.99, 32, 1, 'fractal-design-north-124', NULL, '2025-12-05 22:30:44', 56),
	(126, 'Phanteks Eclipse G360A', 'Mid-tower, RGB fans, mesh front', 99.99, 45, 1, 'phanteks-eclipse-g360a-125', NULL, '2025-12-05 22:30:44', 56),
	(127, 'Cooler Master MasterBox TD500', 'Mid-tower, mesh front, 3x ARGB fans', 109.99, 40, 1, 'cooler-master-masterbox-td500-126', NULL, '2025-12-05 22:30:44', 56),
	(128, 'HYTE Y60', 'Mid-tower, corner glass, unique design', 199.99, 22, 1, 'hyte-y60-127', NULL, '2025-12-05 22:30:44', 56),
	(129, 'NZXT H5 Flow', 'Compact mid-tower, great airflow', 94.99, 55, 1, 'nzxt-h5-flow-128', NULL, '2025-12-05 22:30:44', 56),
	(130, 'Lian Li Lancool 216', 'Mid-tower, includes 2x160mm fans', 99.99, 48, 1, 'lian-li-lancool-216-129', NULL, '2025-12-05 22:30:44', 56),
	(131, 'Corsair iCUE 5000T RGB', 'Mid-tower, premium, extensive RGB', 349.99, 15, 1, 'corsair-icue-5000t-rgb-130', NULL, '2025-12-05 22:30:44', 56),
	(132, 'Fractal Design Pop Air', 'Mid-tower, vibrant colors, mesh front', 89.99, 60, 1, 'fractal-design-pop-air-131', NULL, '2025-12-05 22:30:44', 56),
	(133, 'be quiet! Pure Base 500DX', 'Mid-tower, silent, RGB light strip', 109.99, 42, 1, 'be-quiet-pure-base-500dx-132', NULL, '2025-12-05 22:30:44', 56),
	(134, 'Thermaltake View 51', 'Full-tower, dual chamber, tempered glass', 199.99, 25, 1, 'thermaltake-view-51-133', NULL, '2025-12-05 22:30:44', 56),
	(135, 'Cooler Master HAF 700 EVO', 'Full-tower, extreme airflow, RGB', 299.99, 18, 1, 'cooler-master-haf-700-evo-134', NULL, '2025-12-05 22:30:44', 56),
	(136, 'NZXT H7 Flow', 'Mid-tower, 7 fan mounts, clean look', 129.99, 38, 1, 'nzxt-h7-flow-135', NULL, '2025-12-05 22:30:44', 56),
	(137, 'Phanteks Enthoo Pro 2', 'Full-tower, dual system support', 169.99, 30, 1, 'phanteks-enthoo-pro-2-136', NULL, '2025-12-05 22:30:44', 56),
	(138, 'Lian Li PC-O11 Dynamic', 'Mid-tower, dual chamber, tempered glass', 149.99, 34, 1, 'lian-li-pc-o11-dynamic-137', NULL, '2025-12-05 22:30:44', 56),
	(139, 'Corsair Crystal 680X', 'Mid-tower, dual chamber, RGB', 249.99, 26, 1, 'corsair-crystal-680x-138', NULL, '2025-12-05 22:30:44', 56),
	(140, 'Fractal Design Meshify 2', 'Mid-tower, mesh front, modular', 149.99, 33, 1, 'fractal-design-meshify-2-139', NULL, '2025-12-05 22:30:44', 56),
	(141, 'Cooler Master MasterCase H500', 'Mid-tower, 2x200mm ARGB fans', 139.99, 36, 1, 'cooler-master-mastercase-h500-140', NULL, '2025-12-05 22:30:44', 56),
	(142, 'Logitech G Pro X', 'Teclado mecánico para gaming, switches intercambiables', 149.99, 50, 1, 'logitech-g-pro-x-141', NULL, '2025-12-05 22:30:44', 57),
	(143, 'Razer BlackWidow V3', 'Teclado mecánico con switches Razer Green', 129.99, 45, 1, 'razer-blackwidow-v3-142', NULL, '2025-12-05 22:30:44', 57),
	(144, 'Corsair K70 RGB MK.2', 'Teclado mecánico con teclas Cherry MX Speed', 159.99, 40, 1, 'corsair-k70-rgb-mk2-143', NULL, '2025-12-05 22:30:44', 57),
	(145, 'SteelSeries Apex Pro', 'Teclado mecánico con actuación ajustable', 199.99, 30, 1, 'steelseries-apex-pro-144', NULL, '2025-12-05 22:30:44', 57),
	(146, 'HyperX Alloy Origins', 'Teclado mecánico con switches HyperX Red', 109.99, 55, 1, 'hyperx-alloy-origins-145', NULL, '2025-12-05 22:30:44', 57),
	(147, 'Keychron K2', 'Teclado mecánico inalámbrico, 75% layout', 89.99, 60, 1, 'keychron-k2-146', NULL, '2025-12-05 22:30:44', 57),
	(148, 'Ducky One 3', 'Teclado mecánico con keycaps PBT', 119.99, 42, 1, 'ducky-one-3-147', NULL, '2025-12-05 22:30:44', 57),
	(149, 'ASUS ROG Strix Scope', 'Teclado mecánico con switch RX Red', 129.99, 48, 1, 'asus-rog-strix-scope-148', NULL, '2025-12-05 22:30:44', 57),
	(150, 'Roccat Vulcan 122 Aimo', 'Teclado mecánico con teclas Titan Switch', 149.99, 36, 1, 'roccat-vulcan-122-aimo-149', NULL, '2025-12-05 22:30:44', 57),
	(151, 'Glorious GMMK 2', 'Teclado mecánico hot-swappable, 96%', 129.99, 44, 0, 'glorious-gmmk-2-150', NULL, '2025-12-05 22:30:44', 57),
	(152, 'Cooler Master CK550', 'Teclado mecánico con switches Gateron', 79.99, 65, 1, 'cooler-master-ck550-151', NULL, '2025-12-05 22:30:44', 57),
	(153, 'Epomaker TH80', 'Teclado mecánico 75% inalámbrico', 99.99, 52, 1, 'epomaker-th80-152', NULL, '2025-12-05 22:30:44', 57),
	(154, 'Akko 3068B', 'Teclado mecánico 65% con switches Akko CS', 89.99, 58, 1, 'akko-3068b-153', NULL, '2025-12-05 22:30:44', 57),
	(155, 'Varmilo VA108M', 'Teclado mecánico full-size con keycaps dye-sublimated', 169.99, 32, 1, 'varmilo-va108m-154', NULL, '2025-12-05 22:30:44', 57),
	(156, 'Leopold FC750R', 'Teclado mecánico con switches Cherry MX, minimalista', 139.99, 38, 1, 'leopold-fc750r-155', NULL, '2025-12-05 22:30:44', 57),
	(157, 'Wooting 60HE', 'Teclado mecánico analógico, 60%', 174.99, 28, 1, 'wooting-60he-156', NULL, '2025-12-05 22:30:44', 57),
	(158, 'Royal Kludge RK84', 'Teclado mecánico 75% inalámbrico, hot-swap', 89.00, 62, 1, 'royal-kludge-rk84-157', NULL, '2025-12-05 22:30:44', 57);

-- Volcando estructura para tabla web2.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `activo` tinyint(1) DEFAULT '1',
  `admin` int DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla web2.usuarios: ~2 rows (aproximadamente) CorreoAdmin - pass :admin | CorreoUsuario - pass:1234
INSERT INTO `usuarios` (`id`, `email`, `contraseña`, `activo`, `admin`) VALUES
	(1, 'correoAdmin@gmail.com', '$2y$10$8bqJFQ8kHXgS7..lzeiM2ujsymSalNCiv.6nDi280CNuuMVO1.qce', 1, 1),
	(2, 'correoUsuario@gmail.com', '$2y$10$SCazFZqqfqm4eZYRdKATpewI7/N2gSnFbP5JUpID0NjgoddfAkJWa', 1, 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
