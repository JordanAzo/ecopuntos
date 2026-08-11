<?php
$pageTitle = 'Bienvenido | EcoPuntos CR';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #0d3b2c, #1c6d46, #0d3b2c);
            color: #fff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .welcome-box {
            width: min(860px, 90%);
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 26px;
            padding: 50px 40px;
            box-shadow: 0 18px 40px rgba(0,0,0,0.2);
            text-align: center;
        }
        .badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 999px;
            background: rgba(255,255,255,0.12);
            font-size: 12px;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-weight: 700;
            margin-bottom: 22px;
        }
        h1 {
            font-size: clamp(2.2rem, 5vw, 4rem);
            margin-bottom: 18px;
            font-weight: 800;
        }
        p {
            font-size: 1.1rem;
            line-height: 1.7;
            color: rgba(255,255,255,0.85);
            margin-bottom: 30px;
        }
        .btn-primary {
            background: #ffffff;
            color: #0d3b2c;
            border: none;
            border-radius: 999px;
            padding: 16px 32px;
            font-size: 1rem;
            font-weight: 700;
            text-decoration: none;
            display: inline-block;
            transition: 0.2s ease;
        }
        .btn-primary:hover {
            background: #dff7e9;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>
    <div class="welcome-box">
        <div class="badge">EcoPuntos CR</div>
        <h1>Bienvenido a EcoPuntos CR</h1>
        <p>
            Participa en la transformación ambiental de Costa Rica. Registra tus reciclajes,
            acumula EcoPuntos y gana recompensas por cuidar el planeta.
        </p>
        <a href="views/registro.php" class="btn btn-primary">Ir a registro</a>
    </div>
</body>
</html>
