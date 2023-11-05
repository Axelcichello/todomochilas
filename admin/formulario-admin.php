<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilos-admin.css">
    <link rel="stylesheet" href="../css/normalizer.css">
    <title>Nuevo Producto | Dashboard</title>
</head>

<body>

    <?php
    include_once '../functions/config.php';
    include_once '../functions/funciones.php';
    include_once '../functions/arrays.php';
    include_once '../templates/header-admin.php';

    $conexion = conectarDDBB(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


    $form = cargarFormulario($_GET['form']);


    ?>

    <main class="contenedor">

        <?php include_once "../templates/formularios/{$form}" ?>

    </main>

</body>

</html>