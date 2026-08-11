<?php

require_once __DIR__ . '/../config/database.php';


class LoginModel
{

    public static function iniciarSesion(
        $correo,
        $clave
    ) {

        $stmt = null;
        $cursor = null;

        try {

            // ==========================================
            // CONEXIÓN A ORACLE
            // ==========================================

            $db = Database::getInstance();


            // ==========================================
            // LLAMAR AL PROCEDIMIENTO
            // ==========================================

            $sql = "
                BEGIN

                    SP_INICIAR_SESION_USUARIO(
                        :p_correo,
                        :p_clave,
                        :p_resultado
                    );

                END;
            ";


            // ==========================================
            // PREPARAR SENTENCIA
            // ==========================================

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
            // CREAR CURSOR
            // ==========================================

            $cursor = oci_new_cursor($db);


            // ==========================================
            // PARÁMETROS DE ENTRADA
            // ==========================================

            oci_bind_by_name(
                $stmt,
                ':p_correo',
                $correo,
                150
            );


            oci_bind_by_name(
                $stmt,
                ':p_clave',
                $clave,
                256
            );


            // ==========================================
            // CURSOR DE SALIDA
            // ==========================================

            oci_bind_by_name(
                $stmt,
                ':p_resultado',
                $cursor,
                -1,
                OCI_B_CURSOR
            );


            // ==========================================
            // EJECUTAR PROCEDIMIENTO
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


            // ==========================================
            // EJECUTAR CURSOR
            // ==========================================

            $cursorEjecutado = oci_execute($cursor);


            if (!$cursorEjecutado) {

                $error = oci_error($cursor);

                throw new Exception(
                    $error['message']
                );
            }


            // ==========================================
            // OBTENER USUARIO
            // ==========================================

            $usuario = oci_fetch_assoc($cursor);


            // ==========================================
            // LIBERAR RECURSOS
            // ==========================================

            oci_free_statement($cursor);
            oci_free_statement($stmt);

            $cursor = null;
            $stmt = null;


            // ==========================================
            // USUARIO NO ENCONTRADO
            // ==========================================

            if (!$usuario) {

                return [
                    'success' => false,
                    'mensaje' =>
                        'Correo o contraseña incorrectos.'
                ];
            }


            // ==========================================
            // LOGIN CORRECTO
            // ==========================================

            return [
                'success' => true,
                'usuario' => $usuario
            ];


        } catch (Throwable $e) {


            if ($cursor) {
                oci_free_statement($cursor);
            }


            if ($stmt) {
                oci_free_statement($stmt);
            }


            return [
                'success' => false,
                'mensaje' =>
                    'Error al iniciar sesión: '
                    . $e->getMessage()
            ];
        }
    }
}