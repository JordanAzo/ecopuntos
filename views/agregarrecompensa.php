<?php

$mensaje = $_GET['mensaje'] ?? '';
$tipo = $_GET['tipo'] ?? '';

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Agregar recompensa | EcoPuntos CR</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/registro.css">

</head>


<body>

    <div class="register-shell">

        <div class="register-layout">


            <aside class="register-panel">

                <div class="brand">

                    <span class="brand-mark">
                        E
                    </span>

                    <span>
                        EcoPuntos CR
                    </span>

                </div>


                <h1>
                    Nueva recompensa
                </h1>


                <p>
                    Solicita recompensas que los usuarios
                    podrán obtener utilizando sus EcoPuntos.
                </p>


                <ul>

                    <li>Beneficios para los usuarios</li>
                    <li>Comercios afiliados</li>
                    <li>Canje mediante EcoPuntos</li>

                </ul>

            </aside>



            <div class="register-form-wrap">


                <div class="form-header">

                    <h2>
                        Solicitar recompensa
                    </h2>

                    <p>
                        Completa la información de la nueva recompensa que deseas solicitar.
                    </p>

                </div>


                <!-- MENSAJES -->

                <?php if ($mensaje !== ''): ?>

                <div class="alert <?= $tipo === 'exito'
                        ? 'alert-success'
                        : 'alert-danger'
                    ?>">

                    <?= htmlspecialchars($mensaje) ?>

                </div>

                <?php endif; ?>


                <form id="formAgregarRecompensa" method="post" action="../controller/controlleragregarrecompensa.php"
                    novalidate>


                    <div class="form-grid">


                        <!-- COMERCIO -->

                        <div class="field full">

                            <label for="nombreComercio">
                                Nombre del comercio
                            </label>

                            <input id="nombreComercio" name="nombreComercio" type="text"
                                placeholder="Ejemplo: Supermercado Verde" required>

                            <div class="error-message" id="nombreComercioError"></div>

                        </div>


                        <!-- TÍTULO -->

                        <div class="field full">

                            <label for="titulo">
                                Título de la recompensa
                            </label>

                            <input id="titulo" name="titulo" type="text" placeholder="Ejemplo: Café gratis" required>

                            <div class="error-message" id="tituloError"></div>

                        </div>


                        <!-- DESCRIPCIÓN -->

                        <div class="field full">

                            <label for="descripcion">
                                Descripción
                            </label>

                            <input id="descripcion" name="descripcion" type="text"
                                placeholder="Ejemplo: Café americano gratuito" required>

                            <div class="error-message" id="descripcionError"></div>

                        </div>


                        <!-- PUNTOS -->

                        <div class="field">

                            <label for="puntosRequeridos">
                                Puntos requeridos
                            </label>

                            <input id="puntosRequeridos" name="puntosRequeridos" type="number" min="1"
                                placeholder="Ejemplo: 100" required>

                            <div class="error-message" id="puntosRequeridosError"></div>

                        </div>


                        <!-- STOCK -->

                        <div class="field">

                            <label for="stockDisponible">
                                Cantidad que desea solicitar
                            </label>

                            <input id="stockDisponible" name="stockDisponible" type="number" min="0"
                                placeholder="Ejemplo: 20" required>

                            <div class="error-message" id="stockDisponibleError"></div>

                        </div>


                    </div>


                    <div class="form-actions">

                        <button type="submit" class="btn btn-primary">
                            Guardar recompensa
                        </button>


                        <div class="form-link">

                            <a href="../inicio.php">
                                Volver al inicio
                            </a>

                        </div>

                    </div>


                </form>

            </div>

        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>


</body>

</html>