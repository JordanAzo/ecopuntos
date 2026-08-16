<?php

require_once __DIR__ . '/../config/database.php';

class EstadisticasAdminModel
{
    public static function obtenerEstadisticasCentros()
    {
        $db = Database::getInstance();

        $sql = "
            SELECT
                ID_CENTRO,
                NOMBRE_CENTRO,
                PROVINCIA,
                TOTAL_VISITAS,
                TOTAL_KG_RECOLECTADOS,
                TOTAL_PUNTOS_OTORGADOS
            FROM VW_ESTADISTICAS_CENTROS_ACOPIO
            ORDER BY TOTAL_KG_RECOLECTADOS DESC
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

        $centros = [];

        while ($fila = oci_fetch_assoc($stmt)) {
            $centros[] = $fila;
        }

        oci_free_statement($stmt);

        return $centros;
    }
}