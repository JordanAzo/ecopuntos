<?php

require_once __DIR__ . '/../config/database.php';

class PerfilModel
{
    public static function obtenerPerfil($idUsuario)
    {
        $db = Database::getInstance();

        $sql = "
            SELECT
                ID_USUARIO,
                NOMBRE,
                PRIMER_APELLIDO,
                SEGUNDO_APELLIDO,
                CORREO,
                TELEFONO,
                ESTADO,
                ROL,
                FECHA_REGISTRO
            FROM USUARIOS
            WHERE ID_USUARIO = :id_usuario
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

        $perfil = oci_fetch_assoc($stmt);

        oci_free_statement($stmt);

        return $perfil ?: null;
    }
}