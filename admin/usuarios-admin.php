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

    $resultado = eliminarElemento($idEliminar, $_GET['idEliminar'], 'usuario', 'id_usuario' ,$conexion);

    





    ?>



    <main class="contenedor seccion">
        <h1 class="titulo-table">Administrador de Usuarios</h1>

        <?php verificarEliminacion($resultado, $conexion, 'usuario'); ?>



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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmarEliminacion(idEliminar, nombreEliminar) {

        Swal.fire({
            title: "¿Estas seguro?",
            text: "vas a eliminar el usuario " + nombreEliminar + " id " + idEliminar + "!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Eliminar!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "usuarios-admin.php?idEliminar=" + idEliminar;
            }
        });

    }
</script>

</html>