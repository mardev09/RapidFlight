/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP DATABASE IF EXISTS `rapidflight`;

CREATE DATABASE IF NOT EXISTS `rapidflight` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci */;
USE `rapidflight`;

-- -----------------------------------------------------
-- Tabla: ciudad
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ciudad` (
  `iata`       CHAR(3)       NOT NULL,
  `ciudad`     VARCHAR(100)  NOT NULL,
  `aeropuerto` VARCHAR(150)  NOT NULL,
  `provincia`  VARCHAR(100)  NOT NULL,
  `pais`       VARCHAR(50)   NOT NULL,
  PRIMARY KEY (`iata`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO `ciudad` (`iata`, `ciudad`, `aeropuerto`, `provincia`, `pais`) VALUES
  ('ABC', 'Albacete',               'Albacete-Los Llanos Airport',                    'Albacete',               'España'),
  ('ACE', 'Lanzarote',              'Lanzarote Airport',                               'Las Palmas',             'España'),
  ('AGP', 'Málaga',                 'Málaga-Costa del Sol Airport',                    'Málaga',                 'España'),
  ('ALC', 'Alicante',               'Alicante-Elche Miguel Hernández Airport',         'Alicante',               'España'),
  ('BCN', 'Barcelona',              'Josep Tarradellas Barcelona-El Prat Airport',     'Barcelona',              'España'),
  ('BIO', 'Bilbao',                 'Bilbao Airport',                                  'Bizkaia',                'España'),
  ('BJZ', 'Badajoz',                'Badajoz Airport',                                 'Badajoz',                'España'),
  ('CDT', 'Castellón de la Plana',  'Castellón-Costa Azahar Airport',                  'Castellón',              'España'),
  ('EAS', 'San Sebastián',          'San Sebastián Airport',                           'Gipuzkoa',               'España'),
  ('ECV', 'Cuatro Vientos',         'Cuatro Vientos Airport',                          'Madrid',                 'España'),
  ('FUE', 'Fuerteventura',          'Fuerteventura Airport',                           'Las Palmas',             'España'),
  ('GMZ', 'La Gomera',              'La Gomera Airport',                               'Santa Cruz de Tenerife', 'España'),
  ('GRO', 'Girona',                 'Girona-Costa Brava Airport',                      'Girona',                 'España'),
  ('GRX', 'Granada',                'Federico García Lorca Granada Airport',           'Granada',                'España'),
  ('HSK', 'Huesca',                 'Huesca-Pirineos Airport',                         'Huesca',                 'España'),
  ('IBZ', 'Ibiza',                  'Ibiza Airport',                                   'Illes Balears',          'España'),
  ('ILD', 'Lleida',                 'Lleida-Alguaire Airport',                         'Lleida',                 'España'),
  ('LCG', 'A Coruña',               'A Coruña Airport',                                'A Coruña',               'España'),
  ('LEI', 'Almería',                'Almería Airport',                                 'Almería',                'España'),
  ('LEN', 'León',                   'León Airport',                                    'León',                   'España'),
  ('LPA', 'Gran Canaria',           'Gran Canaria Airport',                            'Las Palmas',             'España'),
  ('MAD', 'Madrid',                 'Adolfo Suárez Madrid–Barajas Airport',            'Madrid',                 'España'),
  ('MAH', 'Menorca',                'Menorca Airport',                                 'Illes Balears',          'España'),
  ('MLN', 'Melilla',                'Melilla Airport',                                 'Melilla',                'España'),
  ('ODB', 'Córdoba',                'Córdoba Airport',                                 'Córdoba',                'España'),
  ('OVD', 'Asturias',               'Asturias Airport',                                'Asturias',               'España'),
  ('PMI', 'Palma de Mallorca',      'Palma de Mallorca Airport',                       'Illes Balears',          'España'),
  ('PNA', 'Pamplona',               'Pamplona Airport',                                'Navarra',                'España'),
  ('REU', 'Reus',                   'Reus Airport',                                    'Tarragona',              'España'),
  ('RGS', 'Burgos',                 'Burgos Airport',                                  'Burgos',                 'España'),
  ('RMU', 'Murcia',                 'Región de Murcia International Airport',          'Murcia',                 'España'),
  ('SCQ', 'Santiago de Compostela', 'Santiago de Compostela Airport',                  'A Coruña',               'España'),
  ('SDR', 'Santander',              'Santander Airport',                               'Cantabria',              'España'),
  ('SLM', 'Salamanca',              'Salamanca Airport',                               'Salamanca',              'España'),
  ('SPC', 'La Palma',               'La Palma Airport',                                'Santa Cruz de Tenerife', 'España'),
  ('SVQ', 'Sevilla',                'Sevilla Airport',                                 'Sevilla',                'España'),
  ('TFN', 'Tenerife (Norte)',        'Tenerife North Airport',                          'Santa Cruz de Tenerife', 'España'),
  ('TFS', 'Tenerife (Sur)',          'Tenerife South Airport',                          'Santa Cruz de Tenerife', 'España'),
  ('VDE', 'El Hierro',              'El Hierro Airport',                               'Santa Cruz de Tenerife', 'España'),
  ('VGO', 'Vigo',                   'Vigo Airport',                                    'Pontevedra',             'España'),
  ('VIT', 'Vitoria-Gasteiz',        'Vitoria Airport',                                 'Álava',                  'España'),
  ('VLC', 'Valencia',               'Valencia Airport',                                'Valencia',               'España'),
  ('VLL', 'Valladolid',             'Valladolid Airport',                              'Valladolid',             'España'),
  ('XRY', 'Jerez de la Frontera',   'Jerez Airport',                                   'Cádiz',                  'España'),
  ('ZAZ', 'Zaragoza',               'Zaragoza Airport',                                'Zaragoza',               'España');

-- -----------------------------------------------------
-- Tabla: usuario
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `usuario` (
  `email`           VARCHAR(100)  NOT NULL DEFAULT '',
  `password`        CHAR(60)      NOT NULL DEFAULT '',
  `nombre`          VARCHAR(100)  DEFAULT NULL,
  `apellidos`       VARCHAR(150)  DEFAULT NULL,
  `fechaNacimiento` DATE          DEFAULT NULL,
  `telefono`        VARCHAR(20)   DEFAULT NULL,
  `direccion`       VARCHAR(255)  DEFAULT NULL,
  `ciudad`          VARCHAR(100)  DEFAULT NULL,
  `codigoPostal`    VARCHAR(10)   DEFAULT NULL,
  `pais`            VARCHAR(100)  DEFAULT 'España',
  `nacionalidad`    VARCHAR(100)  DEFAULT NULL,
  `pasaporte`       VARCHAR(50)   DEFAULT NULL,
  `puntos`          INT           DEFAULT 0,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO `usuario` (`email`, `password`) VALUES
  ('omar@gmail.com', '$2y$10$VrGy60NWCnZUd0hzXsnpCu90Ul89ub1pOt52QeFD14kyAWtoPGP0O');

-- -----------------------------------------------------
-- Tabla: vuelo
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `vuelo` (
  `idVuelo`               INT            NOT NULL AUTO_INCREMENT,
  `numeroVuelo`           VARCHAR(20)    NOT NULL,
  `aerolinea`             VARCHAR(100)   NOT NULL,
  `origen`                CHAR(3)        NOT NULL,
  `destino`               CHAR(3)        NOT NULL,
  `fechaSalida`           DATE           NOT NULL,
  `horaSalida`            TIME           NOT NULL,
  `fechaLlegada`          DATE           NOT NULL,
  `horaLlegada`           TIME           NOT NULL,
  `precio`                DECIMAL(10,2)  NOT NULL,
  `duracionMinutos`       INT            NOT NULL,
  `escalas`               INT            DEFAULT 0,
  `equipajeManoIncluido`  BOOLEAN        DEFAULT 1,
  `plazasDisponibles`     INT            DEFAULT 150,
  `activo`                BOOLEAN        DEFAULT 1,
  PRIMARY KEY (`idVuelo`),
  CONSTRAINT `vuelo_ibfk_1` FOREIGN KEY (`origen`)  REFERENCES `ciudad` (`iata`),
  CONSTRAINT `vuelo_ibfk_2` FOREIGN KEY (`destino`) REFERENCES `ciudad` (`iata`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO `vuelo` (`numeroVuelo`, `aerolinea`, `origen`, `destino`, `fechaSalida`, `horaSalida`, `fechaLlegada`, `horaLlegada`, `precio`, `duracionMinutos`, `escalas`, `equipajeManoIncluido`) VALUES
  ('IB3401', 'Iberia',         'MAD', 'BCN', CURRENT_DATE + INTERVAL 1 DAY, '07:00:00', CURRENT_DATE + INTERVAL 1 DAY, '08:15:00',  45.50, 75,  0, 1),
  ('VY1002', 'Vueling',        'BCN', 'MAD', CURRENT_DATE + INTERVAL 1 DAY, '09:30:00', CURRENT_DATE + INTERVAL 1 DAY, '10:55:00',  39.99, 85,  0, 0),
  ('RY5521', 'Ryanair',        'MAD', 'PMI', CURRENT_DATE + INTERVAL 2 DAY, '14:20:00', CURRENT_DATE + INTERVAL 2 DAY, '15:40:00',  22.99, 80,  0, 0),
  ('UX4022', 'Air Europa',     'MAD', 'LPA', CURRENT_DATE + INTERVAL 3 DAY, '11:00:00', CURRENT_DATE + INTERVAL 3 DAY, '12:50:00', 120.00, 170, 0, 1),
  ('IB3830', 'Iberia',         'MAD', 'TFN', CURRENT_DATE + INTERVAL 4 DAY, '16:45:00', CURRENT_DATE + INTERVAL 4 DAY, '18:40:00', 145.50, 175, 0, 1),
  ('VY2201', 'Vueling',        'BIO', 'SVQ', CURRENT_DATE + INTERVAL 2 DAY, '08:10:00', CURRENT_DATE + INTERVAL 2 DAY, '09:40:00',  55.00, 90,  0, 1),
  ('RY6671', 'Ryanair',        'VLC', 'IBZ', CURRENT_DATE + INTERVAL 5 DAY, '20:00:00', CURRENT_DATE + INTERVAL 5 DAY, '20:45:00',  19.99, 45,  0, 0),
  ('IB8821', 'Iberia Express', 'MAD', 'ACE', CURRENT_DATE + INTERVAL 6 DAY, '10:00:00', CURRENT_DATE + INTERVAL 6 DAY, '11:55:00',  98.40, 175, 0, 1),
  ('NT3301', 'Binter',         'TFN', 'LPA', CURRENT_DATE + INTERVAL 1 DAY, '08:00:00', CURRENT_DATE + INTERVAL 1 DAY, '08:30:00',  35.00, 30,  0, 1),
  ('NT3302', 'Binter',         'LPA', 'TFN', CURRENT_DATE + INTERVAL 1 DAY, '18:00:00', CURRENT_DATE + INTERVAL 1 DAY, '18:30:00',  35.00, 30,  0, 1),
  ('VY3321', 'Vueling',        'BCN', 'AGP', CURRENT_DATE + INTERVAL 3 DAY, '12:15:00', CURRENT_DATE + INTERVAL 3 DAY, '13:55:00',  62.99, 100, 0, 1),
  ('RY1122', 'Ryanair',        'AGP', 'BCN', CURRENT_DATE + INTERVAL 4 DAY, '15:30:00', CURRENT_DATE + INTERVAL 4 DAY, '17:10:00',  45.00, 100, 0, 0),
  ('IB5501', 'Iberia',         'MAD', 'SCQ', CURRENT_DATE + INTERVAL 7 DAY, '09:15:00', CURRENT_DATE + INTERVAL 7 DAY, '10:30:00',  78.50, 75,  0, 1),
  ('VY8811', 'Vueling',        'SCQ', 'AGP', CURRENT_DATE + INTERVAL 8 DAY, '11:00:00', CURRENT_DATE + INTERVAL 8 DAY, '12:50:00',  89.99, 110, 1, 1),
  ('UX9921', 'Air Europa',     'MAD', 'VGO', CURRENT_DATE + INTERVAL 2 DAY, '19:30:00', CURRENT_DATE + INTERVAL 2 DAY, '20:40:00',  65.00, 70,  0, 1),
  ('IB2201', 'Iberia',         'ALC', 'MAD', CURRENT_DATE + INTERVAL 5 DAY, '07:45:00', CURRENT_DATE + INTERVAL 5 DAY, '08:50:00',  58.20, 65,  0, 1),
  ('RY4411', 'Ryanair',        'SDR', 'MAD', CURRENT_DATE + INTERVAL 3 DAY, '14:00:00', CURRENT_DATE + INTERVAL 3 DAY, '15:10:00',  32.50, 70,  0, 0),
  ('VY7701', 'Vueling',        'OVD', 'BCN', CURRENT_DATE + INTERVAL 6 DAY, '10:20:00', CURRENT_DATE + INTERVAL 6 DAY, '11:45:00',  72.00, 85,  0, 1),
  ('IB4412', 'Iberia',         'MAD', 'GRX', CURRENT_DATE + INTERVAL 4 DAY, '16:00:00', CURRENT_DATE + INTERVAL 4 DAY, '17:05:00',  85.90, 65,  0, 1),
  ('VY9922', 'Vueling',        'BCN', 'BIO', CURRENT_DATE + INTERVAL 2 DAY, '18:15:00', CURRENT_DATE + INTERVAL 2 DAY, '19:30:00',  49.99, 75,  0, 1),
  ('IB3402', 'Iberia',         'MAD', 'BCN', CURRENT_DATE + INTERVAL 1 DAY, '18:00:00', CURRENT_DATE + INTERVAL 1 DAY, '19:15:00',  55.50, 75,  0, 1),
  ('VY1003', 'Vueling',        'BCN', 'MAD', CURRENT_DATE + INTERVAL 1 DAY, '20:30:00', CURRENT_DATE + INTERVAL 1 DAY, '21:55:00',  49.99, 85,  0, 0),
  ('RY5522', 'Ryanair',        'MAD', 'PMI', CURRENT_DATE + INTERVAL 3 DAY, '09:20:00', CURRENT_DATE + INTERVAL 3 DAY, '10:40:00',  32.99, 80,  0, 0),
  ('UX4023', 'Air Europa',     'MAD', 'LPA', CURRENT_DATE + INTERVAL 5 DAY, '15:00:00', CURRENT_DATE + INTERVAL 5 DAY, '16:50:00', 140.00, 170, 0, 1),
  ('IB3831', 'Iberia',         'MAD', 'TFN', CURRENT_DATE + INTERVAL 6 DAY, '08:45:00', CURRENT_DATE + INTERVAL 6 DAY, '10:40:00', 125.50, 175, 0, 1),
  ('VY2202', 'Vueling',        'BIO', 'SVQ', CURRENT_DATE + INTERVAL 4 DAY, '14:10:00', CURRENT_DATE + INTERVAL 4 DAY, '15:40:00',  65.00, 90,  0, 1),
  ('RY6672', 'Ryanair',        'VLC', 'IBZ', CURRENT_DATE + INTERVAL 7 DAY, '10:00:00', CURRENT_DATE + INTERVAL 7 DAY, '10:45:00',  29.99, 45,  0, 0),
  ('IB8822', 'Iberia Express', 'MAD', 'ACE', CURRENT_DATE + INTERVAL 8 DAY, '16:00:00', CURRENT_DATE + INTERVAL 8 DAY, '17:55:00', 118.40, 175, 0, 1),
  ('NT3303', 'Binter',         'TFN', 'SPC', CURRENT_DATE + INTERVAL 2 DAY, '09:00:00', CURRENT_DATE + INTERVAL 2 DAY, '09:30:00',  38.00, 30,  0, 1),
  ('NT3304', 'Binter',         'SPC', 'TFN', CURRENT_DATE + INTERVAL 2 DAY, '17:00:00', CURRENT_DATE + INTERVAL 2 DAY, '17:30:00',  38.00, 30,  0, 1),
  ('VY3322', 'Vueling',        'BCN', 'MAH', CURRENT_DATE + INTERVAL 5 DAY, '13:15:00', CURRENT_DATE + INTERVAL 5 DAY, '14:00:00',  52.99, 45,  0, 1),
  ('RY1123', 'Ryanair',        'MAH', 'BCN', CURRENT_DATE + INTERVAL 6 DAY, '16:30:00', CURRENT_DATE + INTERVAL 6 DAY, '17:15:00',  42.00, 45,  0, 0),
  ('IB5502', 'Iberia',         'MAD', 'VLL', CURRENT_DATE + INTERVAL 2 DAY, '11:15:00', CURRENT_DATE + INTERVAL 2 DAY, '12:05:00',  68.50, 50,  0, 1),
  ('VY8812', 'Vueling',        'VLL', 'BCN', CURRENT_DATE + INTERVAL 3 DAY, '11:00:00', CURRENT_DATE + INTERVAL 3 DAY, '12:15:00',  79.99, 75,  0, 1),
  ('UX9922', 'Air Europa',     'MAD', 'LCG', CURRENT_DATE + INTERVAL 4 DAY, '18:30:00', CURRENT_DATE + INTERVAL 4 DAY, '19:40:00',  85.00, 70,  0, 1),
  ('IB2202', 'Iberia',         'LCG', 'MAD', CURRENT_DATE + INTERVAL 5 DAY, '08:45:00', CURRENT_DATE + INTERVAL 5 DAY, '09:55:00',  78.20, 70,  0, 1),
  ('RY4412', 'Ryanair',        'ZAZ', 'PMI', CURRENT_DATE + INTERVAL 5 DAY, '15:00:00', CURRENT_DATE + INTERVAL 5 DAY, '15:55:00',  28.50, 55,  0, 0),
  ('VY7702', 'Vueling',        'PMI', 'ZAZ', CURRENT_DATE + INTERVAL 7 DAY, '10:20:00', CURRENT_DATE + INTERVAL 7 DAY, '11:15:00',  62.00, 55,  0, 1),
  ('IB4413', 'Iberia',         'MAD', 'XRY', CURRENT_DATE + INTERVAL 2 DAY, '17:00:00', CURRENT_DATE + INTERVAL 2 DAY, '18:05:00',  95.90, 65,  0, 1),
  ('VY9923', 'Vueling',        'XRY', 'BCN', CURRENT_DATE + INTERVAL 4 DAY, '19:15:00', CURRENT_DATE + INTERVAL 4 DAY, '20:45:00',  89.99, 90,  1, 1),
  ('IB9001', 'Iberia',         'VGO', 'BCN', CURRENT_DATE + INTERVAL 2 DAY, '07:00:00', CURRENT_DATE + INTERVAL 2 DAY, '10:30:00', 115.50, 210, 1, 1),
  ('VY9002', 'Vueling',        'SCQ', 'PMI', CURRENT_DATE + INTERVAL 3 DAY, '08:00:00', CURRENT_DATE + INTERVAL 3 DAY, '12:00:00',  99.99, 240, 1, 0),
  ('RY9003', 'Ryanair',        'SDR', 'SVQ', CURRENT_DATE + INTERVAL 4 DAY, '09:00:00', CURRENT_DATE + INTERVAL 4 DAY, '13:00:00',  75.99, 240, 1, 0),
  ('UX9004', 'Air Europa',     'BIO', 'AGP', CURRENT_DATE + INTERVAL 5 DAY, '10:00:00', CURRENT_DATE + INTERVAL 5 DAY, '14:00:00', 130.00, 240, 1, 1),
  ('IB9005', 'Iberia',         'LPA', 'BCN', CURRENT_DATE + INTERVAL 6 DAY, '11:00:00', CURRENT_DATE + INTERVAL 6 DAY, '16:00:00', 180.50, 300, 1, 1),
  ('VY9006', 'Vueling',        'ACE', 'BIO', CURRENT_DATE + INTERVAL 7 DAY, '12:00:00', CURRENT_DATE + INTERVAL 7 DAY, '17:30:00', 145.00, 330, 1, 1),
  ('RY9007', 'Ryanair',        'VLC', 'LPA', CURRENT_DATE + INTERVAL 8 DAY, '13:00:00', CURRENT_DATE + INTERVAL 8 DAY, '17:00:00',  95.99, 240, 1, 0),
  ('IB9008', 'Iberia',         'GRX', 'BIO', CURRENT_DATE + INTERVAL 1 DAY, '14:00:00', CURRENT_DATE + INTERVAL 1 DAY, '17:30:00', 125.40, 210, 1, 1),
  ('NT9009', 'Binter',         'VGO', 'TFN', CURRENT_DATE + INTERVAL 2 DAY, '15:00:00', CURRENT_DATE + INTERVAL 2 DAY, '17:30:00', 155.00, 150, 0, 1),
  ('NT9010', 'Binter',         'ZAZ', 'TFN', CURRENT_DATE + INTERVAL 2 DAY, '16:00:00', CURRENT_DATE + INTERVAL 2 DAY, '18:45:00', 165.00, 165, 0, 1);

-- -----------------------------------------------------
-- Tabla: producto_tienda
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `producto_tienda` (
  `idProducto`       INT            NOT NULL AUTO_INCREMENT,
  `nombre`           VARCHAR(150)   NOT NULL,
  `descripcion`      TEXT,
  `tipo`             ENUM('descuento_vuelo', 'tarjeta_amazon') NOT NULL,
  `puntosRequeridos` INT            NOT NULL,
  `valor`            DECIMAL(10,2)  NOT NULL,
  `stock`            INT            DEFAULT -1,
  `activo`           BOOLEAN        DEFAULT 1,
  PRIMARY KEY (`idProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO `producto_tienda` (`nombre`, `descripcion`, `tipo`, `puntosRequeridos`, `valor`, `stock`) VALUES
  ('Descuento 5€ en vuelos',    'Cupón de descuento de 5€ aplicable en tu próxima reserva.',        'descuento_vuelo', 50,  5.00,  -1),
  ('Descuento 10€ en vuelos',   'Cupón de descuento de 10€ aplicable en tu próxima reserva.',       'descuento_vuelo', 100, 10.00, -1),
  ('Descuento 20€ en vuelos',   'Cupón de descuento de 20€ aplicable en tu próxima reserva.',       'descuento_vuelo', 200, 20.00, -1),
  ('Descuento 50€ en vuelos',   'Cupón de descuento de 50€ aplicable en tu próxima reserva.',       'descuento_vuelo', 500, 50.00, -1),
  ('Tarjeta Regalo Amazon 10€', 'Recibe un código de tarjeta regalo de Amazon por valor de 10€.',   'tarjeta_amazon',  150, 10.00, 50),
  ('Tarjeta Regalo Amazon 25€', 'Recibe un código de tarjeta regalo de Amazon por valor de 25€.',   'tarjeta_amazon',  350, 25.00, 25),
  ('Tarjeta Regalo Amazon 50€', 'Recibe un código de tarjeta regalo de Amazon por valor de 50€.',   'tarjeta_amazon',  700, 50.00, 10);

