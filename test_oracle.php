<?php

// putenv('TNS_ADMIN=C:\Users\saenz\Downloads\Wallet_IIQ2026');

require_once __DIR__ . '/config/database.php';

try {
    $conexion = Database::getInstance();

    $sql = "
        SELECT
            USER AS USUARIO,
            SYS_CONTEXT('USERENV', 'SERVICE_NAME') AS SERVICIO
        FROM DUAL
    ";

    $stmt = oci_parse($conexion, $sql);
    oci_execute($stmt);

    $fila = oci_fetch_assoc($stmt);

    echo "CONEXION OK" . PHP_EOL;
    echo "Usuario: " . $fila['USUARIO'] . PHP_EOL;
    echo "Servicio: " . $fila['SERVICIO'] . PHP_EOL;

} catch (Throwable $e) {
    echo "ERROR:" . PHP_EOL;
    echo $e->getMessage();
}