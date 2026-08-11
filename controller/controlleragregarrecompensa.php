<?php

require_once __DIR__
    . '/../model/agregarrecompensamodelo.php';




if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header(
        'Location: ../views/agregarrecompensa.php'
    );

    exit;
}



$nombreComercio = trim(
    $_POST['nombreComercio'] ?? ''
);


$titulo = trim(
    $_POST['titulo'] ?? ''
);


$descripcion = trim(
    $_POST['descripcion'] ?? ''
);


$puntosRequeridos = trim(
    $_POST['puntosRequeridos'] ?? ''
);


$stockDisponible = trim(
    $_POST['stockDisponible'] ?? ''
);



if (
    $nombreComercio === '' ||
    $titulo === '' ||
    $descripcion === '' ||
    $puntosRequeridos === '' ||
    $stockDisponible === ''
) {

    header(
        'Location: ../views/agregarrecompensa.php?' .
        http_build_query([
            'tipo' => 'error',
            'mensaje' =>
                'Debe completar todos los campos.'
        ])
    );

    exit;
}




if (
    !is_numeric($puntosRequeridos) ||
    !is_numeric($stockDisponible)
) {

    header(
        'Location: ../views/agregarrecompensa.php?' .
        http_build_query([
            'tipo' => 'error',
            'mensaje' =>
                'Los puntos y la cantidad deben ser valores numéricos.'
        ])
    );

    exit;
}



$puntosRequeridos =
    (int)$puntosRequeridos;

$stockDisponible =
    (int)$stockDisponible;




if ($puntosRequeridos <= 0) {

    header(
        'Location: ../views/agregarrecompensa.php?' .
        http_build_query([
            'tipo' => 'error',
            'mensaje' =>
                'Los puntos requeridos deben ser mayores a cero.'
        ])
    );

    exit;
}


if ($stockDisponible < 0) {

    header(
        'Location: ../views/agregarrecompensa.php?' .
        http_build_query([
            'tipo' => 'error',
            'mensaje' =>
                'El stock no puede ser negativo.'
        ])
    );

    exit;
}




$resultado =
    RecompensaModel::registrarRecompensa(
        $nombreComercio,
        $titulo,
        $descripcion,
        $puntosRequeridos,
        $stockDisponible
    );




if ($resultado['success']) {

    $mensajeExito = trim($resultado['mensaje']) !== ''
        ? $resultado['mensaje']
        : 'La recompensa se registró correctamente.';

    header(
        'Location: ../views/agregarrecompensa.php?' .
        http_build_query([
            'tipo' => 'exito',
            'mensaje' => $mensajeExito
        ])
    );

    exit;
}

header(
    'Location: ../views/agregarrecompensa.php?' .
    http_build_query([
        'tipo' => 'error',
        'mensaje' =>
            $resultado['mensaje']
    ])
);

exit;