<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalizer.css">
    <link rel="stylesheet" href="css/estilos.css">
    <title>TodoMochilas | Galeria</title>
</head>

<body>


    <?php

    include 'functions/arrays.php';
    include 'functions/funciones.php';
    include 'templates/header.php';

    ?>

    <main class="contenido">
        <h1>NUESTROS PRODUCTOS</h1>

        <div class="galeria">

            <?php mostrarProducto($productos) ?>

        </div>
    </main>

    <?php

    include 'templates/footer.php';

    ?>

</body>

</html>