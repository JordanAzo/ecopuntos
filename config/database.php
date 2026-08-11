<?php

class Database
{
    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance === null) {

            if (!function_exists('oci_connect')) {
                throw new Exception(
                    'La extensión OCI8 de PHP no está habilitada.'
                );
            }

            // Usuario de Oracle
            $username = getenv('DB_USERNAME');

            if ($username === false || $username === '') {
                $username = 'ECOPUNTOS_USER';
            }

            // Contraseña del usuario
            $password = getenv('DB_PASSWORD');

            if ($password === false || $password === '') {
                $password = 'EcoPuntos2026*';
            }

            $password = trim($password);

            // Alias definido en tnsnames.ora
            $service = 'iiq2026_high';

            self::$instance = oci_connect(
                $username,
                $password,
                $service,
                'AL32UTF8'
            );

            if (!self::$instance) {

                $error = oci_error();

                $mensaje =
                    is_array($error) &&
                    isset($error['message'])
                    ? $error['message']
                    : 'No se pudo conectar a Oracle.';

                throw new Exception(
                    'No se pudo conectar a Oracle: '
                    . $mensaje
                );
            }
        }

        return self::$instance;
    }
}