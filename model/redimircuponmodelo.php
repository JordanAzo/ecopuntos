<?php

require_once __DIR__ . '/../config/database.php';

class RedimirCuponModel
{
    public static function redimirCupon(
        $codigoCupon,
        $idComercio
    ) {

        $stmt = null;

        try {

            $db = Database::getInstance();

            $sql = "
                BEGIN
                    SP_REDIMIR_CUPON_COMERCIO(
                        :p_codigo_cupon,
                        :p_id_comercio,
                        :o_mensaje
                    );
                END;
            ";

            $stmt = oci_parse($db, $sql);

            if (!$stmt) {

                $error = oci_error($db);

                throw new Exception(
                    $error['message']
                );
            }

            $mensaje = '';

            oci_bind_by_name(
                $stmt,
                ':p_codigo_cupon',
                $codigoCupon,
                100
            );

            oci_bind_by_name(
                $stmt,
                ':p_id_comercio',
                $idComercio
            );

            oci_bind_by_name(
                $stmt,
                ':o_mensaje',
                $mensaje,
                500
            );

            $ejecutado = oci_execute(
                $stmt,
                OCI_NO_AUTO_COMMIT
            );

            if (!$ejecutado) {

                $error = oci_error($stmt);

                throw new Exception(
                    $error['message']
                );
            }

            oci_free_statement($stmt);

            $stmt = null;

            return [
                'success' => str_starts_with(
                    strtoupper($mensaje),
                    'OK:'
                ),
                'mensaje' => $mensaje
            ];

        } catch (Throwable $e) {

            if ($stmt) {
                oci_free_statement($stmt);
            }

            return [
                'success' => false,
                'mensaje' =>
                    'Error al redimir el cupón: '
                    . $e->getMessage()
            ];
        }
    }
}