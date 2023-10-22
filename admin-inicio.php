<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos-admin.css">
    <link rel="stylesheet" href="css/normalizer.css">
    <title>Productos | Dashboard</title>
</head>

<body>
    <?php


    include_once './functions/config.php';
    include_once './functions/funciones.php';
    include_once './functions/arrays.php';
    include_once './templates/header-admin.php';

    $conexion = conectarDDBB(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


    ?>

    <main class="contenedor seccion">
        <h1 class="titulo-table">Administrador de Productos</h1>

        <a href="formulario-admin.php" class="boton boton-verde">Nuevo Producto</a>







        <table class="ventas">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Proveedor</th>
                    <th>Monto</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                <?php
                $data = traerTodo('mochila', $conexion);

                foreach ($data as $dato) { ?>
                    <tr>
                        <td><?php echo $dato['id_mochila'] ?></td>
                        <td><?php echo $dato['nombre_mochila'] ?></td>
                        <td><?php echo $dato['proveedor_mochila'] ?></td>
                        <td>$<?php echo $dato['precio_mochila'] ?></td>
                        <td>
                            <div class="w-100">
                                <a href="#" class="boton-rojo-block">ELIMINAR PRODUCTO</a>
                                <a href="#" class="boton-naranja-block">VER / ACTUALIZAR PRODUCTO</a>
                            </div>
                        </td>
                    </tr>
                <?php }

                ?>


            </tbody>
        </table>

    </main>
</body>

</html>