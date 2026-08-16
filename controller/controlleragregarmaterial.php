<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (
    empty($_SESSION['autenticado']) ||
    $_SESSION['autenticado'] !== true
) {
    header('Location: ../views/login.php');
    exit;
}

$usuarioRol = strtoupper(
    trim($_SESSION['usuario_rol'] ?? '')
);

if ($usuarioRol !== 'ADMIN') {
    header('Location: ../views/inicio.php');
    exit;
}


require_once __DIR__
    . '/../model/agregarmaterialmodelo.php';


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header(
        'Location: ../views/agregarmaterial.php'
    );

    exit;
}



$nombreMaterial = trim(
    $_POST['nombreMaterial'] ?? ''
);


$kilogramosReciclar = trim(
    $_POST['puntosPorKg'] ?? ''
);


$tipoMaterial = trim(
    $_POST['co2AhorroPorKg'] ?? ''
);



if (
    $nombreMaterial === '' ||
    $kilogramosReciclar === '' ||
    $tipoMaterial === ''
) {

    header(
        'Location: ../views/agregarmaterial.php?' .
        http_build_query([
            'tipo' => 'error',
            'mensaje' =>
                'Debe completar todos los campos.'
        ])
    );

    exit;
}



if (!is_numeric($kilogramosReciclar)) {

    header(
        'Location: ../views/agregarmaterial.php?' .
        http_build_query([
            'tipo' => 'error',
            'mensaje' =>
                'Los kilogramos deben ser un valor numérico.'
        ])
    );

    exit;
}



$kilogramosReciclar = (float)$kilogramosReciclar;


if ($kilogramosReciclar < 0) {

    header(
        'Location: ../views/agregarmaterial.php?' .
        http_build_query([
            'tipo' => 'error',
            'mensaje' =>
                'Los kilogramos no pueden ser negativos.'
        ])
    );

    exit;
}




$resultado = MaterialModel::registrarMaterial(
    $nombreMaterial,
    $kilogramosReciclar,
    $tipoMaterial
);




if ($resultado['success']) {

    $mensajeExito = trim($resultado['mensaje']) !== ''
        ? $resultado['mensaje']
        : 'La información del material se guardó correctamente.';

    header(
        'Location: ../views/agregarmaterial.php?' .
        http_build_query([
            'tipo' => 'exito',
            'mensaje' => $mensajeExito
        ])
    );

    exit;
}




header(
    'Location: ../views/agregarmaterial.php?' .
    http_build_query([
        'tipo' => 'error',
        'mensaje' =>
            $resultado['mensaje']
    ])
);

exit;