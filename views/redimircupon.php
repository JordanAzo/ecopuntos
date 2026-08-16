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

if ($usuarioRol !== 'COMERCIO') {
    header('Location: inicio.php');
    exit;
}

$mensajeExito = $_SESSION['redimir_exito'] ?? '';
$mensajeError = $_SESSION['redimir_error'] ?? '';

unset($_SESSION['redimir_exito']);
unset($_SESSION['redimir_error']);

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
        Redimir cupón | EcoPuntos CR
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

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 35px 20px;
        }

        .card-shell {
            width: min(620px, 96%);

            background: white;

            border-radius: 25px;

            overflow: hidden;

            box-shadow:
                0 25px 55px
                rgba(0, 0, 0, 0.25);
        }

        .card-header {
            background:
                linear-gradient(
                    135deg,
                    #0d6b45,
                    #1a8e5a
                );

            color: white;

            padding: 35px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;

            font-weight: 800;
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

        .card-header h1 {
            margin-top: 25px;
            margin-bottom: 8px;

            font-size: 2rem;

            font-weight: 800;
        }

        .card-header p {
            margin: 0;

            color:
                rgba(
                    255,
                    255,
                    255,
                    0.88
                );

            line-height: 1.6;
        }

        .content {
            padding: 35px;
        }

        label {
            color: #173f32;

            font-weight: 700;

            margin-bottom: 8px;
        }

        .form-control {
            border-radius: 14px;

            padding: 14px 15px;

            border:
                1px solid
                #cfe3d7;
        }

        .form-control:focus {
            border-color: #1a8e5a;

            box-shadow:
                0 0 0 0.2rem
                rgba(26, 142, 90, 0.12);
        }

        .btn-redimir {
            width: 100%;

            border: none;

            border-radius: 999px;

            padding: 14px;

            margin-top: 20px;

            background:
                linear-gradient(
                    135deg,
                    #0d6b45,
                    #0a4c34
                );

            color: white;

            font-weight: 800;

            transition: 0.2s ease;
        }

        .btn-redimir:hover {
            transform: translateY(-1px);

            box-shadow:
                0 10px 20px
                rgba(13, 107, 69, 0.22);
        }

        .back-link {
            display: block;

            text-align: center;

            margin-top: 20px;

            color: #0d6b45;

            text-decoration: none;

            font-weight: 700;
        }

        .info-box {
            background: #f2f8f4;

            border:
                1px solid
                #d8eadf;

            border-radius: 14px;

            padding: 15px;

            margin-bottom: 25px;

            color: #4c635a;

            line-height: 1.5;
        }

    </style>

</head>


<body>


<div class="card-shell">


    <header class="card-header">


        <div class="brand">

            <span class="brand-mark">
                E
            </span>

            EcoPuntos CR

        </div>


        <h1>
            Redimir cupón
        </h1>


        <p>
            Ingresa el código presentado por el ciudadano
            para validar y redimir su recompensa.
        </p>


    </header>


    <main class="content">


        <?php if ($mensajeExito !== ''): ?>

            <div class="alert alert-success">

                <?= htmlspecialchars($mensajeExito) ?>

            </div>

        <?php endif; ?>


        <?php if ($mensajeError !== ''): ?>

            <div class="alert alert-danger">

                <?= htmlspecialchars($mensajeError) ?>

            </div>

        <?php endif; ?>


        <div class="info-box">

            El sistema comprobará automáticamente que el cupón
            pertenezca a este comercio, que esté disponible
            y que no haya expirado.

        </div>


        <form
            action="../controller/controllerredimircupon.php"
            method="POST"
        >


            <div>

                <label for="codigo_cupon">
                    Código del cupón
                </label>


                <input
                    type="text"
                    id="codigo_cupon"
                    name="codigo_cupon"
                    class="form-control"
                    placeholder="Ejemplo: ECO-A91ZXO"
                    required
                    autocomplete="off"
                >

            </div>


            <button
                type="submit"
                class="btn-redimir"
            >
                Validar y redimir cupón
            </button>


        </form>


        <a
            href="inicio.php"
            class="back-link"
        >
            Volver al inicio
        </a>


    </main>


</div>


</body>

</html>