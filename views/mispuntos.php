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

$usuarioRol = strtoupper(
    trim($_SESSION['usuario_rol'] ?? '')
);

if ($usuarioRol !== 'CIUDADANO') {
    header('Location: inicio.php');
    exit;
}

require_once __DIR__ . '/../model/mispuntosmodelo.php';
require_once __DIR__ . '/../model/resumenusuariomodelo.php';

$estadisticas = [
    'total_kg' => 0,
    'total_entregas' => 0,
    'nivel' => 'PRINCIPIANTE'
];

$resumenUsuario = [
    'puntos' => 0,
    'cupones' => 0
];

$error = '';

try {

    $estadisticas =
        MisPuntosModel::obtenerEstadisticasUsuario(
            $_SESSION['usuario_id']
        );

    $resumenUsuario =
        ResumenUsuarioModel::obtenerResumen(
            $_SESSION['usuario_id']
        );

} catch (Throwable $e) {

    $error =
        'No se pudo cargar la información de EcoPuntos.';
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
        Mis puntos | EcoPuntos CR
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        body {
            margin: 0;
            min-height: 100vh;

            background: linear-gradient(
                135deg,
                #0d3b2c 0%,
                #1c6d46 45%,
                #0d3b2c 100%
            );

            font-family: Arial, sans-serif;
            padding: 40px 20px;
        }

        .page-shell {
            width: min(1100px, 96%);
            margin: 0 auto;

            background: #f5faf6;

            border-radius: 28px;
            overflow: hidden;

            box-shadow:
                0 25px 55px
                rgba(0, 0, 0, 0.25);
        }

        .page-header {
            background: linear-gradient(
                135deg,
                #0d6b45,
                #1a8e5a
            );

            color: white;
            padding: 36px 40px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;

            font-weight: 800;
            font-size: 1.2rem;
        }

        .brand-mark {
            width: 42px;
            height: 42px;

            border-radius: 50%;

            background: #7ad79c;
            color: #0d3b2c;

            display: flex;
            align-items: center;
            justify-content: center;

            font-weight: 900;
        }

        .page-header h1 {
            margin-top: 28px;
            margin-bottom: 8px;

            font-size: 2.3rem;
            font-weight: 800;
        }

        .page-header p {
            margin: 0;

            color:
                rgba(
                    255,
                    255,
                    255,
                    0.86
                );
        }

        .content {
            padding: 35px 40px 45px;
        }

        .back-link {
            display: inline-block;

            margin-bottom: 25px;

            text-decoration: none;

            color: #0d6b45;

            font-weight: 700;
        }

        .points-main {
            background: linear-gradient(
                135deg,
                #0d6b45,
                #168b58
            );

            color: white;

            border-radius: 22px;

            padding: 32px;

            text-align: center;

            margin-bottom: 24px;
        }

        .points-main span {
            display: block;

            font-size: 0.85rem;

            text-transform: uppercase;

            letter-spacing: 0.06em;

            margin-bottom: 8px;

            color:
                rgba(
                    255,
                    255,
                    255,
                    0.82
                );
        }

        .points-main strong {
            display: block;

            font-size: 3.4rem;

            font-weight: 900;
        }

        .stats-grid {
            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 20px;
        }

        .stat-card {
            background: white;

            border-radius: 18px;

            padding: 24px;

            text-align: center;

            border:
                1px solid
                rgba(13, 107, 69, 0.10);

            box-shadow:
                0 10px 25px
                rgba(13, 107, 69, 0.08);
        }

        .stat-card span {
            display: block;

            color: #718078;

            font-size: 0.78rem;

            text-transform: uppercase;

            margin-bottom: 8px;
        }

        .stat-card strong {
            color: #0d6b45;

            font-size: 1.8rem;

            font-weight: 800;
        }

        .level-box {
            margin-top: 24px;

            background: #e0f4e8;

            border-radius: 18px;

            padding: 22px;

            text-align: center;
        }

        .level-box span {
            display: block;

            color: #60716b;

            font-size: 0.78rem;

            text-transform: uppercase;

            margin-bottom: 6px;
        }

        .level-box strong {
            color: #0d6b45;

            font-size: 1.5rem;
        }

        @media (max-width: 700px) {

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .page-header,
            .content {
                padding-left: 22px;
                padding-right: 22px;
            }

        }

    </style>

</head>


<body>

<div class="page-shell">

    <header class="page-header">

        <div class="brand">

            <span class="brand-mark">
                E
            </span>

            EcoPuntos CR

        </div>

        <h1>
            Mis puntos
        </h1>

        <p>
            Consulta tu saldo actual y el progreso
            que has logrado reciclando.
        </p>

    </header>


    <main class="content">

        <a
            href="inicio.php"
            class="back-link"
        >
            ← Volver al inicio
        </a>


        <?php if ($error !== ''): ?>

            <div class="alert alert-danger">

                <?= htmlspecialchars($error) ?>

            </div>

        <?php endif; ?>


        <section class="points-main">

            <span>
                EcoPuntos disponibles
            </span>

            <strong>
                <?= number_format(
                    $resumenUsuario['puntos']
                ) ?>
            </strong>

        </section>


        <section class="stats-grid">

            <div class="stat-card">

                <span>
                    Total reciclado
                </span>

                <strong>

                    <?= number_format(
                        $estadisticas['total_kg'],
                        2
                    ) ?>
                    kg

                </strong>

            </div>


            <div class="stat-card">

                <span>
                    Entregas realizadas
                </span>

                <strong>

                    <?= number_format(
                        $estadisticas['total_entregas']
                    ) ?>

                </strong>

            </div>


            <div class="stat-card">

                <span>
                    Cupones activos
                </span>

                <strong>

                    <?= number_format(
                        $resumenUsuario['cupones']
                    ) ?>

                </strong>

            </div>

        </section>


        <section class="level-box">

            <span>
                Nivel actual
            </span>

            <strong>

                <?= htmlspecialchars(
                    $estadisticas['nivel']
                ) ?>

            </strong>

        </section>

    </main>

</div>

</body>

</html>