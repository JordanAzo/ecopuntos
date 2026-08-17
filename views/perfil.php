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

require_once __DIR__ . '/../model/perfilmodelo.php';

$perfil = null;
$error = '';

try {

    $perfil = PerfilModel::obtenerPerfil(
        $_SESSION['usuario_id']
    );

    if (!$perfil) {
        $error = 'No se encontró la información del usuario.';
    }

} catch (Throwable $e) {

    $error = 'No se pudo cargar la información del perfil.';
}

$rolUsuario = strtoupper(
    trim($_SESSION['usuario_rol'] ?? 'CIUDADANO')
);

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
        Mi perfil | EcoPuntos CR
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
            width: min(1000px, 96%);
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

        .profile-card {
            background: white;

            border-radius: 20px;

            padding: 30px;

            border:
                1px solid
                rgba(13, 107, 69, 0.10);

            box-shadow:
                0 10px 25px
                rgba(13, 107, 69, 0.08);
        }

        .profile-header {
            display: flex;
            align-items: center;

            gap: 18px;

            margin-bottom: 30px;
        }

        .avatar {
            width: 70px;
            height: 70px;

            border-radius: 50%;

            background: linear-gradient(
                135deg,
                #7ad79c,
                #2bbf78
            );

            color: #0d3b2c;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 2rem;
            font-weight: 900;
        }

        .profile-header h2 {
            margin: 0;

            color: #173f32;

            font-weight: 800;
        }

        .profile-header span {
            color: #718078;
        }

        .profile-grid {
            display: grid;

            grid-template-columns:
                repeat(2, 1fr);

            gap: 18px;
        }

        .info-box {
            background: #f6faf7;

            border-radius: 14px;

            padding: 18px;
        }

        .info-box span {
            display: block;

            color: #718078;

            font-size: 0.75rem;

            text-transform: uppercase;

            margin-bottom: 6px;
        }

        .info-box strong {
            color: #173f32;

            font-size: 1rem;
        }

        .status-activo {
            color: #0d6b45 !important;
        }

        @media (max-width: 650px) {

            .profile-grid {
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
            Mi perfil
        </h1>

        <p>
            Consulta la información asociada
            a tu cuenta de EcoPuntos CR.
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


        <?php if ($perfil): ?>


            <section class="profile-card">


                <div class="profile-header">


                    <div class="avatar">

                        <?= htmlspecialchars(
                            strtoupper(
                                substr(
                                    $perfil['NOMBRE'],
                                    0,
                                    1
                                )
                            )
                        ) ?>

                    </div>


                    <div>

                        <h2>

                            <?= htmlspecialchars(
                                $perfil['NOMBRE']
                                . ' '
                                . $perfil['PRIMER_APELLIDO']
                            ) ?>

                        </h2>


                        <span>

                            <?= htmlspecialchars(
                                $perfil['CORREO']
                            ) ?>

                        </span>

                    </div>


                </div>


                <div class="profile-grid">


                    <div class="info-box">

                        <span>
                            Nombre
                        </span>

                        <strong>

                            <?= htmlspecialchars(
                                $perfil['NOMBRE']
                            ) ?>

                        </strong>

                    </div>


                    <div class="info-box">

                        <span>
                            Primer apellido
                        </span>

                        <strong>

                            <?= htmlspecialchars(
                                $perfil['PRIMER_APELLIDO']
                            ) ?>

                        </strong>

                    </div>


                    <div class="info-box">

                        <span>
                            Segundo apellido
                        </span>

                        <strong>

                            <?= htmlspecialchars(
                                $perfil['SEGUNDO_APELLIDO']
                                ?? 'No registrado'
                            ) ?>

                        </strong>

                    </div>


                    <div class="info-box">

                        <span>
                            Correo
                        </span>

                        <strong>

                            <?= htmlspecialchars(
                                $perfil['CORREO']
                            ) ?>

                        </strong>

                    </div>


                    <div class="info-box">

                        <span>
                            Teléfono
                        </span>

                        <strong>

                            <?= htmlspecialchars(
                                $perfil['TELEFONO']
                                ?? 'No registrado'
                            ) ?>

                        </strong>

                    </div>


                    <div class="info-box">

                        <span>
                            Rol
                        </span>

                        <strong>

                            <?= htmlspecialchars(
                                $rolUsuario
                            ) ?>

                        </strong>

                    </div>


                    <div class="info-box">

                        <span>
                            Estado
                        </span>

                        <strong class="status-activo">

                            <?= htmlspecialchars(
                                $perfil['ESTADO']
                            ) ?>

                        </strong>

                    </div>


                    <div class="info-box">

                        <span>
                            Fecha de registro
                        </span>

                        <strong>

                            <?= htmlspecialchars(
                                $perfil['FECHA_REGISTRO']
                            ) ?>

                        </strong>

                    </div>


                </div>


            </section>


        <?php endif; ?>


    </main>


</div>

</body>

</html>