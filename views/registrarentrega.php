<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (
    empty($_SESSION['autenticado']) ||
    $_SESSION['autenticado'] !== true ||
    empty($_SESSION['usuario_id'])
) {
    header('Location: login.php');
    exit;
}

require_once __DIR__ . '/../model/catalogosmodelo.php';

$pageTitle = 'Registrar entrega | EcoPuntos CR';

$centros = [];
$materiales = [];

try {
    $centros = CatalogosModel::obtenerCentros();
    $materiales = CatalogosModel::obtenerMateriales();
} catch (Throwable $e) {
    $errorCarga = 'No se pudieron cargar los datos de Oracle.';
}

$mensajeExito = $_SESSION['mensaje_entrega'] ?? '';
$puntosEntrega = $_SESSION['puntos_entrega'] ?? 0;
$errorEntrega = $_SESSION['error_entrega'] ?? '';

unset(
    $_SESSION['mensaje_entrega'],
    $_SESSION['puntos_entrega'],
    $_SESSION['error_entrega']
);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars($pageTitle) ?></title>

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
            width: min(1100px, 95%);
            min-height: 75vh;
            border-radius: 30px;
        }

        .register-layout {
            min-height: 75vh;
        }

        .register-panel {
            padding: 55px 40px;
        }

        .register-form-wrap {
            padding: 50px 42px;
        }

        .field select,
        .field input {
            width: 100%;
            border: 1px solid var(--eco-border);
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

        .material-info {
            margin-top: 6px;
            color: var(--eco-muted);
            font-size: 0.85rem;
        }

        .success-points {
            font-weight: 700;
            color: #0d6b45;
        }
    </style>
</head>

<body>

<div class="register-shell">

    <div class="register-layout">

        <aside class="register-panel">

            <div class="brand">
                <span class="brand-mark">E</span>
                <span>EcoPuntos CR</span>
            </div>

            <h1>Registrar entrega.</h1>

            <p>
                Registra los materiales reciclables entregados
                y recibe EcoPuntos según el peso y el tipo de material.
            </p>

            <ul>
                <li>Selecciona el centro de acopio</li>
                <li>Selecciona el material reciclado</li>
                <li>Ingresa el peso en kilogramos</li>
                <li>Recibe EcoPuntos automáticamente</li>
            </ul>

        </aside>


        <div class="register-form-wrap">

            <div class="form-header">

                <h2>Nueva entrega</h2>

                <p>
                    Los datos se registrarán directamente
                    en la base de datos de EcoPuntos CR.
                </p>

            </div>


            <?php if (!empty($mensajeExito)): ?>

                <div class="alert alert-success">

                    <?= htmlspecialchars($mensajeExito) ?>

                    <?php if ($puntosEntrega > 0): ?>

                        <div class="success-points mt-2">

                            +<?= htmlspecialchars($puntosEntrega) ?>
                            EcoPuntos

                        </div>

                    <?php endif; ?>

                </div>

            <?php endif; ?>


            <?php if (!empty($errorEntrega)): ?>

                <div class="alert alert-danger">

                    <?= htmlspecialchars($errorEntrega) ?>

                </div>

            <?php endif; ?>


            <?php if (!empty($errorCarga)): ?>

                <div class="alert alert-danger">

                    <?= htmlspecialchars($errorCarga) ?>

                </div>

            <?php endif; ?>


            <form
                method="POST"
                action="../controller/controllerregistrarentrega.php"
            >

                <div class="form-grid">


                    <div class="field full">

                        <label for="id_centro">
                            Centro de acopio
                        </label>

                        <select
                            id="id_centro"
                            name="id_centro"
                            required
                        >

                            <option value="">
                                Seleccione un centro
                            </option>

                            <?php foreach ($centros as $centro): ?>

                                <option
                                    value="<?= htmlspecialchars($centro['ID_CENTRO']) ?>"
                                >

                                    <?= htmlspecialchars(
                                        $centro['NOMBRE_CENTRO']
                                    ) ?>

                                    -
                                    <?= htmlspecialchars(
                                        $centro['PROVINCIA']
                                    ) ?>

                                    <?= !empty($centro['CANTON'])
                                        ? ', ' . htmlspecialchars($centro['CANTON'])
                                        : ''
                                    ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>


                    <div class="field full">

                        <label for="id_material">
                            Material reciclable
                        </label>

                        <select
                            id="id_material"
                            name="id_material"
                            required
                        >

                            <option value="">
                                Seleccione un material
                            </option>

                            <?php foreach ($materiales as $material): ?>

                                <option
                                    value="<?= htmlspecialchars(
                                        $material['ID_MATERIAL']
                                    ) ?>"
                                >

                                    <?= htmlspecialchars(
                                        $material['NOMBRE_MATERIAL']
                                    ) ?>

                                    -
                                    <?= htmlspecialchars(
                                        $material['PUNTOS_POR_KG']
                                    ) ?>
                                    puntos/kg

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>


                    <div class="field full">

                        <label for="peso_kg">
                            Peso entregado (kg)
                        </label>

                        <input
                            id="peso_kg"
                            name="peso_kg"
                            type="number"
                            min="0.01"
                            step="0.01"
                            placeholder="Ejemplo: 3.50"
                            required
                        >

                        <div class="material-info">
                            Los EcoPuntos se calcularán automáticamente
                            según el material seleccionado.
                        </div>

                    </div>

                </div>


                <div class="form-actions">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Registrar entrega
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
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

</body>

</html>