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

if ($usuarioRol !== 'CIUDADANO') {
    header('Location: inicio.php');
    exit;
}

require_once __DIR__ . '/../model/recompensasmodelo.php';
require_once __DIR__ . '/../model/resumenusuariomodelo.php';

$recompensas = [];

$resumenUsuario = [
    'puntos' => 0,
    'cupones' => 0
];

$error = '';

$mensajeCanje = $_SESSION['mensaje_canje'] ?? '';
$codigoCupon = $_SESSION['codigo_cupon'] ?? '';
$errorCanje = $_SESSION['error_canje'] ?? '';

unset(
    $_SESSION['mensaje_canje'],
    $_SESSION['codigo_cupon'],
    $_SESSION['error_canje']
);


try {

    $recompensas =
        RecompensasModel::obtenerRecompensasActivas();

    $resumenUsuario =
        ResumenUsuarioModel::obtenerResumen(
            $_SESSION['usuario_id']
        );

} catch (Throwable $e) {

    $error =
        'No se pudieron cargar las recompensas disponibles.';
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
        Recompensas | EcoPuntos CR
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        body {
            margin: 0;
            min-height: 100vh;
            background:
                linear-gradient(
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
            background:
                linear-gradient(
                    135deg,
                    #0d6b45,
                    #1a8e5a
                );
            color: white;
            padding: 36px 40px;
        }

        .page-header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
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

        .points-box {
            background: white;
            color: #0d6b45;
            border-radius: 18px;
            padding: 14px 22px;
            text-align: center;
            min-width: 160px;
        }

        .points-box strong {
            display: block;
            font-size: 1.8rem;
        }

        .points-box span {
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .page-header h1 {
            margin-top: 30px;
            margin-bottom: 8px;
            font-size: 2.3rem;
            font-weight: 800;
        }

        .page-header p {
            margin: 0;
            color: rgba(255,255,255,0.85);
        }

        .content {
            padding: 35px 40px 45px;
        }

        .rewards-grid {
            display: grid;
            grid-template-columns:
                repeat(auto-fit, minmax(270px, 1fr));
            gap: 22px;
        }

        .reward-card {
            background: white;
            border-radius: 20px;
            padding: 24px;
            border:
                1px solid
                rgba(13, 107, 69, 0.10);
            box-shadow:
                0 10px 25px
                rgba(13, 107, 69, 0.08);
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .reward-store {
            color: #0d6b45;
            font-size: 0.82rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .reward-card h2 {
            margin: 0;
            color: #173f32;
            font-size: 1.35rem;
        }

        .reward-description {
            color: #60716b;
            line-height: 1.6;
            min-height: 50px;
        }

        .reward-info {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            padding-top: 12px;
            border-top:
                1px solid
                rgba(13, 107, 69, 0.10);
        }

        .reward-info div {
            text-align: center;
            flex: 1;
        }

        .reward-info strong {
            display: block;
            color: #0d6b45;
            font-size: 1.25rem;
        }

        .reward-info span {
            color: #718078;
            font-size: 0.78rem;
        }

        .btn-canjear {
            width: 100%;
            border: 0;
            border-radius: 12px;
            padding: 13px 18px;
            background:
                linear-gradient(
                    135deg,
                    #0d6b45,
                    #168b58
                );
            color: white;
            font-weight: 700;
            margin-top: auto;
        }

        .btn-canjear:disabled {
            background: #cbd5cf;
            color: #66736d;
            cursor: not-allowed;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 25px;
            text-decoration: none;
            color: #0d6b45;
            font-weight: 700;
        }

        .empty-message {
            text-align: center;
            padding: 50px 20px;
            color: #60716b;
        }

        @media (max-width: 600px) {

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

        <div class="page-header-top">

            <div class="brand">

                <span class="brand-mark">
                    E
                </span>

                EcoPuntos CR

            </div>


            <div class="points-box">

                <strong>
                    <?= number_format(
                        $resumenUsuario['puntos']
                    ) ?>
                </strong>

                <span>
                    EcoPuntos disponibles
                </span>

            </div>

        </div>


        <h1>
            Recompensas disponibles
        </h1>

        <p>
            Utiliza tus EcoPuntos para obtener
            beneficios en los comercios afiliados.
        </p>

    </header>


    <main class="content">

        <a
            href="inicio.php"
            class="back-link"
        >
            ← Volver al inicio
        </a>

        <?php if ($mensajeCanje !== ''): ?>

    <div class="alert alert-success">

        <?= htmlspecialchars($mensajeCanje) ?>

        <?php if ($codigoCupon !== ''): ?>

            <div class="mt-2 fw-bold">
                Código del cupón:
                <?= htmlspecialchars($codigoCupon) ?>
            </div>

        <?php endif; ?>

    </div>

<?php endif; ?>


<?php if ($errorCanje !== ''): ?>

    <div class="alert alert-danger">
        <?= htmlspecialchars($errorCanje) ?>
    </div>

<?php endif; ?>

        <?php if ($error !== ''): ?>

            <div class="alert alert-danger">

                <?= htmlspecialchars($error) ?>

            </div>

        <?php endif; ?>


        <?php if (
            $error === '' &&
            empty($recompensas)
        ): ?>

            <div class="empty-message">

                <h3>
                    No hay recompensas disponibles
                </h3>

                <p>
                    Actualmente no existen recompensas
                    activas para canjear.
                </p>

            </div>


        <?php else: ?>


            <div class="rewards-grid">


                <?php foreach ($recompensas as $recompensa): ?>

                    <?php

                    $puntosNecesarios =
                        (float)
                        $recompensa['PUNTOS_REQUERIDOS'];

                    $puntosUsuario =
                        (float)
                        $resumenUsuario['puntos'];

                    $puedeCanjear =
                        $puntosUsuario >=
                        $puntosNecesarios;

                    ?>


                    <article class="reward-card">


                        <div class="reward-store">

                            <?= htmlspecialchars(
                                $recompensa['NOMBRE_COMERCIO']
                            ) ?>

                        </div>


                        <h2>

                            <?= htmlspecialchars(
                                $recompensa['TITULO']
                            ) ?>

                        </h2>


                        <div class="reward-description">

                            <?= htmlspecialchars(
                                $recompensa['DESCRIPCION']
                            ) ?>

                        </div>


                        <div class="reward-info">


                            <div>

                                <strong>

                                    <?= number_format(
                                        $recompensa[
                                            'PUNTOS_REQUERIDOS'
                                        ]
                                    ) ?>

                                </strong>

                                <span>
                                    EcoPuntos
                                </span>

                            </div>


                            <div>

                                <strong>

                                    <?= number_format(
                                        $recompensa[
                                            'STOCK_DISPONIBLE'
                                        ]
                                    ) ?>

                                </strong>

                                <span>
                                    Disponibles
                                </span>

                            </div>


                        </div>


                      <form
    method="POST"
    action="../controller/controllercanjearrecompensa.php"
>

    <input
        type="hidden"
        name="id_recompensa"
        value="<?= (int) $recompensa['ID_RECOMPENSA'] ?>"
    >

    <button
        type="submit"
        class="btn-canjear"
        <?= !$puedeCanjear ? 'disabled' : '' ?>
    >

        <?php if ($puedeCanjear): ?>

            Canjear recompensa

        <?php else: ?>

            EcoPuntos insuficientes

        <?php endif; ?>

    </button>

</form>


                    </article>


                <?php endforeach; ?>


            </div>


        <?php endif; ?>


    </main>


</div>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>

</body>

</html>