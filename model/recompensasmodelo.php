<?php

require_once __DIR__ . '/../config/database.php';

class RecompensasModel
{
    public static function obtenerRecompensasActivas()
    {
        $db = Database::getInstance();

        $sql = "
            SELECT
                ID_RECOMPENSA,
                ID_COMERCIO,
                NOMBRE_COMERCIO,
                TITULO,
                DESCRIPCION,
                PUNTOS_REQUERIDOS,
                STOCK_DISPONIBLE
            FROM VW_CATALOGO_RECOMPENSAS_ACTIVAS
            ORDER BY PUNTOS_REQUERIDOS ASC
        ";

        $stmt = oci_parse($db, $sql);

        if (!$stmt) {
            $error = oci_error($db);
            throw new Exception($error['message']);
        }

        if (!oci_execute($stmt)) {
            $error = oci_error($stmt);
            oci_free_statement($stmt);

            throw new Exception($error['message']);
        }

        $recompensas = [];

        while ($fila = oci_fetch_assoc($stmt)) {
            $recompensas[] = $fila;
        }

        oci_free_statement($stmt);

        return $recompensas;
    }
}