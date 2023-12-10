<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilos-admin.css">
    <link rel="stylesheet" href="../css/normalizer.css">

    <title>TodoMochilasADM | Mochilas</title>
</head>

<body>

    <?php
    include_once '../functions/config.php';
    include_once '../functions/funciones.php';
    include_once '../functions/arrays.php';

    include_once '../templates/header-admin.php';
    include_once '../templates/sidebar-admin.php';

    isAuth();

    //Se carga el listado de mochilas

    $conexion = conectarDDBB(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    $resultado = eliminarElemento($idEliminar, $_GET['idEliminar'], 'mochila', 'id_mochila', $conexion);


    ?>



    <main class="contenedor seccion">
        <h1 class="titulo-table">Administrador de mochilas</h1>



        <?php

        verificarEliminacion($resultado, $conexion, 'mochila');

        ?>

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

                //Trae todo de la tabla mochila junto con la tabla de proveedor por la clave foranea
                $query = "SELECT * FROM mochila INNER JOIN proveedor ON mochila.proveedor_id_proveedor = proveedor.id_proveedor ORDER BY id_mochila ASC";

                //la funcion paginar toma los datos de las tablas y devuelve dos valores que se asignan a las variables
                list($totalPaginas, $resultadoPaginacion) = paginar(5, 'mochila', $conexion, $query);


                foreach ($resultadoPaginacion as $fila) { ?>

                    <tr>
                        <td><?php echo $fila['id_mochila'] ?></td>
                        <td><?php echo $fila['nombre_mochila'] ?></td>
                        <td>$<?php echo $fila['precio_mochila'] ?></td>
                        <td>
                            <img class="foto-mochila-adm" src="../img/mochilas/<?php echo $fila['foto_mochila'] ?>" alt="foto">
                        </td>
                        <td><?php echo $fila['nombre_proveedor'] ?></td>

                        <td>
                            <div class="w-100">

                                <a href="#" onclick="confirmarEliminacion(<?php echo $fila['id_mochila']; ?>, '<?php echo $fila['nombre_mochila']; ?>')" class="boton-rojo-block">ELIMINAR PRODUCTO</a>
                                <a href="./formulario-admin.php?form=mochila&id=<?php echo $fila['id_mochila'] ?>" class="boton-naranja-block">VER / ACTUALIZAR PRODUCTO</a>

                            </div>
                        </td>
                    </tr>

                <?php }


                ?>


            </tbody>
        </table>


        <div class="indices">
            <!-- se cargan los indices -->
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
            text: "vas a eliminar la mochila " + nombreEliminar + " id " + idEliminar + "!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Eliminar!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "mochilas-admin.php?idEliminar=" + idEliminar;
            }
        });

    }
</script>

</html>