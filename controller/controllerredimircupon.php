<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (
    empty($_SESSION['autenticado']) ||
    $_SESSION['autenticado'] !== true ||
    empty($_SESSION['usuario_id'])
) {
    header('Location: ../views/login.php');
    exit;
}

$usuarioRol = strtoupper(
    trim($_SESSION['usuario_rol'] ?? '')
);

if ($usuarioRol !== 'COMERCIO') {
    header('Location: ../views/inicio.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../views/redimircupon.php');
    exit;
}

require_once __DIR__ . '/../model/redimircuponmodelo.php';
require_once __DIR__ . '/../model/catalogosmodelo.php';

$codigoCupon = trim(
    $_POST['codigo_cupon'] ?? ''
);

if ($codigoCupon === '') {

    $_SESSION['redimir_error'] =
        'Debe ingresar el código del cupón.';

    header(
        'Location: ../views/redimircupon.php'
    );

    exit;
}

try {

    $comercio =
        CatalogosModel::obtenerComercioPorUsuario(
            $_SESSION['usuario_id']
        );

    if (!$comercio) {

        $_SESSION['redimir_error'] =
            'No existe un comercio asociado a esta cuenta.';

        header(
            'Location: ../views/redimircupon.php'
        );

        exit;
    }

    $resultado =
        RedimirCuponModel::redimirCupon(
            $codigoCupon,
            $comercio['ID_COMERCIO']
        );

    if ($resultado['success']) {

        $_SESSION['redimir_exito'] =
            $resultado['mensaje'];

    } else {

        $_SESSION['redimir_error'] =
            $resultado['mensaje'];
    }

} catch (Throwable $e) {

    $_SESSION['redimir_error'] =
        'No se pudo procesar el cupón.';
}

header(
    'Location: ../views/redimircupon.php'
);

exit;