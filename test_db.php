<?php
require_once 'src/Core/DB.php';

echo "Testing DB Connection...\n";

try {
    $db = new DB('localhost', 'root', '', 'rapidflight');

    if (DB::$error) {
        echo "Connection Failed: " . DB::$connect_error . "\n";
        exit;
    }
    echo "Connection Successful.\n";

    // Test Tables
    $tables = ['usuario', 'reserva', 'vuelo', 'pago', 'producto_tienda', 'transaccion_puntos'];

    foreach ($tables as $table) {
        $check = $db->query("SHOW TABLES LIKE '$table'", [], false, true);
        if ($check) {
            echo "Table '$table' exists.\n";

            // Count rows
            $count = $db->query("SELECT COUNT(*) as c FROM $table", [], false, true);
            echo "  Rows: " . $count['c'] . "\n";

        } else {
            echo "ERROR: Table '$table' DOES NOT EXIST.\n";
        }
    }

    // Test Flight Query (New feature)
    echo "\nTesting Flight Query...\n";
    $flights = $db->query("SELECT * FROM vuelo LIMIT 1", [], true, true);
    if ($flights) {
        echo "Flight query successful. Found " . count($flights) . " flights.\n";
        print_r($flights[0]);
    } else {
        echo "Flight query returned no results or failed.\n";
    }

} catch (Exception $e) {
    echo "Exception: " . $e->getMessage() . "\n";
}
