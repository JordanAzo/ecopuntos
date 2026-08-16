<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (
    empty($_SESSION['autenticado']) ||
    $_SESSION['autenticado'] !== true
) {
    header('Location: login.php');
    exit;
}

$usuarioRol = strtoupper(
    trim($_SESSION['usuario_rol'] ?? '')
);

if (!in_array($usuarioRol, ['ADMIN', 'COMERCIO'], true)) {
    header('Location: inicio.php');
    exit;
}

require_once __DIR__ . '/../model/catalogosmodelo.php';

$mensaje = $_GET['mensaje'] ?? '';
$tipo = $_GET['tipo'] ?? '';

$comercios = [];
$comercioUsuario = null;
$errorComercio = '';

try {

    if ($usuarioRol === 'ADMIN') {

        $comercios = CatalogosModel::obtenerComercios();

    } elseif ($usuarioRol === 'COMERCIO') {

        $comercioUsuario =
            CatalogosModel::obtenerComercioPorUsuario(
                $_SESSION['usuario_id']
            );

        if (!$comercioUsuario) {
            $errorComercio =
                'No existe un comercio asociado a este usuario.';
        }
    }

} catch (Throwable $e) {

    $errorComercio =
        'No se pudieron cargar los comercios.';
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Agregar recompensa | EcoPuntos CR
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="../assets/css/registro.css"
    >

    <style>

        body {
            background: linear-gradient(
                135deg,
                #0d3b2c 0%,
                #1c6d46 45%,
                #0d3b2c 100%
            );

            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 0;
        }

        .register-shell {
            width: min(1200px, 96%);
            min-height: 82vh;
            border-radius: 30px;
        }

        .register-layout {
            min-height: 82vh;
        }

        .register-panel {
            padding: 60px 42px;
        }

        .register-form-wrap {
            padding: 52px 42px;
        }

        .field select,
        .field input {
            width: 100%;
            border: 1px solid #d7e4dc;
            border-radius: 12px;
            background: #f9fcfa;
            padding: 14px 16px;
            font-size: 1rem;
        }

        .field select:focus,
        .field input:focus {
            outline: none;
            border-color: rgba(13, 107, 69, 0.5);
            box-shadow: 0 0 0 4px rgba(13, 107, 69, 0.08);
        }

        .comercio-fijo {
            background: #eef6f1 !important;
            color: #0d6b45;
            font-weight: 700;
        }

    </style>

</head>


<body>

<div class="register-shell">

    <div class="register-layout">


        <aside class="register-panel">

            <div class="brand">

                <span class="brand-mark">
                    E
                </span>

                <span>
                    EcoPuntos CR
                </span>

            </div>


            <h1>
                Nueva recompensa
            </h1>


            <p>
                Registra beneficios que los usuarios
                podrán canjear utilizando sus EcoPuntos.
            </p>


            <ul>

                <li>
                    Recompensas de comercios afiliados
                </li>

                <li>
                    Canje mediante EcoPuntos
                </li>

                <li>
                    Control de disponibilidad
                </li>

            </ul>

        </aside>


        <div class="register-form-wrap">


            <div class="form-header">

                <h2>
                    Registrar recompensa
                </h2>

                <p>
                    Completa la información de la recompensa.
                </p>

            </div>


            <?php if ($mensaje !== ''): ?>

                <div
                    class="alert <?= $tipo === 'exito'
                        ? 'alert-success'
                        : 'alert-danger'
                    ?>"
                >

                    <?= htmlspecialchars($mensaje) ?>

                </div>

            <?php endif; ?>


            <?php if ($errorComercio !== ''): ?>

                <div class="alert alert-danger">

                    <?= htmlspecialchars($errorComercio) ?>

                </div>

            <?php endif; ?>


            <form
                id="formAgregarRecompensa"
                method="post"
                action="../controller/controlleragregarrecompensa.php"
            >


                <div class="form-grid">


                    <div class="field full">

                        <label for="nombreComercio">
                            Comercio
                        </label>


                        <?php if ($usuarioRol === 'ADMIN'): ?>

                            <select
                                id="nombreComercio"
                                name="nombreComercio"
                                required
                            >

                                <option value="">
                                    Seleccione un comercio
                                </option>

                                <?php foreach ($comercios as $comercio): ?>

                                    <option
                                        value="<?= htmlspecialchars(
                                            $comercio['NOMBRE_COMERCIO']
                                        ) ?>"
                                    >

                                        <?= htmlspecialchars(
                                            $comercio['NOMBRE_COMERCIO']
                                        ) ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>


                        <?php elseif (
                            $usuarioRol === 'COMERCIO' &&
                            $comercioUsuario
                        ): ?>

                            <input
                                type="text"
                                class="comercio-fijo"
                                value="<?= htmlspecialchars(
                                    $comercioUsuario['NOMBRE_COMERCIO']
                                ) ?>"
                                readonly
                            >

                            <input
                                type="hidden"
                                name="nombreComercio"
                                value="<?= htmlspecialchars(
                                    $comercioUsuario['NOMBRE_COMERCIO']
                                ) ?>"
                            >

                        <?php endif; ?>

                    </div>


                    <div class="field full">

                        <label for="titulo">
                            Título de la recompensa
                        </label>

                        <input
                            id="titulo"
                            name="titulo"
                            type="text"
                            placeholder="Ejemplo: Café gratis"
                            maxlength="150"
                            required
                        >

                    </div>


                    <div class="field full">

                        <label for="descripcion">
                            Descripción
                        </label>

                        <input
                            id="descripcion"
                            name="descripcion"
                            type="text"
                            placeholder="Ejemplo: Café americano gratuito"
                            maxlength="500"
                            required
                        >

                    </div>


                    <div class="field">

                        <label for="puntosRequeridos">
                            Puntos requeridos
                        </label>

                        <input
                            id="puntosRequeridos"
                            name="puntosRequeridos"
                            type="number"
                            min="1"
                            step="1"
                            placeholder="Ejemplo: 100"
                            required
                        >

                    </div>


                    <div class="field">

                        <label for="stockDisponible">
                            Cantidad disponible
                        </label>

                        <input
                            id="stockDisponible"
                            name="stockDisponible"
                            type="number"
                            min="1"
                            step="1"
                            placeholder="Ejemplo: 20"
                            required
                        >

                    </div>


                </div>


                <div class="form-actions">

                    <button
                        type="submit"
                        class="btn btn-primary"
                        <?= $errorComercio !== '' ? 'disabled' : '' ?>
                    >
                        Guardar recompensa
                    </button>


                    <div class="form-link">

                        <a href="inicio.php">
                            Volver al inicio
                        </a>

                    </div>

                </div>


            </form>


        </div>

    </div>

</div>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>

</body>

</html>
