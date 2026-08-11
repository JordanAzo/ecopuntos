<?php

require_once __DIR__ . '/../config/database.php';


class MaterialModel
{
    public static function registrarMaterial(
        $nombreMaterial,
        $kilogramosReciclar,
        $tipoMaterial
    ) {

        $stmt = null;

        try {

          
            $db = Database::getInstance();


            $sql = "
                BEGIN

                    SP_REGISTRAR_MATERIAL(
                        :p_nombre_material,
                        :p_kilogramos_reciclar,
                        :p_tipo_material,
                        :o_codigo_respuesta,
                        :o_mensaje_respuesta
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


            oci_bind_by_name(
                $stmt,
                ':p_nombre_material',
                $nombreMaterial,
                150
            );


            oci_bind_by_name(
                $stmt,
                ':p_kilogramos_reciclar',
                $kilogramosReciclar
            );


            oci_bind_by_name(
                $stmt,
                ':p_tipo_material',
                $tipoMaterial,
                100
            );


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
                'success' => ((int)$codigoRespuesta === 1),
                'mensaje' => $mensajeRespuesta
            ];


        } catch (Throwable $e) {

            if ($stmt) {
                oci_free_statement($stmt);
            }


            return [
                'success' => false,
                'mensaje' =>
                    'Error al registrar el material: '
                    . $e->getMessage()
            ];
        }
    }
}