-- --------------------------------------------------------
-- Host:                         z5zm8hebixwywy9d.cbetxkdyhwsb.us-east-1.rds.amazonaws.com
-- Versión del servidor:         8.0.20 - Source distribution
-- SO del servidor:              Linux
-- HeidiSQL Versión:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para qqjlv5512bb91fm3
CREATE DATABASE IF NOT EXISTS `qqjlv5512bb91fm3` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `qqjlv5512bb91fm3`;

-- Volcando estructura para tabla qqjlv5512bb91fm3.libros
CREATE TABLE IF NOT EXISTS `libros` (
  `id_libro` int unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) DEFAULT NULL,
  `autor` varchar(50) DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `fecha_pub` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `cantidad` int DEFAULT NULL,
  PRIMARY KEY (`id_libro`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla qqjlv5512bb91fm3.libros: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `libros` DISABLE KEYS */;
REPLACE INTO `libros` (`id_libro`, `titulo`, `autor`, `categoria`, `fecha_pub`, `cantidad`) VALUES
	(1, 'El nombre del viento', 'Patrick Rothfuss', 'Ciencia Ficción', '2010-02-20 00:00:00', 45),
	(2, 'Harry Potter y el caliz de fuego', 'J.K. Rowlling', 'Ciencia Ficción', '2021-02-26 07:18:51', 9),
	(5, 'El temor de un hombre sabio', 'Pat Rot', 'Ciencia Magica', '2021-02-26 07:18:30', 11);
/*!40000 ALTER TABLE `libros` ENABLE KEYS */;

-- Volcando estructura para tabla qqjlv5512bb91fm3.prestamo
CREATE TABLE IF NOT EXISTS `prestamo` (
  `id_prestamo` int NOT NULL AUTO_INCREMENT,
  `fecha_prestamo` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_libro` int DEFAULT NULL,
  `id_usuario` int DEFAULT NULL,
  `activo` tinyint DEFAULT NULL,
  PRIMARY KEY (`id_prestamo`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla qqjlv5512bb91fm3.prestamo: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `prestamo` DISABLE KEYS */;
REPLACE INTO `prestamo` (`id_prestamo`, `fecha_prestamo`, `id_libro`, `id_usuario`, `activo`) VALUES
	(18, NULL, 2, 7, 0),
	(19, NULL, 1, 7, 0),
	(20, NULL, 1, 7, 1),
	(21, NULL, 1, 7, 1),
	(22, NULL, 1, 7, 1),
	(23, NULL, 2, 7, 1),
	(24, NULL, 1, 9, 0),
	(25, '2021-02-26 07:18:29', 5, 8, 0),
	(26, '2021-02-26 07:18:22', 5, 8, 1),
	(27, '2021-02-26 07:18:51', 2, 8, 0);
/*!40000 ALTER TABLE `prestamo` ENABLE KEYS */;

-- Volcando estructura para tabla qqjlv5512bb91fm3.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `nivel` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla qqjlv5512bb91fm3.usuarios: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
REPLACE INTO `usuarios` (`id_usuario`, `nombre`, `password`, `email`, `nivel`) VALUES
	(1, 'asd', 'asd', NULL, 0),
	(2, 'asd', 'f10e2821bbbea527ea02200352313bc059445190', '', 1),
	(3, '', '85136c79cbf9fe36bb9d05d0639c70c265c18d37', 'asd@hotmail.com', 1),
	(4, 'adasd', '85136c79cbf9fe36bb9d05d0639c70c265c18d37', 'asd@hotmail.com', 1),
	(5, 'asdasdsa', '85136c79cbf9fe36bb9d05d0639c70c265c18d37', 'asdasdsa@hotmail.com', 1),
	(6, 'Raul Eduardo', '2891baceeef1652ee698294da0e71ba78a2a4064', 'eduardo.amata.cs@gmail.com', 1),
	(7, 'corona', '2891baceeef1652ee698294da0e71ba78a2a4064', 'email.com', 1),
	(8, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', 1),
	(9, 'standar', 'd8ecf4af0173462181b63428d9e989291e5f99d1', 'standar', 0);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
