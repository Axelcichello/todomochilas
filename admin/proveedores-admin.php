<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilos-admin.css">
    <link rel="stylesheet" href="../css/normalizer.css">

    <title>TodoMochilasADM | Proveedores</title>
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


    $resultado = eliminarElemento($idEliminar, $_GET['idEliminar'], 'proveedor', 'id_proveedor', $conexion);



    ?>



    <main class="contenedor seccion">
        <h1 class="titulo-table">Administrador de Proveedores</h1>


        <?php


        verificarEliminacion($resultado, $conexion, 'proveedor');



        ?>


        <a href="./formulario-admin.php?form=proveedor" class="boton boton-verde">Nuevo Proveedor</a>


        <table class="ventas">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo Electronico</th>
                    <th>Domicilio</th>
                    <th>Localidad</th>

                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>


                <?php

                $query = "SELECT * FROM proveedor ORDER BY id_proveedor ASC";
                list($totalPaginas, $resultadoPaginacion) = paginar(5, 'proveedor', $conexion, $query);

                foreach ($resultadoPaginacion as $fila) { ?>

                    <tr>
                        <td><?php echo $fila['id_proveedor'] ?></td>
                        <td><?php echo $fila['nombre_proveedor'] ?></td>
                        <td><?php echo $fila['correo_proveedor'] ?></td>
                        <td><?php echo $fila['direccion_proveedor'] ?></td>
                        <td><?php echo $fila['localidad_proveedor'] ?></td>

                        <td>
                            <div class="w-100">
                                <a onclick="confirmarEliminacion(<?php echo $fila['id_proveedor']; ?>, '<?php echo $fila['nombre_proveedor']; ?>')" class="boton-rojo-block">ELIMINAR proveedor</a>

                                <a href="./formulario-admin.php?form=proveedor&id=<?php echo $fila['id_proveedor'] ?>" class="boton-naranja-block">VER / ACTUALIZAR proveedor</a>
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
            text: "vas a eliminar el proveedor " + nombreEliminar + " id " + idEliminar + "!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Eliminar!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "proveedores-admin.php?idEliminar=" + idEliminar;
            }
        });

    }
</script>

</html>