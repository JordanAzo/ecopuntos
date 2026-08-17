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

require_once __DIR__ . '/../model/misentregasmodelo.php';

$entregas = [];
$error = '';

try {

    $entregas = MisEntregasModel::obtenerEntregasUsuario(
        $_SESSION['usuario_id']
    );

} catch (Throwable $e) {

    $error = 'No se pudieron cargar las entregas.';
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
        Mis entregas | EcoPuntos CR
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
            width: min(1200px, 96%);
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

            color: rgba(
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

        .entregas-grid {
            display: grid;

            grid-template-columns:
                repeat(
                    auto-fit,
                    minmax(310px, 1fr)
                );

            gap: 22px;
        }

        .entrega-card {
            background: white;

            border-radius: 20px;

            padding: 24px;

            border:
                1px solid
                rgba(13, 107, 69, 0.10);

            box-shadow:
                0 10px 25px
                rgba(13, 107, 69, 0.08);
        }

        .entrega-material {
            color: #173f32;

            font-size: 1.35rem;

            font-weight: 800;

            margin-bottom: 5px;
        }

        .entrega-centro {
            color: #0d6b45;

            font-size: 0.9rem;

            font-weight: 700;

            margin-bottom: 18px;
        }

        .entrega-info {
            display: grid;

            grid-template-columns:
                repeat(2, 1fr);

            gap: 12px;
        }

        .info-box {
            background: #f7faf8;

            border-radius: 12px;

            padding: 13px;
        }

        .info-box span {
            display: block;

            color: #718078;

            font-size: 0.72rem;

            text-transform: uppercase;

            margin-bottom: 4px;
        }

        .info-box strong {
            color: #173f32;

            font-size: 0.95rem;
        }

        .puntos-box {
            margin-top: 16px;

            padding: 14px;

            border-radius: 14px;

            background: #e0f4e8;

            color: #0d6b45;

            text-align: center;

            font-weight: 800;
        }

        .empty-message {
            text-align: center;

            padding: 55px 20px;

            color: #60716b;
        }

        @media (max-width: 600px) {

            .page-header,
            .content {
                padding-left: 22px;
                padding-right: 22px;
            }

            .entrega-info {
                grid-template-columns: 1fr;
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
            Mis entregas
        </h1>

        <p>
            Consulta el historial de materiales
            reciclados y los EcoPuntos obtenidos.
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


        <?php if (
            $error === '' &&
            empty($entregas)
        ): ?>

            <div class="empty-message">

                <h3>
                    Todavía no tienes entregas
                </h3>

                <p>
                    Registra tu primera entrega de
                    material reciclable para verla aquí.
                </p>

            </div>


        <?php else: ?>


            <div class="entregas-grid">


                <?php foreach ($entregas as $entrega): ?>


                    <article class="entrega-card">


                        <div class="entrega-material">

                            <?= htmlspecialchars(
                                $entrega['NOMBRE_MATERIAL']
                            ) ?>

                        </div>


                        <div class="entrega-centro">

                            <?= htmlspecialchars(
                                $entrega['NOMBRE_CENTRO']
                            ) ?>

                        </div>


                        <div class="entrega-info">


                            <div class="info-box">

                                <span>
                                    Peso reciclado
                                </span>

                                <strong>

                                    <?= number_format(
                                        (float) $entrega['PESO_KG'],
                                        2
                                    ) ?>
                                    kg

                                </strong>

                            </div>


                            <div class="info-box">

                                <span>
                                    Fecha
                                </span>

                                <strong>

                                    <?= htmlspecialchars(
                                        $entrega['FECHA_ENTREGA']
                                    ) ?>

                                </strong>

                            </div>


                            <div class="info-box">

                                <span>
                                    Provincia
                                </span>

                                <strong>

                                    <?= htmlspecialchars(
                                        $entrega['PROVINCIA']
                                    ) ?>

                                </strong>

                            </div>


                            <div class="info-box">

                                <span>
                                    Cantón
                                </span>

                                <strong>

                                    <?= htmlspecialchars(
                                        $entrega['CANTON']
                                    ) ?>

                                </strong>

                            </div>


                        </div>


                        <div class="puntos-box">

                            +<?= number_format(
                                (float)
                                $entrega['PUNTOS_GENERADOS']
                            ) ?>
                            EcoPuntos

                        </div>


                    </article>


                <?php endforeach; ?>


            </div>


        <?php endif; ?>


    </main>


</div>

</body>

</html>