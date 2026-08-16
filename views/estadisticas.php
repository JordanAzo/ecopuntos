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

if ($usuarioRol !== 'ADMIN') {
    header('Location: inicio.php');
    exit;
}

require_once __DIR__ . '/../model/estadisticasmodelo.php';
require_once __DIR__ . '/../model/estadisticasadminmodelo.php';

$estadisticas = [
    'material' => 0,
    'co2' => 0,
    'usuarios' => 0,
    'entregas' => 0
];

$centros = [];

$error = '';

try {

    $estadisticas =
        EstadisticasModel::obtenerEstadisticas();

    $centros =
        EstadisticasAdminModel::obtenerEstadisticasCentros();

} catch (Throwable $e) {

    $error =
        'No se pudieron cargar las estadísticas.';
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
        Estadísticas | EcoPuntos CR
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
            width: min(1250px, 96%);
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

        .stats-grid {
            display: grid;

            grid-template-columns:
                repeat(4, 1fr);

            gap: 18px;

            margin-bottom: 35px;
        }

        .stat-card {
            background: white;

            border-radius: 18px;

            padding: 24px 18px;

            text-align: center;

            border:
                1px solid
                rgba(13, 107, 69, 0.10);

            box-shadow:
                0 10px 25px
                rgba(13, 107, 69, 0.08);
        }

        .stat-card strong {
            display: block;

            color: #0d6b45;

            font-size: 1.8rem;

            font-weight: 900;

            margin-bottom: 7px;
        }

        .stat-card span {
            color: #65756f;

            font-size: 0.82rem;

            font-weight: 700;
        }

        .section-title {
            color: #173f32;

            font-size: 1.5rem;

            font-weight: 800;

            margin-bottom: 18px;
        }

        .table-shell {
            background: white;

            border-radius: 20px;

            overflow-x: auto;

            border:
                1px solid
                rgba(13, 107, 69, 0.10);

            box-shadow:
                0 10px 25px
                rgba(13, 107, 69, 0.07);
        }

        table {
            width: 100%;

            border-collapse: collapse;
        }

        thead {
            background: #e2f2e8;
        }

        th {
            color: #0d6b45;

            font-size: 0.8rem;

            text-transform: uppercase;

            padding: 16px 14px;

            text-align: left;

            white-space: nowrap;
        }

        td {
            color: #334c43;

            padding: 16px 14px;

            border-top:
                1px solid
                rgba(13, 107, 69, 0.08);

            white-space: nowrap;
        }

        tbody tr:hover {
            background: #f4faf6;
        }

        .empty-message {
            padding: 40px;

            text-align: center;

            color: #65756f;
        }

        @media (max-width: 900px) {

            .stats-grid {
                grid-template-columns:
                    repeat(2, 1fr);
            }

        }

        @media (max-width: 550px) {

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
            Estadísticas
        </h1>

        <p>
            Consulta el comportamiento general del sistema
            y el rendimiento de los centros de acopio.
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


        <section class="stats-grid">


            <div class="stat-card">

                <strong>

                    <?= number_format(
                        $estadisticas['material'],
                        2
                    ) ?>
                    kg

                </strong>

                <span>
                    Material reciclado
                </span>

            </div>


            <div class="stat-card">

                <strong>

                    <?= number_format(
                        $estadisticas['co2'],
                        2
                    ) ?>
                    kg

                </strong>

                <span>
                    CO₂ ahorrado
                </span>

            </div>


            <div class="stat-card">

                <strong>

                    <?= number_format(
                        $estadisticas['usuarios']
                    ) ?>

                </strong>

                <span>
                    Usuarios activos
                </span>

            </div>


            <div class="stat-card">

                <strong>

                    <?= number_format(
                        $estadisticas['entregas']
                    ) ?>

                </strong>

                <span>
                    Entregas realizadas
                </span>

            </div>


        </section>


        <h2 class="section-title">
            Estadísticas por centro de acopio
        </h2>


        <?php if (empty($centros)): ?>

            <div class="empty-message">

                No existen estadísticas de centros
                disponibles actualmente.

            </div>

        <?php else: ?>


            <div class="table-shell">

                <table>

                    <thead>

                        <tr>

                            <th>
                                Centro
                            </th>

                            <th>
                                Provincia
                            </th>

                            <th>
                                Visitas
                            </th>

                            <th>
                                Kg recolectados
                            </th>

                            <th>
                                EcoPuntos otorgados
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                        <?php foreach ($centros as $centro): ?>


                            <tr>

                                <td>

                                    <?= htmlspecialchars(
                                        $centro['NOMBRE_CENTRO']
                                    ) ?>

                                </td>


                                <td>

                                    <?= htmlspecialchars(
                                        $centro['PROVINCIA']
                                    ) ?>

                                </td>


                                <td>

                                    <?= number_format(
                                        $centro['TOTAL_VISITAS']
                                    ) ?>

                                </td>


                                <td>

                                    <?= number_format(
                                        (float)
                                        $centro[
                                            'TOTAL_KG_RECOLECTADOS'
                                        ],
                                        2
                                    ) ?>
                                    kg

                                </td>


                                <td>

                                    <?= number_format(
                                        $centro[
                                            'TOTAL_PUNTOS_OTORGADOS'
                                        ]
                                    ) ?>

                                </td>

                            </tr>


                        <?php endforeach; ?>


                    </tbody>

                </table>

            </div>


        <?php endif; ?>


    </main>


</div>

</body>

</html>