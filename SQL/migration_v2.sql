-- Usar la base de datos correcta
USE rapidflight;

-- 1. Modificar tabla usuario
ALTER TABLE usuario
ADD COLUMN nombre VARCHAR(100) DEFAULT NULL,
ADD COLUMN apellidos VARCHAR(150) DEFAULT NULL,
ADD COLUMN fechaNacimiento DATE DEFAULT NULL,
ADD COLUMN telefono VARCHAR(20) DEFAULT NULL,
ADD COLUMN direccion VARCHAR(255) DEFAULT NULL,
ADD COLUMN ciudad VARCHAR(100) DEFAULT NULL,
ADD COLUMN codigoPostal VARCHAR(10) DEFAULT NULL,
ADD COLUMN pais VARCHAR(100) DEFAULT 'España',
ADD COLUMN nacionalidad VARCHAR(100) DEFAULT NULL,
ADD COLUMN pasaporte VARCHAR(50) DEFAULT NULL,
ADD COLUMN puntos INT DEFAULT 0;

-- 2. Crear tabla vuelo
CREATE TABLE IF NOT EXISTS vuelo (
    idVuelo INT AUTO_INCREMENT PRIMARY KEY,
    numeroVuelo VARCHAR(20) NOT NULL,
    aerolinea VARCHAR(100) NOT NULL,
    origen CHAR(3) NOT NULL,
    destino CHAR(3) NOT NULL,
    fechaSalida DATE NOT NULL,
    horaSalida TIME NOT NULL,
    fechaLlegada DATE NOT NULL,
    horaLlegada TIME NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    duracionMinutos INT NOT NULL,
    escalas INT DEFAULT 0,
    equipajeManoIncluido BOOLEAN DEFAULT 1,
    plazasDisponibles INT DEFAULT 150,
    activo BOOLEAN DEFAULT 1,
    FOREIGN KEY (origen) REFERENCES ciudad(iata),
    FOREIGN KEY (destino) REFERENCES ciudad(iata)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- 3. Crear tabla pago
CREATE TABLE IF NOT EXISTS pago (
    idPago INT AUTO_INCREMENT PRIMARY KEY,
    idReserva INT NOT NULL, -- Se agregará FK después de modificar tabla reserva
    usuario VARCHAR(100) NOT NULL,
    monto DECIMAL(10,2) NOT NULL,
    metodoPago VARCHAR(50) DEFAULT 'Tarjeta de Crédito',
    numeroTarjeta VARCHAR(4) NOT NULL, -- Solo últimos 4 dígitos
    nombreTitular VARCHAR(150) NOT NULL,
    fechaPago DATETIME DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('pendiente', 'completado', 'fallido') DEFAULT 'completado',
    codigoTransaccion VARCHAR(50) UNIQUE NOT NULL,
    FOREIGN KEY (usuario) REFERENCES usuario(email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- 4. Crear tabla producto_tienda
CREATE TABLE IF NOT EXISTS producto_tienda (
    idProducto INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    descripcion TEXT,
    tipo ENUM('descuento_vuelo', 'tarjeta_amazon') NOT NULL,
    puntosRequeridos INT NOT NULL,
    valor DECIMAL(10,2) NOT NULL,
    stock INT DEFAULT -1, -- -1 = ilimitado
    activo BOOLEAN DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- 5. Crear tabla transaccion_puntos
CREATE TABLE IF NOT EXISTS transaccion_puntos (
    idTransaccion INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(100) NOT NULL,
    tipo ENUM('ganado', 'canjeado') NOT NULL,
    puntos INT NOT NULL,
    descripcion VARCHAR(255),
    idReserva INT DEFAULT NULL, -- Se agregará FK después
    idProducto INT DEFAULT NULL,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario) REFERENCES usuario(email),
    FOREIGN KEY (idProducto) REFERENCES producto_tienda(idProducto)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- 6. Modificar tabla reserva
ALTER TABLE reserva
ADD COLUMN precio DECIMAL(10,2) DEFAULT 0.00,
ADD COLUMN idVuelo INT DEFAULT NULL,
ADD COLUMN estado ENUM('pendiente_pago', 'confirmada', 'cancelada') DEFAULT 'pendiente_pago',
ADD COLUMN puntosGanados INT DEFAULT 0;

-- Agregar FKs pendientes
ALTER TABLE reserva
ADD CONSTRAINT fk_reserva_vuelo FOREIGN KEY (idVuelo) REFERENCES vuelo(idVuelo);

ALTER TABLE pago
ADD CONSTRAINT fk_pago_reserva FOREIGN KEY (idReserva) REFERENCES reserva(idReserva);

ALTER TABLE transaccion_puntos
ADD CONSTRAINT fk_transaccion_reserva FOREIGN KEY (idReserva) REFERENCES reserva(idReserva);

-- 7. Insertar datos mock de vuelos (50 vuelos variados)
INSERT INTO vuelo (numeroVuelo, aerolinea, origen, destino, fechaSalida, horaSalida, fechaLlegada, horaLlegada, precio, duracionMinutos, escalas, equipajeManoIncluido) VALUES
('IB3401', 'Iberia', 'MAD', 'BCN', CURRENT_DATE + INTERVAL 1 DAY, '07:00:00', CURRENT_DATE + INTERVAL 1 DAY, '08:15:00', 45.50, 75, 0, 1),
('VY1002', 'Vueling', 'BCN', 'MAD', CURRENT_DATE + INTERVAL 1 DAY, '09:30:00', CURRENT_DATE + INTERVAL 1 DAY, '10:55:00', 39.99, 85, 0, 0),
('RY5521', 'Ryanair', 'MAD', 'PMI', CURRENT_DATE + INTERVAL 2 DAY, '14:20:00', CURRENT_DATE + INTERVAL 2 DAY, '15:40:00', 22.99, 80, 0, 0),
('UX4022', 'Air Europa', 'MAD', 'LPA', CURRENT_DATE + INTERVAL 3 DAY, '11:00:00', CURRENT_DATE + INTERVAL 3 DAY, '12:50:00', 120.00, 170, 0, 1),
('IB3830', 'Iberia', 'MAD', 'TFN', CURRENT_DATE + INTERVAL 4 DAY, '16:45:00', CURRENT_DATE + INTERVAL 4 DAY, '18:40:00', 145.50, 175, 0, 1),
('VY2201', 'Vueling', 'BIO', 'SVQ', CURRENT_DATE + INTERVAL 2 DAY, '08:10:00', CURRENT_DATE + INTERVAL 2 DAY, '09:40:00', 55.00, 90, 0, 1),
('RY6671', 'Ryanair', 'VLC', 'IBZ', CURRENT_DATE + INTERVAL 5 DAY, '20:00:00', CURRENT_DATE + INTERVAL 5 DAY, '20:45:00', 19.99, 45, 0, 0),
('IB8821', 'Iberia Express', 'MAD', 'ACE', CURRENT_DATE + INTERVAL 6 DAY, '10:00:00', CURRENT_DATE + INTERVAL 6 DAY, '11:55:00', 98.40, 175, 0, 1),
('NT3301', 'Binter', 'TFN', 'LPA', CURRENT_DATE + INTERVAL 1 DAY, '08:00:00', CURRENT_DATE + INTERVAL 1 DAY, '08:30:00', 35.00, 30, 0, 1),
('NT3302', 'Binter', 'LPA', 'TFN', CURRENT_DATE + INTERVAL 1 DAY, '18:00:00', CURRENT_DATE + INTERVAL 1 DAY, '18:30:00', 35.00, 30, 0, 1),
('VY3321', 'Vueling', 'BCN', 'AGP', CURRENT_DATE + INTERVAL 3 DAY, '12:15:00', CURRENT_DATE + INTERVAL 3 DAY, '13:55:00', 62.99, 100, 0, 1),
('RY1122', 'Ryanair', 'AGP', 'BCN', CURRENT_DATE + INTERVAL 4 DAY, '15:30:00', CURRENT_DATE + INTERVAL 4 DAY, '17:10:00', 45.00, 100, 0, 0),
('IB5501', 'Iberia', 'MAD', 'SCQ', CURRENT_DATE + INTERVAL 7 DAY, '09:15:00', CURRENT_DATE + INTERVAL 7 DAY, '10:30:00', 78.50, 75, 0, 1),
('VY8811', 'Vueling', 'SCQ', 'AGP', CURRENT_DATE + INTERVAL 8 DAY, '11:00:00', CURRENT_DATE + INTERVAL 8 DAY, '12:50:00', 89.99, 110, 1, 1), -- Con escala
('UX9921', 'Air Europa', 'MAD', 'VGO', CURRENT_DATE + INTERVAL 2 DAY, '19:30:00', CURRENT_DATE + INTERVAL 2 DAY, '20:40:00', 65.00, 70, 0, 1),
('IB2201', 'Iberia', 'ALC', 'MAD', CURRENT_DATE + INTERVAL 5 DAY, '07:45:00', CURRENT_DATE + INTERVAL 5 DAY, '08:50:00', 58.20, 65, 0, 1),
('RY4411', 'Ryanair', 'SDR', 'MAD', CURRENT_DATE + INTERVAL 3 DAY, '14:00:00', CURRENT_DATE + INTERVAL 3 DAY, '15:10:00', 32.50, 70, 0, 0),
('VY7701', 'Vueling', 'OVD', 'BCN', CURRENT_DATE + INTERVAL 6 DAY, '10:20:00', CURRENT_DATE + INTERVAL 6 DAY, '11:45:00', 72.00, 85, 0, 1),
('IB4412', 'Iberia', 'MAD', 'GRX', CURRENT_DATE + INTERVAL 4 DAY, '16:00:00', CURRENT_DATE + INTERVAL 4 DAY, '17:05:00', 85.90, 65, 0, 1),
('VY9922', 'Vueling', 'BCN', 'BIO', CURRENT_DATE + INTERVAL 2 DAY, '18:15:00', CURRENT_DATE + INTERVAL 2 DAY, '19:30:00', 49.99, 75, 0, 1),

-- Más vuelos para llegar a 50 (Variaciones)
('IB3402', 'Iberia', 'MAD', 'BCN', CURRENT_DATE + INTERVAL 1 DAY, '18:00:00', CURRENT_DATE + INTERVAL 1 DAY, '19:15:00', 55.50, 75, 0, 1),
('VY1003', 'Vueling', 'BCN', 'MAD', CURRENT_DATE + INTERVAL 1 DAY, '20:30:00', CURRENT_DATE + INTERVAL 1 DAY, '21:55:00', 49.99, 85, 0, 0),
('RY5522', 'Ryanair', 'MAD', 'PMI', CURRENT_DATE + INTERVAL 3 DAY, '09:20:00', CURRENT_DATE + INTERVAL 3 DAY, '10:40:00', 32.99, 80, 0, 0),
('UX4023', 'Air Europa', 'MAD', 'LPA', CURRENT_DATE + INTERVAL 5 DAY, '15:00:00', CURRENT_DATE + INTERVAL 5 DAY, '16:50:00', 140.00, 170, 0, 1),
('IB3831', 'Iberia', 'MAD', 'TFN', CURRENT_DATE + INTERVAL 6 DAY, '08:45:00', CURRENT_DATE + INTERVAL 6 DAY, '10:40:00', 125.50, 175, 0, 1),
('VY2202', 'Vueling', 'BIO', 'SVQ', CURRENT_DATE + INTERVAL 4 DAY, '14:10:00', CURRENT_DATE + INTERVAL 4 DAY, '15:40:00', 65.00, 90, 0, 1),
('RY6672', 'Ryanair', 'VLC', 'IBZ', CURRENT_DATE + INTERVAL 7 DAY, '10:00:00', CURRENT_DATE + INTERVAL 7 DAY, '10:45:00', 29.99, 45, 0, 0),
('IB8822', 'Iberia Express', 'MAD', 'ACE', CURRENT_DATE + INTERVAL 8 DAY, '16:00:00', CURRENT_DATE + INTERVAL 8 DAY, '17:55:00', 118.40, 175, 0, 1),
('NT3303', 'Binter', 'TFN', 'SPC', CURRENT_DATE + INTERVAL 2 DAY, '09:00:00', CURRENT_DATE + INTERVAL 2 DAY, '09:30:00', 38.00, 30, 0, 1),
('NT3304', 'Binter', 'SPC', 'TFN', CURRENT_DATE + INTERVAL 2 DAY, '17:00:00', CURRENT_DATE + INTERVAL 2 DAY, '17:30:00', 38.00, 30, 0, 1),
('VY3322', 'Vueling', 'BCN', 'MAH', CURRENT_DATE + INTERVAL 5 DAY, '13:15:00', CURRENT_DATE + INTERVAL 5 DAY, '14:00:00', 52.99, 45, 0, 1),
('RY1123', 'Ryanair', 'MAH', 'BCN', CURRENT_DATE + INTERVAL 6 DAY, '16:30:00', CURRENT_DATE + INTERVAL 6 DAY, '17:15:00', 42.00, 45, 0, 0),
('IB5502', 'Iberia', 'MAD', 'VLL', CURRENT_DATE + INTERVAL 2 DAY, '11:15:00', CURRENT_DATE + INTERVAL 2 DAY, '12:05:00', 68.50, 50, 0, 1),
('VY8812', 'Vueling', 'VLL', 'BCN', CURRENT_DATE + INTERVAL 3 DAY, '11:00:00', CURRENT_DATE + INTERVAL 3 DAY, '12:15:00', 79.99, 75, 0, 1),
('UX9922', 'Air Europa', 'MAD', 'LCG', CURRENT_DATE + INTERVAL 4 DAY, '18:30:00', CURRENT_DATE + INTERVAL 4 DAY, '19:40:00', 85.00, 70, 0, 1),
('IB2202', 'Iberia', 'LCG', 'MAD', CURRENT_DATE + INTERVAL 5 DAY, '08:45:00', CURRENT_DATE + INTERVAL 5 DAY, '09:55:00', 78.20, 70, 0, 1),
('RY4412', 'Ryanair', 'ZAZ', 'PMI', CURRENT_DATE + INTERVAL 5 DAY, '15:00:00', CURRENT_DATE + INTERVAL 5 DAY, '15:55:00', 28.50, 55, 0, 0),
('VY7702', 'Vueling', 'PMI', 'ZAZ', CURRENT_DATE + INTERVAL 7 DAY, '10:20:00', CURRENT_DATE + INTERVAL 7 DAY, '11:15:00', 62.00, 55, 0, 1),
('IB4413', 'Iberia', 'MAD', 'XRY', CURRENT_DATE + INTERVAL 2 DAY, '17:00:00', CURRENT_DATE + INTERVAL 2 DAY, '18:05:00', 95.90, 65, 0, 1),
('VY9923', 'Vueling', 'XRY', 'BCN', CURRENT_DATE + INTERVAL 4 DAY, '19:15:00', CURRENT_DATE + INTERVAL 4 DAY, '20:45:00', 89.99, 90, 1, 1),

-- Con escalas
('IB9001', 'Iberia', 'VGO', 'BCN', CURRENT_DATE + INTERVAL 2 DAY, '07:00:00', CURRENT_DATE + INTERVAL 2 DAY, '10:30:00', 115.50, 210, 1, 1), -- Escala en MAD
('VY9002', 'Vueling', 'SCQ', 'PMI', CURRENT_DATE + INTERVAL 3 DAY, '08:00:00', CURRENT_DATE + INTERVAL 3 DAY, '12:00:00', 99.99, 240, 1, 0), -- Escala en BCN
('RY9003', 'Ryanair', 'SDR', 'SVQ', CURRENT_DATE + INTERVAL 4 DAY, '09:00:00', CURRENT_DATE + INTERVAL 4 DAY, '13:00:00', 75.99, 240, 1, 0), -- Escala
('UX9004', 'Air Europa', 'BIO', 'AGP', CURRENT_DATE + INTERVAL 5 DAY, '10:00:00', CURRENT_DATE + INTERVAL 5 DAY, '14:00:00', 130.00, 240, 1, 1), -- Escala
('IB9005', 'Iberia', 'LPA', 'BCN', CURRENT_DATE + INTERVAL 6 DAY, '11:00:00', CURRENT_DATE + INTERVAL 6 DAY, '16:00:00', 180.50, 300, 1, 1), -- Escala
('VY9006', 'Vueling', 'ACE', 'BIO', CURRENT_DATE + INTERVAL 7 DAY, '12:00:00', CURRENT_DATE + INTERVAL 7 DAY, '17:30:00', 145.00, 330, 1, 1), -- Escala
('RY9007', 'Ryanair', 'VLC', 'LPA', CURRENT_DATE + INTERVAL 8 DAY, '13:00:00', CURRENT_DATE + INTERVAL 8 DAY, '17:00:00', 95.99, 240, 1, 0), -- Escala
('IB9008', 'Iberia', 'GRX', 'BIO', CURRENT_DATE + INTERVAL 1 DAY, '14:00:00', CURRENT_DATE + INTERVAL 1 DAY, '17:30:00', 125.40, 210, 1, 1), -- Escala
('NT9009', 'Binter', 'VGO', 'TFN', CURRENT_DATE + INTERVAL 2 DAY, '15:00:00', CURRENT_DATE + INTERVAL 2 DAY, '17:30:00', 155.00, 150, 0, 1),
('NT9010', 'Binter', 'ZAZ', 'TFN', CURRENT_DATE + INTERVAL 2 DAY, '16:00:00', CURRENT_DATE + INTERVAL 2 DAY, '18:45:00', 165.00, 165, 0, 1);

-- 8. Insertar productos de tienda
INSERT INTO producto_tienda (nombre, descripcion, tipo, puntosRequeridos, valor, stock) VALUES
('Descuento 5€ en vuelos', 'Cupón de descuento de 5€ aplicable en tu próxima reserva.', 'descuento_vuelo', 50, 5.00, -1),
('Descuento 10€ en vuelos', 'Cupón de descuento de 10€ aplicable en tu próxima reserva.', 'descuento_vuelo', 100, 10.00, -1),
('Descuento 20€ en vuelos', 'Cupón de descuento de 20€ aplicable en tu próxima reserva.', 'descuento_vuelo', 200, 20.00, -1),
('Descuento 50€ en vuelos', 'Cupón de descuento de 50€ aplicable en tu próxima reserva.', 'descuento_vuelo', 500, 50.00, -1),
('Tarjeta Regalo Amazon 10€', 'Recibe un código de tarjeta regalo de Amazon por valor de 10€.', 'tarjeta_amazon', 150, 10.00, 50),
('Tarjeta Regalo Amazon 25€', 'Recibe un código de tarjeta regalo de Amazon por valor de 25€.', 'tarjeta_amazon', 350, 25.00, 25),
('Tarjeta Regalo Amazon 50€', 'Recibe un código de tarjeta regalo de Amazon por valor de 50€.', 'tarjeta_amazon', 700, 50.00, 10);
