<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../model/resumenusuariomodelo.php';
require_once __DIR__ . '/../model/estadisticasmodelo.php';

$pageTitle = 'Inicio | EcoPuntos CR';

$estaLogueado = (
    !empty($_SESSION['autenticado']) &&
    $_SESSION['autenticado'] === true
);

$usuarioNombre =
    $_SESSION['usuario_nombre']
    ?? $_SESSION['NombreUsuario']
    ?? 'Usuario';

$usuarioRol = strtoupper(
    trim($_SESSION['usuario_rol'] ?? 'CIUDADANO')
);

$stats = [
    'material' => 0,
    'co2' => 0,
    'usuarios' => 0,
    'entregas' => 0
];

try {

    $stats = EstadisticasModel::obtenerEstadisticas();

} catch (Throwable $e) {

    $stats = [
        'material' => 0,
        'co2' => 0,
        'usuarios' => 0,
        'entregas' => 0
    ];
}

$resumenUsuario = [
    'puntos' => 0,
    'cupones' => 0
];

if (
    $estaLogueado &&
    $usuarioRol === 'CIUDADANO' &&
    !empty($_SESSION['usuario_id'])
) {

    try {

        $resumenUsuario =
            ResumenUsuarioModel::obtenerResumen(
                $_SESSION['usuario_id']
            );

    } catch (Throwable $e) {

        $resumenUsuario = [
            'puntos' => 0,
            'cupones' => 0
        ];
    }
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
        <?= htmlspecialchars($pageTitle) ?>
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
            background:
                radial-gradient(
                    circle at top left,
                    rgba(126, 216, 165, 0.28),
                    transparent 24%
                ),
                radial-gradient(
                    circle at bottom right,
                    rgba(58, 133, 92, 0.28),
                    transparent 22%
                ),
                linear-gradient(
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

        .home-shell {
            width: min(1500px, 97%);
            min-height: 90vh;

            background: rgba(255,255,255,0.08);

            border:
                1px solid
                rgba(255,255,255,0.14);

            border-radius: 30px;

            box-shadow:
                0 26px 60px
                rgba(10, 35, 26, 0.35);

            overflow: hidden;

            backdrop-filter: blur(8px);

            position: relative;
        }

        .home-shell::before {
            content: "";

            position: absolute;
            inset: 0;

            background:
                linear-gradient(
                    120deg,
                    rgba(255,255,255,0.08),
                    transparent 30%,
                    rgba(255,255,255,0.04)
                );

            pointer-events: none;
        }

        .home-nav {
            position: relative;
            z-index: 1;

            background: rgba(255,255,255,0.96);

            border-bottom:
                1px solid
                rgba(13, 107, 69, 0.08);

            padding: 18px 28px;

            box-shadow:
                0 8px 22px
                rgba(13, 107, 69, 0.06);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;

            flex-wrap: wrap;

            gap: 12px 16px;
        }

        .nav-item {
            padding: 9px 16px;

            border-radius: 999px;

            font-weight: 700;

            color: #0d6b45 !important;

            text-decoration: none;

            transition: all 0.2s ease;

            background:
                linear-gradient(
                    135deg,
                    rgba(13, 107, 69, 0.04),
                    rgba(31, 179, 104, 0.08)
                );

            border:
                1px solid
                rgba(13, 107, 69, 0.08);

            box-shadow:
                inset 0 1px 0
                rgba(255,255,255,0.5);
        }

        .nav-item:hover {
            background:
                linear-gradient(
                    135deg,
                    rgba(13, 107, 69, 0.12),
                    rgba(31, 179, 104, 0.12)
                );

            transform: translateY(-2px);

            box-shadow:
                0 8px 18px
                rgba(13, 107, 69, 0.12);
        }

        .home-brand {
            display: inline-flex;

            align-items: center;

            gap: 12px;

            color: #0d3b2c;

            text-decoration: none;

            font-weight: 800;

            font-size: 1.15rem;

            letter-spacing: 0.03em;
        }

        .home-brand .brand-mark {
            width: 40px;
            height: 40px;

            border-radius: 50%;

            display: inline-flex;

            align-items: center;
            justify-content: center;

            background:
                linear-gradient(
                    135deg,
                    #7ad79c,
                    #2bbf78
                );

            color: #0a3a2d;

            font-weight: 800;
        }

        .role-badge {
            display: inline-block;

            margin-left: 6px;

            padding: 4px 9px;

            border-radius: 20px;

            font-size: 0.68rem;

            font-weight: 800;

            letter-spacing: 0.4px;

            vertical-align: middle;
        }

        .role-admin {
            background: #dff3e7;
            color: #0d6b45;
        }

        .role-ciudadano {
            background: #e7f0ff;
            color: #285f9e;
        }

        .role-comercio {
            background: #fff1d6;
            color: #9a6514;
        }

        .home-main {
            position: relative;

            z-index: 1;

            background:
                linear-gradient(
                    180deg,
                    #f4f9f5 0%,
                    #edf7f0 100%
                );

            padding: 32px 32px 20px;

            min-height:
                calc(90vh - 120px);
        }

        .hero-banner {
            position: relative;

            overflow: hidden;

            background:
                linear-gradient(
                    135deg,
                    #0d6b45 0%,
                    #1a8e5a 100%
                );

            color: white;

            border-radius: 24px;

            padding: 42px 36px;

            box-shadow:
                0 20px 38px
                rgba(13, 107, 69, 0.18);

            margin-bottom: 28px;
        }

        .hero-banner::before {
            content: "";

            position: absolute;

            inset:
                -30%
                auto
                auto
                -8%;

            width: 260px;
            height: 260px;

            border-radius: 50%;

            background:
                rgba(255,255,255,0.08);
        }

        .hero-banner::after {
            content: "";

            position: absolute;

            right: -40px;
            bottom: -40px;

            width: 220px;
            height: 220px;

            border-radius: 50%;

            background:
                rgba(255,255,255,0.06);
        }

        .hero-banner > * {
            position: relative;
            z-index: 1;
        }

        .hero-banner h1 {
            margin: 0 0 12px;

            font-size:
                clamp(
                    2.3rem,
                    3vw,
                    3.5rem
                );

            letter-spacing: -0.05em;

            line-height: 1.1;
        }

        .hero-banner p {
            margin: 0;

            color:
                rgba(
                    255,
                    255,
                    255,
                    0.86
                );

            line-height: 1.7;

            font-size: 1.08rem;
        }

        .hero-stats {
            display: flex;

            flex-wrap: wrap;

            gap: 16px;

            justify-content: center;
        }

        .mini-stat {
            background:
                rgba(
                    255,
                    255,
                    255,
                    0.96
                );

            color: #123d2f;

            border-radius: 16px;

            min-width: 150px;

            padding: 16px 18px;

            text-align: center;

            box-shadow:
                0 10px 18px
                rgba(0,0,0,0.08);
        }

        .mini-stat strong {
            display: block;

            font-size: 1.8rem;

            margin-bottom: 4px;
        }

        .mini-stat span {
            font-size: 0.8rem;

            color: #49635d;

            font-weight: 700;

            letter-spacing: 0.05em;

            text-transform: uppercase;
        }

        .stats-grid {
            display: grid;

            grid-template-columns:
                repeat(4, 1fr);

            gap: 18px;

            margin-top: 18px;
        }

        .stat-card {
            background:
                linear-gradient(
                    180deg,
                    #ffffff 0%,
                    #f6faf7 100%
                );

            border:
                1px solid
                rgba(13, 107, 69, 0.08);

            border-radius: 20px;

            padding: 24px 18px;

            box-shadow:
                0 12px 24px
                rgba(14, 52, 38, 0.06);

            text-align: center;

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease;
        }

        .stat-card:hover {
            transform:
                translateY(-4px);

            box-shadow:
                0 18px 28px
                rgba(14, 52, 38, 0.09);
        }

        .stat-card h3 {
            margin: 0 0 10px;

            color: #0d6b45;

            font-weight: 800;

            font-size:
                clamp(
                    1.4rem,
                    2vw,
                    2rem
                );
        }

        .stat-card p {
            margin: 0;

            color: #4f5f5a;

            font-weight: 600;
        }

        .footer {
            background: #edf7f0;

            color: #35564e;

            text-align: center;

            padding: 20px 14px;

            border-top:
                1px solid
                rgba(13, 107, 69, 0.08);

            font-size: 0.95rem;
        }

        .btn-eco {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            border-radius: 999px;

            padding: 12px 20px;

            font-weight: 700;

            text-decoration: none;

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease;
        }

        .btn-eco:hover {
            transform: translateY(-1px);
        }

        .btn-eco-primary {
            background:
                linear-gradient(
                    135deg,
                    #0d6b45,
                    #0a4c34
                );

            color: #fff;

            box-shadow:
                0 12px 22px
                rgba(13, 107, 69, 0.22);
        }

        .btn-eco-outline {
            background: transparent;

            border:
                1px solid
                rgba(255,255,255,0.75);

            color: #fff;
        }

        .btn-eco-light {
            background: #fff;
            color: #0d6b45;
        }

        @media (max-width: 900px) {

            .stats-grid {
                grid-template-columns:
                    repeat(2, 1fr);
            }

        }

        @media (max-width: 560px) {

            .home-main {
                padding: 20px 18px 14px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .hero-banner {
                padding: 28px 22px;
            }

        }

    </style>

</head>


<body>

<div class="home-shell">


    <nav class="home-nav">

        <div
            class="d-flex justify-content-between align-items-center gap-3 flex-wrap"
        >

            <a
                href="inicio.php"
                class="home-brand"
            >

                <span class="brand-mark">
                    E
                </span>

                <span>
                    EcoPuntos CR
                </span>

            </a>


            <div class="nav-actions">


                <?php if ($estaLogueado): ?>


                    <?php if ($usuarioRol === 'CIUDADANO'): ?>


                        <a
                            href="registrarentrega.php"
                            class="nav-item"
                        >
                            Registrar entrega
                        </a>


                        <a
                            href="recompensas.php"
                            class="nav-item"
                        >
                            Recompensas
                        </a>


                        <a
                            href="mispuntos.php"
                            class="nav-item"
                        >
                            Mis puntos
                        </a>


                        <a
                            href="misentregas.php"
                            class="nav-item"
                        >
                            Mis entregas
                        </a>


                        <a
                            href="miscupones.php"
                            class="nav-item"
                        >
                            Mis cupones
                        </a>


                    <?php elseif ($usuarioRol === 'ADMIN'): ?>


                        <a
                            href="agregarmaterial.php"
                            class="nav-item"
                        >
                            Registrar material
                        </a>


                        <a
                            href="agregarrecompensa.php"
                            class="nav-item"
                        >
                            Registrar recompensa
                        </a>


                        <a
                            href="estadisticas.php"
                            class="nav-item"
                        >
                            Estadísticas
                        </a>


                    <?php elseif ($usuarioRol === 'COMERCIO'): ?>


                        <a
                            href="agregarrecompensa.php"
                            class="nav-item"
                        >
                            Registrar recompensa
                        </a>


                       <a
                           href="redimircupon.php"
                            class="nav-item"
>
                            Redimir cupón
                      </a>


                    <?php endif; ?>


                    <a
                        href="perfil.php"
                        class="nav-item"
                    >
                        Mi perfil
                    </a>


                    <span class="text-muted fw-semibold">

                        Hola,

                        <strong>
                            <?= htmlspecialchars($usuarioNombre) ?>
                        </strong>

                        <span
                            class="role-badge role-<?= strtolower($usuarioRol) ?>"
                        >
                            <?= htmlspecialchars($usuarioRol) ?>
                        </span>

                    </span>


                    <a
                        href="../controller/controllercerrarsesion.php"
                        class="btn btn-outline-danger btn-sm"
                    >
                        Cerrar sesión
                    </a>


                <?php else: ?>


                    <a
                        href="login.php"
                        class="btn btn-outline-success btn-sm"
                    >
                        Iniciar sesión
                    </a>


                    <a
                        href="registro.php"
                        class="btn btn-success btn-sm"
                    >
                        Registrarse
                    </a>


                <?php endif; ?>


            </div>

        </div>

    </nav>


    <main class="home-main">


        <?php if ($estaLogueado): ?>


            <?php if ($usuarioRol === 'CIUDADANO'): ?>


                <section
                    class="hero-banner d-flex flex-column flex-md-row justify-content-between align-items-center gap-4"
                >

                    <div>

                        <h1>
                            ¡Bienvenido de nuevo,
                            <?= htmlspecialchars($usuarioNombre) ?>!
                        </h1>

                        <p>
                            Cada entrega que realizas suma a tu impacto
                            ambiental y te permite acumular EcoPuntos.
                        </p>

                    </div>


                    <div class="hero-stats">


                        <div class="mini-stat">

                            <strong>
                                <?= number_format(
                                    $resumenUsuario['puntos']
                                ) ?>
                            </strong>

                            <span>
                                EcoPuntos
                            </span>

                        </div>


                        <div class="mini-stat">

                            <strong>
                                <?= (int)
                                    $resumenUsuario['cupones']
                                ?>
                            </strong>

                            <span>
                                Cupones activos
                            </span>

                        </div>


                    </div>

                </section>


            <?php elseif ($usuarioRol === 'ADMIN'): ?>


                <section
                    class="hero-banner d-flex flex-column flex-md-row justify-content-between align-items-center gap-4"
                >

                    <div>

                        <h1>
                            Panel administrativo
                        </h1>

                        <p>
                            Bienvenido,
                            <?= htmlspecialchars($usuarioNombre) ?>.
                            Desde aquí puedes administrar materiales,
                            recompensas y consultar el comportamiento
                            general de EcoPuntos CR.
                        </p>

                    </div>


                    <div class="hero-stats">


                        <div class="mini-stat">

                            <strong>
                                <?= number_format(
                                    $stats['usuarios']
                                ) ?>
                            </strong>

                            <span>
                                Usuarios activos
                            </span>

                        </div>


                        <div class="mini-stat">

                            <strong>
                                <?= number_format(
                                    $stats['entregas']
                                ) ?>
                            </strong>

                            <span>
                                Entregas
                            </span>

                        </div>


                    </div>

                </section>


            <?php elseif ($usuarioRol === 'COMERCIO'): ?>


                <section
                    class="hero-banner d-flex flex-column flex-md-row justify-content-between align-items-center gap-4"
                >

                    <div>

                        <h1>
                            Panel de comercio
                        </h1>

                        <p>
                            Bienvenido,
                            <?= htmlspecialchars($usuarioNombre) ?>.
                            Desde aquí puedes administrar las recompensas
                            de tu comercio y gestionar los cupones
                            utilizados por los ciudadanos.
                        </p>

                    </div>

                </section>


            <?php endif; ?>


        <?php else: ?>


            <section class="hero-banner text-center">

                <h1>
                    Transforma tus residuos en recompensas
                </h1>

                <p
                    class="mx-auto"
                    style="max-width:760px;"
                >
                    Registra tus entregas de materiales reciclables,
                    acumula EcoPuntos y obtén beneficios
                    en comercios aliados.
                </p>


                <div
                    class="d-flex justify-content-center gap-3 mt-4 flex-wrap"
                >

                    <a
                        href="registro.php"
                        class="btn-eco btn-eco-light"
                    >
                        Empieza ahora
                    </a>


                    <a
                        href="login.php"
                        class="btn-eco btn-eco-outline"
                    >
                        Iniciar sesión
                    </a>

                </div>

            </section>


        <?php endif; ?>


        <section class="stats-grid">


            <div class="stat-card">

                <h3>
                    <?= number_format(
                        $stats['material'],
                        2
                    ) ?>
                    kg
                </h3>

                <p>
                    Material Reciclado
                </p>

            </div>


            <div class="stat-card">

                <h3>
                    <?= number_format(
                        $stats['co2'],
                        2
                    ) ?>
                    kg
                </h3>

                <p>
                    CO₂ Ahorrado
                </p>

            </div>


            <div class="stat-card">

                <h3>
                    <?= number_format(
                        $stats['usuarios']
                    ) ?>
                </h3>

                <p>
                    Usuarios Activos
                </p>

            </div>


            <div class="stat-card">

                <h3>
                    <?= number_format(
                        $stats['entregas']
                    ) ?>
                </h3>

                <p>
                    Entregas Exitosas
                </p>

            </div>


        </section>


    </main>


    <footer class="footer">

        &copy;
        <?= date('Y') ?>
        EcoPuntos CR.
        Todos los derechos reservados.

    </footer>


</div>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>

</body>

</html>