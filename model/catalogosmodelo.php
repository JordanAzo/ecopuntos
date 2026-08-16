<?php

require_once __DIR__ . '/../config/database.php';

class CatalogosModel
{
    public static function obtenerCentros()
    {
        $db = Database::getInstance();

        $sql = "
            SELECT
                ID_CENTRO,
                NOMBRE_CENTRO,
                PROVINCIA,
                CANTON
            FROM CENTROS_ACOPIO
            WHERE ESTADO = 'ACTIVO'
            ORDER BY NOMBRE_CENTRO
        ";

        $stmt = oci_parse($db, $sql);
        oci_execute($stmt);

        $centros = [];

        while ($fila = oci_fetch_assoc($stmt)) {
            $centros[] = $fila;
        }

        oci_free_statement($stmt);

        return $centros;
    }


    public static function obtenerMateriales()
    {
        $db = Database::getInstance();

        $sql = "
            SELECT
                ID_MATERIAL,
                NOMBRE_MATERIAL,
                TIPO_MATERIAL,
                PUNTOS_POR_KG
            FROM MATERIALES
            WHERE ESTADO = 'ACTIVO'
            ORDER BY NOMBRE_MATERIAL
        ";

        $stmt = oci_parse($db, $sql);
        oci_execute($stmt);

        $materiales = [];

        while ($fila = oci_fetch_assoc($stmt)) {
            $materiales[] = $fila;
        }

        oci_free_statement($stmt);

        return $materiales;
    }

    public static function obtenerComercios()
{
    $db = Database::getInstance();

    $sql = "
        SELECT
            ID_COMERCIO,
            ID_USUARIO,
            NOMBRE_COMERCIO,
            CEDULA_JURIDICA,
            TELEFONO,
            CORREO_CONTACTO
        FROM COMERCIOS
        ORDER BY NOMBRE_COMERCIO
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

    $comercios = [];

    while ($fila = oci_fetch_assoc($stmt)) {
        $comercios[] = $fila;
    }

    oci_free_statement($stmt);

    return $comercios;
}

public static function obtenerComercioPorUsuario($idUsuario)
{
    $db = Database::getInstance();

    $sql = "
        SELECT
            ID_COMERCIO,
            ID_USUARIO,
            NOMBRE_COMERCIO,
            CEDULA_JURIDICA,
            TELEFONO,
            CORREO_CONTACTO
        FROM COMERCIOS
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

    $comercio = oci_fetch_assoc($stmt);

    oci_free_statement($stmt);

    return $comercio ?: null;
}
}