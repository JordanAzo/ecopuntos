<?php
$pageTitle = 'Registro | EcoPuntos CR';
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
                <h1>Únete al cambio sostenible.</h1>
                <p>
                    Registra tus materiales reciclables, acumula EcoPuntos y gana recompensas por ayudar a cuidar el ambiente.
                </p>
                <ul>
                    <li>Reciclaje seguro y medible</li>
                    <li>EcoPuntos por entregas</li>
                    <li>Recompensas en comercios aliados</li>
                </ul>
            </aside>

            <div class="register-form-wrap">
                <div class="form-header">
                    <h2>Registro</h2>
                    <p>Crea tu cuenta y empieza a reciclar con beneficios.</p>
                </div>

                <!-- ALERTA DE ERROR -->
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= htmlspecialchars($_GET['error']) ?>
                    </div>
                <?php endif; ?>

                <!-- ALERTA DE ÉXITO -->
                <?php if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'registrado'): ?>
                    <div class="alert alert-success" role="alert">
                        ¡Registro exitoso! Ya puedes iniciar sesión.
                    </div>
                <?php endif; ?>

                <form id="formRegistro" method="post" action="../controller/controlleregistro.php" novalidate>
                    <div class="form-grid">
                        <div class="field">
                            <label for="nombre">Nombre</label>
                            <input id="nombre" name="nombre" type="text" placeholder="Tu nombre" required>
                            <div class="error-message" id="nombreError"></div>
                        </div>

                        <div class="field">
                            <label for="primerApellido">Primer apellido</label>
                            <input id="primerApellido" name="primerApellido" type="text" placeholder="Primer apellido" required>
                            <div class="error-message" id="primerApellidoError"></div>
                        </div>

                        <div class="field full">
                            <label for="correo">Correo electrónico</label>
                            <input id="correo" name="correo" type="email" placeholder="ejemplo@correo.com" required>
                            <div class="error-message" id="correoError"></div>
                        </div>

                        <div class="field">
                            <label for="telefono">Teléfono</label>
                            <input id="telefono" name="telefono" type="tel" placeholder="8888-9999">
                            <div class="error-message" id="telefonoError"></div>
                        </div>

                        <div class="field">
                            <label for="clave">Contraseña</label>
                            <input id="clave" name="clave" type="password" placeholder="Mínimo 6 caracteres" required>
                            <div class="error-message" id="claveError"></div>
                        </div>

                        <div class="field full">
                            <label for="segundoApellido">Segundo apellido</label>
                            <input id="segundoApellido" name="segundoApellido" type="text" placeholder="Segundo apellido (opcional)">
                            <div class="error-message" id="segundoApellidoError"></div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" name="btnRegistrar" class="btn btn-primary">Crear cuenta</button>
                        <div class="form-link">
                            ¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/registro.js"></script>
</body>
</html>