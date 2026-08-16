<?php

require_once __DIR__ . '/../config/database.php';

class MisCuponesModel
{
    public static function obtenerCuponesUsuario($idUsuario)
    {
        $db = Database::getInstance();

        $sql = "
            SELECT
                ID_CUPON,
                CODIGO_CUPON,
                ID_USUARIO,
                ID_RECOMPENSA,
                RECOMPENSA,
                ID_COMERCIO,
                NOMBRE_COMERCIO,
                FECHA_EMISION,
                FECHA_EXPIRACION,
                ESTADO_CUPON,
                PUNTOS_REQUERIDOS
            FROM VW_CUPONES_USUARIO
            WHERE ID_USUARIO = :id_usuario
            ORDER BY FECHA_EMISION DESC
        ";

        $stmt = oci_parse($db, $sql);

        if (!$stmt) {
            $error = oci_error($db);
            throw new Exception($error['message']);
        }

        oci_bind_by_name(
            $stmt,
            ':id_usuario',
            $idUsuario
        );

        if (!oci_execute($stmt)) {
            $error = oci_error($stmt);
            oci_free_statement($stmt);

            throw new Exception($error['message']);
        }

        $cupones = [];

        while ($fila = oci_fetch_assoc($stmt)) {
            $cupones[] = $fila;
        }

        oci_free_statement($stmt);

        return $cupones;
    }
}