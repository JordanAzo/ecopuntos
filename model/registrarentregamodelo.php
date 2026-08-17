<?php

require_once __DIR__ . '/../config/database.php';

class RegistrarEntregaModel
{
    public static function registrarEntrega(
        $idUsuario,
        $idCentro,
        $idMaterial,
        $pesoKg
    ) {
        $db = Database::getInstance();

        $sql = "
            BEGIN
                SP_REGISTRAR_ENTREGA(
                    :p_id_usuario,
                    :p_id_centro,
                    :p_id_material,
                    :p_peso_kg,
                    :o_puntos,
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
        $mensaje = '';

        oci_bind_by_name($stmt, ':p_id_usuario', $idUsuario);
        oci_bind_by_name($stmt, ':p_id_centro', $idCentro);
        oci_bind_by_name($stmt, ':p_id_material', $idMaterial);
        oci_bind_by_name($stmt, ':p_peso_kg', $pesoKg);

        oci_bind_by_name(
            $stmt,
            ':o_puntos',
            $puntos,
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
            'mensaje' => $mensaje
        ];
    }
}