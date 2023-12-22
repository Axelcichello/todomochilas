<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilos-admin.css">
    <link rel="stylesheet" href="../css/normalizer.css">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />

    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="../functions/app.js"></script>

    <title>TodoMochilasADM | Mochilas</title>
</head>

<body>

    <?php
    include_once '../functions/config.php';
    include_once '../functions/funciones.php';
    include_once '../functions/arrays.php';

    include_once '../templates/header-admin.php';
    include_once '../templates/sidebar-admin.php';

    //administrador de mochilas
    //verifica si esta autenticado
    isAuth();

    //Se carga el listado de mochilas

    $conexion = conectarDDBB(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    $idEliminar = '';

    if (isset($_GET['idEliminar'])) {

        //elimina un elemento
        $resultado = eliminarElemento($idEliminar, $_GET['idEliminar'], 'mochila', 'id_mochila', $conexion);
    }



    ?>



    <!-- comienza a mostrar -->
    <main class="contenedor seccion">
        <h1 class="titulo-table">Administrador de mochilas</h1>



        <?php

        if (isset($_GET['idEliminar'])) {

            //verifica la eliminacion
            verificarEliminacion($resultado, $conexion, 'mochila');
        }



        ?>

        <a href="./formulario-admin.php?form=mochila" class="boton boton-verde">Nueva Mochila</a>

        <!-- comienza la tabla -->
        <table class="ventas" id="TablaUsuarios">
            <p class="texto-exportar">Exportar datos:</p>
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

                //trae las mochilas para mostrar
                $resultadoPaginacion = traerTodo('mochila', $conexion, "INNER JOIN proveedor ON mochila.proveedor_id_proveedor = proveedor.id_proveedor ORDER BY id_mochila ASC");

                
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

                                <a href="#" onclick="confirmarEliminacion(<?php echo $fila['id_mochila']; ?>, '<?php echo $fila['nombre_mochila']; ?>')" class="boton-rojo-block-nuevo">ELIMINAR PRODUCTO</a>
                                <a href="./formulario-admin.php?form=mochila&id=<?php echo $fila['id_mochila'] ?>" class="boton-naranja-block-nuevo">VER / ACTUALIZAR PRODUCTO</a>

                            </div>
                        </td>
                    </tr>

                <?php }


                ?>


            </tbody>
        </table>


        




    </main>

    <?php mysqli_close($conexion); ?>


</body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmarEliminacion(idEliminar, nombreEliminar) {

        //funcion para la eliminacion mediante el id

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