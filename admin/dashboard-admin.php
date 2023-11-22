<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilos-admin.css">
    <link rel="stylesheet" href="../css/normalizer.css">
    <title>TodoMochilasADM | Dashboard</title>
</head>

<body>

    <?php


    include_once '../functions/config.php';
    include_once '../functions/funciones.php';
    include_once '../functions/arrays.php';

    include_once '../templates/header-admin.php';
    include_once '../templates/sidebar-admin.php';

    $conexion = conectarDDBB(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


    isAuth();

    ?>

    <main class="contenedor seccion">
        <h1 class="titulo-table">Dashboard</h1>

        <div class="dashboard-cards">


            <div class="card">


                <h2 class="h2-card">Usuarios registrados(no admins)</h2>


                <?php

                //consulta para que devuleva la cantidad de usuarios diferentes de nivel 3

                $sql = "SELECT COUNT(*) AS cantUsuarios FROM usuario WHERE nivel_usuario != 3";
                $respuesta = mysqli_query($conexion, $sql);

                if (mysqli_num_rows($respuesta) > 0) {
                    $dato = mysqli_fetch_assoc($respuesta);
                }

                ?>

                <p class="p-card"><?php echo $dato['cantUsuarios'] ?> registrados</p>
            </div>

            <div class="card">
                <h2 class="h2-card">Mochilas registradas</h2>

                <?php

                //Consulta que devuelve la cantidad de mochilas cargadas

                $sql = "SELECT COUNT(*) AS cantMochilas FROM mochila";
                $respuesta = mysqli_query($conexion, $sql);

                if (mysqli_num_rows($respuesta) > 0) {
                    $dato = mysqli_fetch_assoc($respuesta);
                }

                ?>

                <p class="p-card"><?php echo $dato['cantMochilas'] ?> registros de mochilas</p>
            </div>

            <div class="card">
                <h2 class="h2-card">ultimo proveedor registrado</h2>

                <?php

                //Consulta que muestra el ultimo proveedor registrado

                $sql = "SELECT (nombre_proveedor) FROM proveedor ORDER BY id_proveedor DESC ";
                $respuesta = mysqli_query($conexion, $sql);

                if (mysqli_num_rows($respuesta) > 0) {
                    $dato = mysqli_fetch_assoc($respuesta);
                }

                ?>

                <p class="p-card"><?php echo $dato['nombre_proveedor'] ?> es el ultimo registro de proveedor</p>
            </div>

            <div class="card">
                <h2 class="h2-card">Suma del precio de cada mochila registrada</h2>

                <?php

                //Suma el total de cada precio de las mochilas registradas

                $sql = "SELECT SUM(precio_mochila) as total FROM mochila";
                $respuesta = mysqli_query($conexion, $sql);

                if (mysqli_num_rows($respuesta) > 0) {
                    $dato = mysqli_fetch_assoc($respuesta);
                }

                ?>

                <p class="p-card">$<?php echo $dato['total'] ?> es el total</p>
            </div>
        </div>
    </main>

    <?php mysqli_close($conexion); ?>


</body>

</html>