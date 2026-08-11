<?php
require_once __DIR__ . '/../config/database.php';

class UsuarioModel {
    public static function registrarUsuario($nombre, $primerApellido, $segundoApellido, $correo, $clave, $telefono) {
        try {
            $db = Database::getInstance();

            // Incluimos los parámetros de entrada y salida correctamente en el bloque PL/SQL
            $sql = "BEGIN SP_REGISTRAR_USUARIO(
                        :p_nombre,
                        :p_primer_apellido,
                        :p_segundo_apellido,
                        :p_correo,
                        :p_clave,
                        :p_telefono,
                        :o_codigo_respuesta,
                        :o_mensaje_respuesta
                    ); END;";

            $stmt = oci_parse($db, $sql);

            // Bind de parámetros de ENTRADA
            oci_bind_by_name($stmt, ':p_nombre', $nombre, 100);
            oci_bind_by_name($stmt, ':p_primer_apellido', $primerApellido, 100);
            oci_bind_by_name($stmt, ':p_segundo_apellido', $segundoApellido, 100);
            oci_bind_by_name($stmt, ':p_correo', $correo, 150);
            oci_bind_by_name($stmt, ':p_clave', $clave, 256);
            oci_bind_by_name($stmt, ':p_telefono', $telefono, 20);

            // Variables para recibir la SALIDA del SP
            $codigoRespuesta = 0;
            $mensajeRespuesta = '';

            // Bind de parámetros de SALIDA
            oci_bind_by_name($stmt, ':o_codigo_respuesta', $codigoRespuesta, 10);
            oci_bind_by_name($stmt, ':o_mensaje_respuesta', $mensajeRespuesta, 200);

            // Ejecución
            $ejecutado = oci_execute($stmt);

            if (!$ejecutado) {
                $e = oci_error($stmt);
                return [
                    'success' => false,
                    'mensaje' => 'Error de ejecución Oracle: ' . $e['message'],
                ];
            }

            return [
                'success' => (int)$codigoRespuesta === 1,
                'mensaje' => $mensajeRespuesta,
            ];

        } catch (Exception $e) {
            return [
                'success' => false,
                'mensaje' => 'Error en la aplicación: ' . $e->getMessage(),
            ];
        }
    }
}