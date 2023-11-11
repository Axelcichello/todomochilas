<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilos-admin.css">
    <link rel="stylesheet" href="../css/normalizer.css">

    <title>Document</title>
</head>

<body>

    <?php
    include_once '../functions/config.php';
    include_once '../functions/funciones.php';
    include_once '../functions/arrays.php';

    include_once '../templates/header-admin.php';
    include_once '../templates/sidebar-admin.php';

    isAuth();


    $conexion = conectarDDBB(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);




    ?>



    <main class="contenedor seccion">
        <h1 class="titulo-table">Administrador de mochilas</h1>

        <a href="./formulario-admin.php?form=mochila" class="boton boton-verde">Nueva Mochila</a>

        <table class="ventas">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Foto</th>
                    <th>Proveedor</th>

                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

            <?php 

            $query = "SELECT * FROM mochila INNER JOIN proveedor ON mochila.proveedor_id_proveedor = proveedor.id_proveedor";

            list($totalPaginas, $resultadoPaginacion) = paginar(5, 'mochila', $conexion, $query);
            

                foreach ($resultadoPaginacion as $fila) { ?>

                    <tr>
                        <td><?php echo $fila['id_mochila'] ?></td>
                        <td><?php echo $fila['nombre_mochila'] ?></td>
                        <td><?php echo $fila['precio_mochila'] ?></td>
                        <td>
                            <img class="foto-mochila-adm" src="../img/mochilas/<?php echo $fila['foto_mochila'] ?>" alt="foto">
                        </td>
                        <td><?php echo $fila['nombre_proveedor'] ?></td>

                        <td>
                            <div class="w-100">
                                <a href="#" class="boton-rojo-block">ELIMINAR PRODUCTO</a>
                                <a href="#" class="boton-naranja-block">VER / ACTUALIZAR PRODUCTO</a>
                            </div>
                        </td>
                    </tr>

                <?php }


                ?>


            

                <!-- <?php

                //list($totalPaginas, $resultadoPaginacion) = paginar(3, 'mochila', $conexion);

                $sql = "SELECT * FROM mochila INNER JOIN proveedor ON mochila.proveedor_id_proveedor = proveedor.id_proveedor";

                $resultado = mysqli_query($conexion, $sql);

                while ($fila = $resultado->fetch_array()) { ?>

                    <tr>
                        <td><?php echo $fila['id_mochila'] ?></td>
                        <td><?php echo $fila['nombre_mochila'] ?></td>
                        <td><?php echo $fila['precio_mochila'] ?></td>
                        <td>
                            <img class="foto-mochila-adm" src="../img/mochilas/<?php echo $fila['foto_mochila'] ?>" alt="foto">
                        </td>
                        <td><?php echo $fila['nombre_proveedor'] ?></td>

                        <td>
                            <div class="w-100">
                                <a href="#" class="boton-rojo-block">ELIMINAR PRODUCTO</a>
                                <a href="#" class="boton-naranja-block">VER / ACTUALIZAR PRODUCTO</a>
                            </div>
                        </td>
                    </tr>

                <?php }?> -->



            </tbody>
        </table>


        <div class="indices">
            <?php indices($totalPaginas); ?>
        </div>




    </main>

</body>

</html>