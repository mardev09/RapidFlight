-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.32-MariaDB - mariadb.org binary distribution
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

DROP DATABASE IF EXISTS rapidflight;

-- Volcando estructura de base de datos para rapidflight
CREATE DATABASE IF NOT EXISTS `rapidflight` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci */;
USE `rapidflight`;

-- Volcando estructura para tabla rapidflight.ciudad
CREATE TABLE IF NOT EXISTS `ciudad` (
  `iata` char(3) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `aeropuerto` varchar(150) NOT NULL,
  `provincia` varchar(100) NOT NULL,
  `pais` varchar(50) NOT NULL,
  PRIMARY KEY (`iata`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- Volcando datos para la tabla rapidflight.ciudad: ~45 rows (aproximadamente)
INSERT INTO `ciudad` (`iata`, `ciudad`, `aeropuerto`, `provincia`, `pais`) VALUES
	('ABC', 'Albacete', 'Albacete-Los Llanos Airport', 'Albacete', 'España'),
	('ACE', 'Lanzarote', 'Lanzarote Airport', 'Las Palmas', 'España'),
	('AGP', 'Málaga', 'Málaga-Costa del Sol Airport', 'Málaga', 'España'),
	('ALC', 'Alicante', 'Alicante-Elche Miguel Hernández Airport', 'Alicante', 'España'),
	('BCN', 'Barcelona', 'Josep Tarradellas Barcelona-El Prat Airport', 'Barcelona', 'España'),
	('BIO', 'Bilbao', 'Bilbao Airport', 'Bizkaia', 'España'),
	('BJZ', 'Badajoz', 'Badajoz Airport', 'Badajoz', 'España'),
	('CDT', 'Castellón de la Plana', 'Castellón-Costa Azahar Airport', 'Castellón', 'España'),
	('EAS', 'San Sebastián', 'San Sebastián Airport', 'Gipuzkoa', 'España'),
	('ECV', 'Cuatro Vientos', 'Cuatro Vientos Airport', 'Madrid', 'España'),
	('FUE', 'Fuerteventura', 'Fuerteventura Airport', 'Las Palmas', 'España'),
	('GMZ', 'La Gomera', 'La Gomera Airport', 'Santa Cruz de Tenerife', 'España'),
	('GRO', 'Girona', 'Girona-Costa Brava Airport', 'Girona', 'España'),
	('GRX', 'Granada', 'Federico García Lorca Granada Airport', 'Granada', 'España'),
	('HSK', 'Huesca', 'Huesca-Pirineos Airport', 'Huesca', 'España'),
	('IBZ', 'Ibiza', 'Ibiza Airport', 'Illes Balears', 'España'),
	('ILD', 'Lleida', 'Lleida-Alguaire Airport', 'Lleida', 'España'),
	('LCG', 'A Coruña', 'A Coruña Airport', 'A Coruña', 'España'),
	('LEI', 'Almería', 'Almería Airport', 'Almería', 'España'),
	('LEN', 'León', 'León Airport', 'León', 'España'),
	('LPA', 'Gran Canaria', 'Gran Canaria Airport', 'Las Palmas', 'España'),
	('MAD', 'Madrid', 'Adolfo Suárez Madrid–Barajas Airport', 'Madrid', 'España'),
	('MAH', 'Menorca', 'Menorca Airport', 'Illes Balears', 'España'),
	('MLN', 'Melilla', 'Melilla Airport', 'Melilla', 'España'),
	('ODB', 'Córdoba', 'Córdoba Airport', 'Córdoba', 'España'),
	('OVD', 'Asturias', 'Asturias Airport', 'Asturias', 'España'),
	('PMI', 'Palma de Mallorca', 'Palma de Mallorca Airport', 'Illes Balears', 'España'),
	('PNA', 'Pamplona', 'Pamplona Airport', 'Navarra', 'España'),
	('REU', 'Reus', 'Reus Airport', 'Tarragona', 'España'),
	('RGS', 'Burgos', 'Burgos Airport', 'Burgos', 'España'),
	('RMU', 'Murcia', 'Región de Murcia International Airport', 'Murcia', 'España'),
	('SCQ', 'Santiago de Compostela', 'Santiago de Compostela Airport', 'A Coruña', 'España'),
	('SDR', 'Santander', 'Santander Airport', 'Cantabria', 'España'),
	('SLM', 'Salamanca', 'Salamanca Airport', 'Salamanca', 'España'),
	('SPC', 'La Palma', 'La Palma Airport', 'Santa Cruz de Tenerife', 'España'),
	('SVQ', 'Sevilla', 'Sevilla Airport', 'Sevilla', 'España'),
	('TFN', 'Tenerife (Norte)', 'Tenerife North Airport', 'Santa Cruz de Tenerife', 'España'),
	('TFS', 'Tenerife (Sur)', 'Tenerife South Airport', 'Santa Cruz de Tenerife', 'España'),
	('VDE', 'El Hierro', 'El Hierro Airport', 'Santa Cruz de Tenerife', 'España'),
	('VGO', 'Vigo', 'Vigo Airport', 'Pontevedra', 'España'),
	('VIT', 'Vitoria-Gasteiz', 'Vitoria Airport', 'Álava', 'España'),
	('VLC', 'Valencia', 'Valencia Airport', 'Valencia', 'España'),
	('VLL', 'Valladolid', 'Valladolid Airport', 'Valladolid', 'España'),
	('XRY', 'Jerez de la Frontera', 'Jerez Airport', 'Cádiz', 'España'),
	('ZAZ', 'Zaragoza', 'Zaragoza Airport', 'Zaragoza', 'España');

-- Volcando estructura para tabla rapidflight.reserva
CREATE TABLE IF NOT EXISTS `reserva` (
  `idReserva` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(100) NOT NULL,
  `origen` char(3) NOT NULL,
  `destino` char(3) NOT NULL,
  `fechaHoraSalida` datetime NOT NULL,
  `fechaHoraLlegada` datetime NOT NULL,
  `numBillete` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`idReserva`),
  KEY `usuario` (`usuario`),
  KEY `origen` (`origen`),
  KEY `destino` (`destino`),
  CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`email`),
  CONSTRAINT `reserva_ibfk_2` FOREIGN KEY (`origen`) REFERENCES `ciudad` (`iata`),
  CONSTRAINT `reserva_ibfk_3` FOREIGN KEY (`destino`) REFERENCES `ciudad` (`iata`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- Volcando datos para la tabla rapidflight.reserva: ~0 rows (aproximadamente)

-- Volcando estructura para tabla rapidflight.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `email` varchar(100) NOT NULL DEFAULT '',
  `password` char(60) NOT NULL DEFAULT '',
  PRIMARY KEY (`email`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- Volcando datos para la tabla rapidflight.usuario: ~1 rows (aproximadamente)
INSERT INTO `usuario` (`email`, `password`) VALUES
	('omar@gmail.com', '$2y$10$VrGy60NWCnZUd0hzXsnpCu90Ul89ub1pOt52QeFD14kyAWtoPGP0O');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
