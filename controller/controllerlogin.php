<?php

session_start();

require_once __DIR__ . '/../model/loginmodelo.php';



if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header(
        'Location: ../views/login.php'
    );

    exit;
}




$correo = trim(
    $_POST['correo'] ?? ''
);

$clave = $_POST['clave'] ?? '';




if (
    $correo === '' ||
    $clave === ''
) {

    header(
        'Location: ../views/login.php?' .
        http_build_query([
            'tipo' => 'error',
            'mensaje' =>
                'Debe ingresar el correo y la contraseña.'
        ])
    );

    exit;
}




if (
    !filter_var(
        $correo,
        FILTER_VALIDATE_EMAIL
    )
) {

    header(
        'Location: ../views/login.php?' .
        http_build_query([
            'tipo' => 'error',
            'mensaje' =>
                'El correo electrónico no es válido.'
        ])
    );

    exit;
}



$resultado = LoginModel::iniciarSesion(
    $correo,
    $clave
);




if (!$resultado['success']) {

    header(
        'Location: ../views/login.php?' .
        http_build_query([
            'tipo' => 'error',
            'mensaje' =>
                $resultado['mensaje']
        ])
    );

    exit;
}




$usuario = $resultado['usuario'];




session_regenerate_id(true);


$_SESSION['autenticado'] = true;


$_SESSION['usuario_id'] =
    $usuario['ID_USUARIO'];


$_SESSION['usuario_nombre'] =
    $usuario['NOMBRE'];


$_SESSION['usuario_primer_apellido'] =
    $usuario['PRIMER_APELLIDO'] ?? '';


$_SESSION['usuario_segundo_apellido'] =
    $usuario['SEGUNDO_APELLIDO'] ?? '';


$_SESSION['usuario_correo'] =
    $usuario['CORREO'];


$_SESSION['usuario_telefono'] =
    $usuario['TELEFONO'] ?? '';


$_SESSION['usuario_estado'] =
    $usuario['ESTADO'] ?? '';




header(
    'Location: ../views/inicio.php'
);

exit;