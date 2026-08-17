<?php

session_start();

require_once __DIR__ . '/../model/registrarentregamodelo.php';

if (
    empty($_SESSION['autenticado']) ||
    $_SESSION['autenticado'] !== true ||
    empty($_SESSION['usuario_id'])
) {
    header('Location: ../views/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../views/registrarentrega.php');
    exit;
}

$idUsuario = (int) $_SESSION['usuario_id'];

$idCentro = isset($_POST['id_centro'])
    ? (int) $_POST['id_centro']
    : 0;

$idMaterial = isset($_POST['id_material'])
    ? (int) $_POST['id_material']
    : 0;

$pesoKg = isset($_POST['peso_kg'])
    ? (float) str_replace(',', '.', $_POST['peso_kg'])
    : 0;


if (
    $idCentro <= 0 ||
    $idMaterial <= 0 ||
    $pesoKg <= 0
) {
    header(
        'Location: ../views/registrarentrega.php?error=datos_invalidos'
    );
    exit;
}


try {

    $resultado = RegistrarEntregaModel::registrarEntrega(
        $idUsuario,
        $idCentro,
        $idMaterial,
        $pesoKg
    );

    if (
        isset($resultado['mensaje']) &&
        str_starts_with($resultado['mensaje'], 'OK:')
    ) {

        $_SESSION['mensaje_entrega'] =
            $resultado['mensaje'];

        $_SESSION['puntos_entrega'] =
            $resultado['puntos'];

        header(
            'Location: ../views/registrarentrega.php?success=1'
        );
        exit;
    }


    $_SESSION['error_entrega'] =
        $resultado['mensaje'] ?? 'No se pudo registrar la entrega.';

    header(
        'Location: ../views/registrarentrega.php?error=oracle'
    );
    exit;


} catch (Throwable $e) {

    $_SESSION['error_entrega'] =
        'Error al registrar la entrega: ' . $e->getMessage();

    header(
        'Location: ../views/registrarentrega.php?error=sistema'
    );
    exit;
}