-- -----------------------------------------------------
-- Tabla: reserva  (depende de: ciudad, usuario, vuelo)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `reserva` (
  `idReserva`       INT            NOT NULL AUTO_INCREMENT,
  `usuario`         VARCHAR(100)   NOT NULL,
  `origen`          CHAR(3)        NOT NULL,
  `destino`         CHAR(3)        NOT NULL,
  `fechaHoraSalida` DATETIME       NOT NULL,
  `fechaHoraLlegada`DATETIME       NOT NULL,
  `numBillete`      VARCHAR(50)    NOT NULL DEFAULT '',
  `precio`          DECIMAL(10,2)  DEFAULT 0.00,
  `idVuelo`         INT            DEFAULT NULL,
  `estado`          ENUM('pendiente_pago', 'confirmada', 'cancelada') DEFAULT 'pendiente_pago',
  `puntosGanados`   INT            DEFAULT 0,
  PRIMARY KEY (`idReserva`),
  KEY `usuario` (`usuario`),
  KEY `origen`  (`origen`),
  KEY `destino` (`destino`),
  CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`usuario`)  REFERENCES `usuario`  (`email`),
  CONSTRAINT `reserva_ibfk_2` FOREIGN KEY (`origen`)   REFERENCES `ciudad`   (`iata`),
  CONSTRAINT `reserva_ibfk_3` FOREIGN KEY (`destino`)  REFERENCES `ciudad`   (`iata`),
  CONSTRAINT `fk_reserva_vuelo` FOREIGN KEY (`idVuelo`) REFERENCES `vuelo`   (`idVuelo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

INSERT INTO `reserva` (`idReserva`, `usuario`, `origen`, `destino`, `fechaHoraSalida`, `fechaHoraLlegada`, `numBillete`) VALUES
  (3,  'omar@gmail.com', 'MAD', 'PMI', '2025-05-12 10:15:00', '2025-05-12 11:35:00', 'RPF16227'),
  (4,  'omar@gmail.com', 'MAD', 'PMI', '2025-05-12 10:20:00', '2025-05-12 11:45:00', 'RPF66620'),
  (5,  'omar@gmail.com', 'MAD', 'PMI', '2025-05-12 21:45:00', '2025-05-12 23:05:00', 'RPF37693'),
  (6,  'omar@gmail.com', 'MAD', 'PMI', '2025-05-12 21:45:00', '2025-05-12 23:05:00', 'RPF69220'),
  (7,  'omar@gmail.com', 'MAD', 'PMI', '2025-05-12 21:45:00', '2025-05-12 23:05:00', 'RPF15108'),
  (8,  'omar@gmail.com', 'MAD', 'PMI', '2025-05-12 21:45:00', '2025-05-12 23:05:00', 'RPF50180'),
  (9,  'omar@gmail.com', 'MAD', 'PMI', '2025-05-12 21:45:00', '2025-05-12 23:05:00', 'RPF57001'),
  (10, 'omar@gmail.com', 'MAD', 'PMI', '2025-05-12 21:45:00', '2025-05-12 23:05:00', 'RPF83284'),
  (11, 'omar@gmail.com', 'MAD', 'PMI', '2025-05-12 21:45:00', '2025-05-12 23:05:00', 'RPF32665');

-- -----------------------------------------------------
-- Tabla: pago  (depende de: usuario, reserva)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pago` (
  `idPago`             INT            NOT NULL AUTO_INCREMENT,
  `idReserva`          INT            NOT NULL,
  `usuario`            VARCHAR(100)   NOT NULL,
  `monto`              DECIMAL(10,2)  NOT NULL,
  `metodoPago`         VARCHAR(50)    DEFAULT 'Tarjeta de Crédito',
  `numeroTarjeta`      VARCHAR(4)     NOT NULL,
  `nombreTitular`      VARCHAR(150)   NOT NULL,
  `fechaPago`          DATETIME       DEFAULT CURRENT_TIMESTAMP,
  `estado`             ENUM('pendiente', 'completado', 'fallido') DEFAULT 'completado',
  `codigoTransaccion`  VARCHAR(50)    NOT NULL,
  PRIMARY KEY (`idPago`),
  UNIQUE KEY `uq_codigoTransaccion` (`codigoTransaccion`),
  CONSTRAINT `fk_pago_usuario`  FOREIGN KEY (`usuario`)   REFERENCES `usuario` (`email`),
  CONSTRAINT `fk_pago_reserva`  FOREIGN KEY (`idReserva`) REFERENCES `reserva` (`idReserva`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- -----------------------------------------------------
-- Tabla: transaccion_puntos  (depende de: usuario, reserva, producto_tienda)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `transaccion_puntos` (
  `idTransaccion` INT           NOT NULL AUTO_INCREMENT,
  `usuario`       VARCHAR(100)  NOT NULL,
  `tipo`          ENUM('ganado', 'canjeado') NOT NULL,
  `puntos`        INT           NOT NULL,
  `descripcion`   VARCHAR(255)  DEFAULT NULL,
  `idReserva`     INT           DEFAULT NULL,
  `idProducto`    INT           DEFAULT NULL,
  `fecha`         DATETIME      DEFAULT CURRENT_TIMESTAMP,
  `usado`         TINYINT(1)    DEFAULT 0,
  PRIMARY KEY (`idTransaccion`),
  CONSTRAINT `fk_transaccion_usuario`  FOREIGN KEY (`usuario`)    REFERENCES `usuario`        (`email`),
  CONSTRAINT `fk_transaccion_reserva`  FOREIGN KEY (`idReserva`)  REFERENCES `reserva`        (`idReserva`),
  CONSTRAINT `fk_transaccion_producto` FOREIGN KEY (`idProducto`) REFERENCES `producto_tienda`(`idProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;