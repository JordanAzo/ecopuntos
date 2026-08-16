<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../model/canjearrecompensamodelo.php';

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

if ($usuarioRol !== 'CIUDADANO') {
    header('Location: ../views/inicio.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../views/recompensas.php');
    exit;
}

$idUsuario = (int) $_SESSION['usuario_id'];

$idRecompensa = isset($_POST['id_recompensa'])
    ? (int) $_POST['id_recompensa']
    : 0;

if ($idRecompensa <= 0) {
    $_SESSION['error_canje'] =
        'La recompensa seleccionada no es válida.';

    header('Location: ../views/recompensas.php');
    exit;
}

try {

    $resultado = CanjearRecompensaModel::canjear(
        $idUsuario,
        $idRecompensa
    );

    $mensaje = $resultado['mensaje'] ?? '';
    $codigoCupon = $resultado['codigo_cupon'] ?? '';

    if (str_starts_with($mensaje, 'OK:')) {

        $_SESSION['mensaje_canje'] = $mensaje;
        $_SESSION['codigo_cupon'] = $codigoCupon;

        header(
            'Location: ../views/recompensas.php?success=1'
        );
        exit;
    }

    $_SESSION['error_canje'] =
        $mensaje !== ''
            ? $mensaje
            : 'No se pudo realizar el canje.';

    header(
        'Location: ../views/recompensas.php?error=1'
    );
    exit;

} catch (Throwable $e) {

    $_SESSION['error_canje'] =
        'Error al realizar el canje: ' .
        $e->getMessage();

    header(
        'Location: ../views/recompensas.php?error=1'
    );
    exit;
}