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
    include 'functions/config.php';
    include 'functions/funciones.php';
    include 'templates/header.php';

    ?>

    <main class="contenido">
        <h1>NUESTROS PRODUCTOS</h1>

        <div class="galeria">

            <?php


            $conexion = conectarDDBB(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

            $mochilas = traerTodo('mochila', $conexion);


            foreach ($mochilas as $mochila) { ?>

                <form class="producto" method="POST" action="producto.php">
                    <img src="./img/mochilas/<?php echo $mochila['foto_mochila'] ?>" alt="Mochila">

                    <div class="info-producto">
                        <p class="producto-nombre"><?php echo $mochila['nombre_mochila']; ?></p>
                        <p class="producto-precio">$<?php echo $mochila['precio_mochila']; ?></p>
                    </div>

                    <input type="hidden" name="id" value="<?php echo $mochila['id_mochila']; ?>">
                    
                    <input type="submit" value="Ver Producto" class="boton-form">

                </form>

            <?php }


            ?>

        </div>
    </main>

    <?php

    include 'templates/footer.php';

    ?>

</body>

</html>