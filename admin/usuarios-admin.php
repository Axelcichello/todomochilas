<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilos-admin.css">
    <link rel="stylesheet" href="../css/normalizer.css">

    <title>TodoMochilasADM | Usuarios</title>
</head>

<body>

    <?php
    include_once '../functions/config.php';
    include_once '../functions/funciones.php';
    include_once '../functions/arrays.php';

    include_once '../templates/header-admin.php';
    include_once '../templates/sidebar-admin.php';

    isAuth();
    isAdmin();


    $conexion = conectarDDBB(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (isset($_GET) && isset($_GET['idEliminar'])) {

        $idEliminar = $_GET['idEliminar'];

        $sql = "DELETE FROM usuario WHERE id_usuario = {$idEliminar}";

        $resultado = mysqli_query($conexion, $sql);
    }





    ?>



    <main class="contenedor seccion">
        <h1 class="titulo-table">Administrador de Usuarios</h1>

        <?php


        if (isset($resultado)) {
            $filasAfectadas = mysqli_affected_rows($conexion);

            if ($filasAfectadas > 0) { ?>

                <div class="notificacion exito">
                    <p>usuario eliminado correctamente</p>
                </div>

            <?php } else { ?>

                <div class="notificacion error">
                    <p>Error al eliminar el usuario</p>
                </div>

        <?php }
        }



        ?>



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

                <?php

                $query = "SELECT * FROM usuario ORDER BY id_usuario ASC";

                list($totalPaginas, $resultadoPaginacion) = paginar(3, 'usuario', $conexion, $query);

                foreach ($resultadoPaginacion as $fila) { ?>

                    <tr>
                        <td><?php echo $fila['id_usuario'] ?></td>
                        <td><?php echo $fila['nombre_usuario'] ?></td>
                        <td><?php echo $fila['apellido_usuario'] ?></td>
                        <td><?php echo $fila['correo_usuario'] ?></td>
                        <td><?php echo $fila['legajo_usuario'] ?></td>

                        <td>
                            <div class="w-100">

                                <a href="#" onclick="confirmarEliminacion(<?php echo $fila['id_usuario']; ?>, '<?php echo $fila['nombre_usuario']; ?>')" class="boton-rojo-block">ELIMINAR USUARIO</a>

                                <a href="./formulario-admin.php?form=usuario&id=<?php echo $fila['id_usuario'] ?>" class="boton-naranja-block">VER / ACTUALIZAR usuario </a>
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

    <?php mysqli_close($conexion); ?>


</body>

<script>
    function confirmarEliminacion(idEliminar, nombreEliminar) {
        var confirmacion = confirm("¿Desea eliminar el usuario " + nombreEliminar + " ?")

        if (confirmacion) {
            window.location.href = "usuarios-admin.php?idEliminar=" + idEliminar;
        }

    }
</script>

</html>