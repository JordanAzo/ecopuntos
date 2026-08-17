<?php

require_once __DIR__ . '/../config/database.php';

class CanjearRecompensaModel
{
    public static function canjear(
        $idUsuario,
        $idRecompensa
    ) {
        $db = Database::getInstance();

        $sql = "
            BEGIN
                SP_CANJEAR_RECOMPENSA(
                    :p_id_usuario,
                    :p_id_recompensa,
                    :o_codigo_cupon,
                    :o_mensaje
                );
            END;
        ";

        $stmt = oci_parse($db, $sql);

        if (!$stmt) {
            $error = oci_error($db);
            throw new Exception($error['message']);
        }

        $codigoCupon = '';
        $mensaje = '';

        oci_bind_by_name(
            $stmt,
            ':p_id_usuario',
            $idUsuario
        );

        oci_bind_by_name(
            $stmt,
            ':p_id_recompensa',
            $idRecompensa
        );

        oci_bind_by_name(
            $stmt,
            ':o_codigo_cupon',
            $codigoCupon,
            100
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
            'codigo_cupon' => $codigoCupon,
            'mensaje' => $mensaje
        ];
    }
}