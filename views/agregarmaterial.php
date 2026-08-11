<?php
$pageTitle = 'Agregar material | EcoPuntos CR';
$tipoMensaje = $_GET['tipo'] ?? '';
$mensajeVista = $_GET['mensaje'] ?? '';
$claseAlerta = '';

if ($tipoMensaje === 'exito') {
    $claseAlerta = 'alert-success';
} elseif ($tipoMensaje === 'error') {
    $claseAlerta = 'alert-danger';
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
    <style>
        body {
            background: linear-gradient(135deg, #0d3b2c 0%, #1c6d46 45%, #0d3b2c 100%);
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

        .form-header {
            margin-bottom: 28px;
        }

        .form-grid {
            gap: 28px;
        }

        .field {
            gap: 10px;
        }

        .field input {
            padding: 16px 18px;
            font-size: 1rem;
        }

        .form-actions {
            margin-top: 30px;
            gap: 18px;
        }

        .btn-primary {
            padding: 16px 28px;
            font-size: 1.05rem;
        }

        .register-panel h1 {
            margin-bottom: 18px;
        }

        .register-panel ul {
            margin-top: 28px;
            gap: 14px;
        }

        @media (max-width: 820px) {
            .register-shell {
                width: min(95%, 680px);
            }
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
                <h1>Agregar nuevo material.</h1>
                <p>
                    Registra un material reciclable para que el sistema asigne sus EcoPuntos y su ahorro de CO₂ por kilogramo.
                </p>
                <ul>
                    <li>Define el nombre del material</li>
                    <li>Configura puntos por kilogramo</li>
                    <li>Calcula el impacto ecológico</li>
                </ul>
            </aside>

            <div class="register-form-wrap">
                <div class="form-header">
                    <h2>Material reciclable</h2>
                    <p>Completa la información para agregar un nuevo tipo de material.</p>
                </div>

                <?php if ($tipoMensaje !== ''): ?>
                    <div class="alert <?= htmlspecialchars($claseAlerta, ENT_QUOTES, 'UTF-8') ?> alert-dismissible fade show" role="alert">
                        <?= htmlspecialchars($mensajeVista, ENT_QUOTES, 'UTF-8') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                    </div>
                <?php endif; ?>

                <form id="formAgregarMaterial" method="post" action="../controller/controlleragregarmaterial.php" novalidate>
                    <div class="form-grid">
                        <div class="field full">
                            <label for="nombreMaterial">Nombre del material</label>
                            <input id="nombreMaterial" name="nombreMaterial" type="text" placeholder="Ejemplo: Papel reciclado" required>
                            <div class="error-message" id="nombreMaterialError"></div>
                        </div>

                        <div class="field">
                            <label for="puntosPorKg">kilogramos a reciclar</label>
                            <input id="puntosPorKg" name="puntosPorKg" type="number" min="0" step="0.01" placeholder="Ejemplo: 12.50" required>
                            <div class="error-message" id="puntosPorKgError"></div>
                        </div>

                        <div class="field">
                            <label for="co2AhorroPorKg">Tipo de material</label>
                            <input id="co2AhorroPorKg" name="co2AhorroPorKg" type="text" placeholder="Ejemplo: Plástico" required>
                            <div class="error-message" id="co2AhorroPorKgError"></div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" name="btnAgregarMaterial" class="btn btn-primary">Guardar material</button>
                        <div class="form-link">
                            <a href="inicio.php">Volver al inicio</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
