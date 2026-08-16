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

require_once __DIR__ . '/../model/miscuponesmodelo.php';

$cupones = [];
$error = '';

try {

    $cupones = MisCuponesModel::obtenerCuponesUsuario(
        $_SESSION['usuario_id']
    );

} catch (Throwable $e) {

    $error = 'No se pudieron cargar los cupones.';
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
        Mis cupones | EcoPuntos CR
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

        .coupons-grid {
            display: grid;

            grid-template-columns:
                repeat(
                    auto-fit,
                    minmax(300px, 1fr)
                );

            gap: 22px;
        }

        .coupon-card {
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

        .coupon-store {
            color: #0d6b45;

            font-size: 0.82rem;

            font-weight: 800;

            text-transform: uppercase;

            margin-bottom: 10px;
        }

        .coupon-title {
            color: #173f32;

            font-size: 1.3rem;

            font-weight: 700;

            margin-bottom: 18px;
        }

        .coupon-code {
            background: #eef7f1;

            border:
                1px dashed
                rgba(13, 107, 69, 0.35);

            border-radius: 14px;

            padding: 16px;

            text-align: center;

            margin-bottom: 18px;
        }

        .coupon-code span {
            display: block;

            color: #60716b;

            font-size: 0.75rem;

            text-transform: uppercase;

            margin-bottom: 5px;
        }

        .coupon-code strong {
            color: #0d6b45;

            font-size: 1.35rem;

            letter-spacing: 0.08em;
        }

        .coupon-info {
            display: grid;

            grid-template-columns:
                repeat(2, 1fr);

            gap: 12px;

            margin-top: 15px;
        }

        .info-box {
            background: #f7faf8;

            border-radius: 12px;

            padding: 12px;
        }

        .info-box span {
            display: block;

            font-size: 0.72rem;

            color: #718078;

            text-transform: uppercase;

            margin-bottom: 4px;
        }

        .info-box strong {
            color: #173f32;

            font-size: 0.9rem;
        }

        .coupon-status {
            display: inline-block;

            margin-top: 18px;

            padding: 7px 13px;

            border-radius: 999px;

            font-size: 0.78rem;

            font-weight: 800;
        }

        .status-disponible {
            background: #d9f3e3;

            color: #0d6b45;
        }

        .status-redimido {
            background: #e5e5e5;

            color: #555;
        }

        .status-expirado {
            background: #f8d7da;

            color: #842029;
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

            .coupon-info {
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
            Mis cupones
        </h1>

        <p>
            Consulta los beneficios que has obtenido
            mediante el canje de EcoPuntos.
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
            empty($cupones)
        ): ?>

            <div class="empty-message">

                <h3>
                    Todavía no tienes cupones
                </h3>

                <p>
                    Canjea una recompensa para obtener
                    tu primer cupón.
                </p>

            </div>


        <?php else: ?>


            <div class="coupons-grid">


                <?php foreach ($cupones as $cupon): ?>


                    <?php

                    $estado = strtoupper(
                        $cupon['ESTADO_CUPON'] ?? ''
                    );

                    $claseEstado =
                        'status-disponible';

                    if ($estado === 'REDIMIDO') {
                        $claseEstado =
                            'status-redimido';
                    }

                    if ($estado === 'EXPIRADO') {
                        $claseEstado =
                            'status-expirado';
                    }

                    ?>


                    <article class="coupon-card">


                        <div class="coupon-store">

                            <?= htmlspecialchars(
                                $cupon['NOMBRE_COMERCIO']
                            ) ?>

                        </div>


                        <div class="coupon-title">

                            <?= htmlspecialchars(
                                $cupon['RECOMPENSA']
                            ) ?>

                        </div>


                        <div class="coupon-code">

                            <span>
                                Código del cupón
                            </span>

                            <strong>

                                <?= htmlspecialchars(
                                    $cupon['CODIGO_CUPON']
                                ) ?>

                            </strong>

                        </div>


                        <div class="coupon-info">


                            <div class="info-box">

                                <span>
                                    EcoPuntos usados
                                </span>

                                <strong>

                                    <?= number_format(
                                        $cupon[
                                            'PUNTOS_REQUERIDOS'
                                        ]
                                    ) ?>

                                </strong>

                            </div>


                            <div class="info-box">

                                <span>
                                    Fecha de emisión
                                </span>

                                <strong>

                                    <?= htmlspecialchars(
                                        $cupon[
                                            'FECHA_EMISION'
                                        ]
                                    ) ?>

                                </strong>

                            </div>


                            <div class="info-box">

                                <span>
                                    Fecha de expiración
                                </span>

                                <strong>

                                    <?= htmlspecialchars(
                                        $cupon[
                                            'FECHA_EXPIRACION'
                                        ]
                                    ) ?>

                                </strong>

                            </div>


                            <div class="info-box">

                                <span>
                                    Comercio
                                </span>

                                <strong>

                                    <?= htmlspecialchars(
                                        $cupon[
                                            'NOMBRE_COMERCIO'
                                        ]
                                    ) ?>

                                </strong>

                            </div>


                        </div>


                        <span
                            class="coupon-status <?= $claseEstado ?>"
                        >

                            <?= htmlspecialchars($estado) ?>

                        </span>


                    </article>


                <?php endforeach; ?>


            </div>


        <?php endif; ?>


    </main>


</div>

</body>

</html>