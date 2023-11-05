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

    $conexion = conectarDDBB(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);




    ?>



    <main class="contenedor seccion">
        <h1 class="titulo-table">Administrador de Usuarios</h1>

        <a href="./formulario-admin.php?form=usuario" class="boton boton-verde">Nuevo Usuario</a>


        <table class="ventas">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Legajo</th>

                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                <?php list($totalPaginas, $resultadoPaginacion) = paginar(3, 'usuario', $conexion);

                foreach ($resultadoPaginacion as $fila) { ?>

                    <tr>
                        <td><?php echo $fila['id_usuario'] ?></td>
                        <td><?php echo $fila['nombre_usuario'] ?></td>
                        <td><?php echo $fila['apellido_usuario'] ?></td>
                        <td><?php echo $fila['correo_usuario'] ?></td>
                        <td><?php echo $fila['legajo_usuario'] ?></td>

                        <td>
                            <div class="w-100">
                                <a href="#" class="boton-rojo-block">ELIMINAR USUARIO</a>
                                <a href="#" class="boton-naranja-block">VER / ACTUALIZAR USUARIO</a>
                            </div>
                        </td>
                    </tr>

                <?php }


                ?>

            </tbody>
        </table>


        <div class="indices">
            <?php indices($totalPaginas); ?>
        </div>


    </main>

</body>

</html>