<?php

require_once __DIR__ . '/../config/database.php';

class EstadisticasModel
{
    public static function obtenerEstadisticas()
    {
        $db = Database::getInstance();

        $sql = "
            SELECT
                NVL((
                    SELECT SUM(PESO_KG)
                    FROM ENTREGAS_DETALLE
                ), 0) AS MATERIAL,

                NVL((
                    SELECT SUM(PESO_KG) * 0.5
                    FROM ENTREGAS_DETALLE
                ), 0) AS CO2,

                (
                    SELECT COUNT(*)
                    FROM USUARIOS
                    WHERE ESTADO = 'ACTIVO'
                ) AS USUARIOS,

                (
                    SELECT COUNT(*)
                    FROM ENTREGAS_RECICLAJE
                ) AS ENTREGAS

            FROM DUAL
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

        $fila = oci_fetch_assoc($stmt);

        oci_free_statement($stmt);

        return [
            'material' => (float) $fila['MATERIAL'],
            'co2' => (float) $fila['CO2'],
            'usuarios' => (int) $fila['USUARIOS'],
            'entregas' => (int) $fila['ENTREGAS']
        ];
    }
}