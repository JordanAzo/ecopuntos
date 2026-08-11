<?php

require_once __DIR__ . '/../config/database.php';


class RecompensaModel
{

    public static function registrarRecompensa(
        $nombreComercio,
        $titulo,
        $descripcion,
        $puntosRequeridos,
        $cantidadSolicitar
    ) {

        $stmt = null;

        try {

            // ==========================================
            // CONEXIÓN
            // ==========================================

            $db = Database::getInstance();


            // ==========================================
            // LLAMAR AL SP
            // ==========================================

            $sql = "
                BEGIN

                    SP_REGISTRAR_RECOMPENSA(
                        :p_nombre_comercio,
                        :p_titulo_recompensa,
                        :p_descripcion,
                        :p_puntos_requeridos,
                        :p_cantidad_solicitar,
                        :o_codigo_respuesta,
                        :o_mensaje_respuesta
                    );

                END;
            ";


            $stmt = oci_parse(
                $db,
                $sql
            );


            if (!$stmt) {

                $error = oci_error($db);

                throw new Exception(
                    $error['message']
                );
            }


            // ==========================================
            // PARÁMETROS IN
            // ==========================================

            oci_bind_by_name(
                $stmt,
                ':p_nombre_comercio',
                $nombreComercio,
                200
            );


            oci_bind_by_name(
                $stmt,
                ':p_titulo_recompensa',
                $titulo,
                150
            );


            oci_bind_by_name(
                $stmt,
                ':p_descripcion',
                $descripcion,
                500
            );


            oci_bind_by_name(
                $stmt,
                ':p_puntos_requeridos',
                $puntosRequeridos,
                -1,
                SQLT_INT
            );


            oci_bind_by_name(
                $stmt,
                ':p_cantidad_solicitar',
                $cantidadSolicitar,
                -1,
                SQLT_INT
            );


            // ==========================================
            // PARÁMETROS OUT
            // ==========================================

            $codigoRespuesta = 0;
            $mensajeRespuesta = '';


            oci_bind_by_name(
                $stmt,
                ':o_codigo_respuesta',
                $codigoRespuesta,
                -1,
                SQLT_INT
            );


            oci_bind_by_name(
                $stmt,
                ':o_mensaje_respuesta',
                $mensajeRespuesta,
                500
            );


            // ==========================================
            // EJECUTAR
            // ==========================================

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

                'success' =>
                    ((int)$codigoRespuesta === 1),

                'mensaje' =>
                    $mensajeRespuesta

            ];


        } catch (Throwable $e) {

            if ($stmt) {
                oci_free_statement($stmt);
            }


            return [

                'success' => false,

                'mensaje' =>
                    'Error al registrar la recompensa: '
                    . $e->getMessage()

            ];
        }
    }
}