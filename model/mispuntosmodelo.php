<?php

require_once __DIR__ . '/../config/database.php';

class MisPuntosModel
{
    public static function obtenerEstadisticasUsuario($idUsuario)
    {
        $db = Database::getInstance();

        $sql = "
            SELECT
                FN_TOTAL_KG_USUARIO(
                    :id_usuario_kg
                ) AS TOTAL_KG,

                FN_TOTAL_ENTREGAS_USUARIO(
                    :id_usuario_entregas
                ) AS TOTAL_ENTREGAS,

                PKG_GESTION_RECICLAJE.FN_NIVEL_USUARIO(
                    :id_usuario_nivel
                ) AS NIVEL
            FROM DUAL
        ";

        $stmt = oci_parse($db, $sql);

        if (!$stmt) {
            $error = oci_error($db);
            throw new Exception($error['message']);
        }

        oci_bind_by_name(
            $stmt,
            ':id_usuario_kg',
            $idUsuario
        );

        oci_bind_by_name(
            $stmt,
            ':id_usuario_entregas',
            $idUsuario
        );

        oci_bind_by_name(
            $stmt,
            ':id_usuario_nivel',
            $idUsuario
        );

        if (!oci_execute($stmt)) {
            $error = oci_error($stmt);

            oci_free_statement($stmt);

            throw new Exception($error['message']);
        }

        $fila = oci_fetch_assoc($stmt);

        oci_free_statement($stmt);

        return [
            'total_kg' =>
                (float) ($fila['TOTAL_KG'] ?? 0),

            'total_entregas' =>
                (int) ($fila['TOTAL_ENTREGAS'] ?? 0),

            'nivel' =>
                $fila['NIVEL'] ?? 'PRINCIPIANTE'
        ];
    }
}