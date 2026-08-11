<?php
require_once __DIR__ . '/../model/registromodelo.php';

if (isset($_POST['btnRegistrar'])) {
    $nombre = trim($_POST['nombre'] ?? '');
    $primerApellido = trim($_POST['primerApellido'] ?? '');
    $segundoApellido = trim($_POST['segundoApellido'] ?? '');
    $correo = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_EMAIL);
    $telefono = trim($_POST['telefono'] ?? '');
    $clavePlana = $_POST['clave'] ?? '';

    if ($nombre === '' || $primerApellido === '' || $correo === '' || $clavePlana === '') {
        $_POST['Mensaje'] = 'Debe completar nombre, apellido, correo y contraseña.';
        header('Location: ../views/registro.php?error=datos_incompletos');
        exit;
    }

    $resultado = UsuarioModel::registrarUsuario(
        $nombre,
        $primerApellido,
        $segundoApellido,
        $correo,
        $clavePlana,
        $telefono
    );

    if ($resultado['success']) {
        header('Location: ../views/login.php?mensaje=registrado');
        exit;
    } else {
        $_POST['Mensaje'] = 'Error: ' . $resultado['mensaje'];
        header('Location: ../views/registro.php?error=' . urlencode($resultado['mensaje']));
        exit;
    }
}
?>