<?php
// seed_flights.php

// 1. Conexión a DB
$host = 'localhost';
$username = 'root';
$password = '';
$dbName = 'rapidflight';

$conn = new mysqli($host, $username, $password, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Conectado a la base de datos '$dbName'.\n";

// 2. Obtener Ciudades (IATA)
$sqlCities = "SELECT iata FROM ciudad";
$resultCities = $conn->query($sqlCities);
$iatas = [];
if ($resultCities->num_rows > 0) {
    while ($row = $resultCities->fetch_assoc()) {
        $iatas[] = $row['iata'];
    }
} else {
    die("No se encontraron ciudades en la tabla 'ciudad'. Por favor, asegúrate de que existen.\n");
}

echo "Se encontraron " . count($iatas) . " ciudades.\n";

// 3. Generar 400 Vuelos
$airlines = ['Iberia', 'Ryanair', 'Vueling', 'Air Europa', 'Lufthansa', 'Air France', 'British Airways', 'Emirates', 'Delta'];
$flightsGenerated = 0;
$startDate = new DateTime('2026-02-19'); // Hoy
$endDate = new DateTime('2026-08-21');   // Fecha límite

echo "Generando 400 vuelos entre " . $startDate->format('Y-m-d') . " y " . $endDate->format('Y-m-d') . "...\n";

$stmt = $conn->prepare("INSERT INTO vuelo (origen, destino, fechaSalida, horaSalida, duracionMinutos, aerolinea, numeroVuelo, precio, escalas, activo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 1)");

if (!$stmt) {
    die("Error preparando la consulta: " . $conn->error . "\n");
}

for ($i = 0; $i < 400; $i++) {
    // Origen y Destino diferentes
    $origin = $iatas[array_rand($iatas)];
    $dest = $iatas[array_rand($iatas)];
    while ($dest === $origin) {
        $dest = $iatas[array_rand($iatas)];
    }

    // Fecha aleatoria
    $randomTimestamp = mt_rand($startDate->getTimestamp(), $endDate->getTimestamp());
    $flightDate = new DateTime();
    $flightDate->setTimestamp($randomTimestamp);
    $fechaSalida = $flightDate->format('Y-m-d');

    // Hora aleatoria (06:00 a 23:00 para realismo)
    $hour = str_pad(mt_rand(6, 23), 2, '0', STR_PAD_LEFT);
    $minute = str_pad(mt_rand(0, 59), 2, '0', STR_PAD_LEFT);
    $horaSalida = "$hour:$minute"; // Formato HH:MM

    // Duración y Precio (correlacionados un poco)
    $duration = mt_rand(45, 300); // 45 min a 5 horas
    $precio = mt_rand(30, 300) + ($duration * 0.2); // Base + factor duración
    $precio = round($precio, 2);

    // Aerolínea y Número de Vuelo
    $aerolinea = $airlines[array_rand($airlines)];
    $numeroVuelo = strtoupper(substr($aerolinea, 0, 2)) . mt_rand(1000, 9999);

    // Escalas
    $escalas = (mt_rand(0, 10) > 8) ? 1 : 0; // 20% probabilidad de 1 escala

    // Bind params
    // s = string, i = integer, d = double
    $stmt->bind_param("ssssissdi", $origin, $dest, $fechaSalida, $horaSalida, $duration, $aerolinea, $numeroVuelo, $precio, $escalas);

    if ($stmt->execute()) {
        $flightsGenerated++;
    } else {
        echo "Error insertando vuelo $i: " . $stmt->error . "\n";
    }
}

echo "Se han insertado correctamente $flightsGenerated vuelos.\n";

$stmt->close();
$conn->close();
?>