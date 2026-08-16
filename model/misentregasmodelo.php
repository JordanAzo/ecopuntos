<?php

require_once __DIR__ . '/../config/database.php';

class MisEntregasModel
{
    public static function obtenerEntregasUsuario($idUsuario)
    {
        $db = Database::getInstance();

        $sql = "
            SELECT
                ID_ENTREGA,
                ID_USUARIO,
                FECHA_ENTREGA,
                ID_CENTRO,
                NOMBRE_CENTRO,
                PROVINCIA,
                CANTON,
                ID_MATERIAL,
                NOMBRE_MATERIAL,
                PESO_KG,
                PUNTOS_GENERADOS,
                PUNTOS_TOTALES
            FROM VW_HISTORIAL_ENTREGAS_USUARIO
            WHERE ID_USUARIO = :id_usuario
            ORDER BY FECHA_ENTREGA DESC, ID_ENTREGA DESC
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

        $entregas = [];

        while ($fila = oci_fetch_assoc($stmt)) {
            $entregas[] = $fila;
        }

        oci_free_statement($stmt);

        return $entregas;
    }
}