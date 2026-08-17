<?php

require_once __DIR__ . '/../config/database.php';

class ResumenUsuarioModel
{
    public static function obtenerResumen($idUsuario)
    {
        $db = Database::getInstance();

        $sql = "
            BEGIN
                SP_OBTENER_RESUMEN_USUARIO(
                    :p_id_usuario,
                    :o_puntos_totales,
                    :o_cupones_activos,
                    :o_mensaje
                );
            END;
        ";

        $stmt = oci_parse($db, $sql);

        if (!$stmt) {
            $error = oci_error($db);
            throw new Exception($error['message']);
        }

        $puntos = 0;
        $cupones = 0;
        $mensaje = '';

        oci_bind_by_name(
            $stmt,
            ':p_id_usuario',
            $idUsuario
        );

        oci_bind_by_name(
            $stmt,
            ':o_puntos_totales',
            $puntos,
            40
        );

        oci_bind_by_name(
            $stmt,
            ':o_cupones_activos',
            $cupones,
            40
        );

        oci_bind_by_name(
            $stmt,
            ':o_mensaje',
            $mensaje,
            500
        );

        $ejecutado = oci_execute($stmt);

        if (!$ejecutado) {
            $error = oci_error($stmt);
            oci_free_statement($stmt);

            throw new Exception($error['message']);
        }

        oci_free_statement($stmt);

        return [
            'puntos' => (float) $puntos,
            'cupones' => (int) $cupones,
            'mensaje' => $mensaje
        ];
    }
}