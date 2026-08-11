<?php
session_start();

$pageTitle = 'Iniciar sesión | EcoPuntos CR';

$mensaje = $_GET['mensaje'] ?? '';
$tipo = $_GET['tipo'] ?? '';

if ($mensaje === 'registrado') {
    $mensaje = 'Cuenta creada correctamente. Ahora puedes iniciar sesión.';
    $tipo = 'exito';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/registro.css">
</head>
<body>
    <div class="register-shell">
        <div class="register-layout">
            <aside class="register-panel">
                <div class="brand">
                    <span class="brand-mark">E</span>
                    <span>EcoPuntos CR</span>
                </div>
                <h1>Bienvenido de nuevo.</h1>
                <p>
                    Inicia sesión para consultar tus EcoPuntos, revisar tus entregas y acceder a las recompensas disponibles.
                </p>
                <ul>
                    <li>Consulta tus EcoPuntos</li>
                    <li>Revisa tus entregas</li>
                    <li>Canjea recompensas</li>
                </ul>
            </aside>

            <div class="register-form-wrap">
                <div class="form-header">
                    <h2>Iniciar sesión</h2>
                    <p>Ingresa a tu cuenta de EcoPuntos CR.</p>
                </div>

                <?php if ($mensaje !== ''): ?>
                    <div class="alert <?= $tipo === 'exito' ? 'alert-success' : 'alert-danger' ?>">
                        <?= htmlspecialchars($mensaje) ?>
                    </div>
                <?php endif; ?>

                <form id="formLogin" method="post" action="../controller/controllerlogin.php" novalidate>
                    <div class="form-grid">
                        <div class="field full">
                            <label for="correo">Correo electrónico</label>
                            <input id="correo" name="correo" type="email" placeholder="ejemplo@correo.com" required>
                        </div>

                        <div class="field full">
                            <label for="clave">Contraseña</label>
                            <input id="clave" name="clave" type="password" placeholder="Ingresa tu contraseña" required>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" name="btnIniciarSesion" class="btn btn-primary">Iniciar sesión</button>
                        <div class="form-link">
                            ¿No tienes cuenta? <a href="registro.php">Regístrate</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>