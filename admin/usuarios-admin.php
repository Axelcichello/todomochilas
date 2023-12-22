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

    <title>TodoMochilasADM | Usuarios</title>
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

    //esta funcion solo permite a los administradores entrar a registrar usuarios
    isAdmin();

    //Se carga el listado de mochilas
    $conexion = conectarDDBB(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    $idEliminar = '';

    if (isset($_GET['idEliminar'])) {
        
        //elimina un elemento
        $resultado = eliminarElemento($idEliminar, $_GET['idEliminar'], 'usuario', 'id_usuario', $conexion);
    }

    ?>


    <!-- comienza a mostrar -->
    <main class="contenedor seccion">
        <h1 class="titulo-table">Administrador de Usuarios</h1>



        <?php

        if (isset($_GET['idEliminar'])) {
            
            //verifica la eliminacion
            verificarEliminacion($resultado, $conexion, 'usuario');
        }



        ?>



        <a href="./formulario-admin.php?form=usuario" class="boton boton-verde">Nuevo Usuario</a>

        <!-- comienza la tabla -->
        <table class="ventas" id="TablaUsuarios">
            <p class="texto-exportar">Exportar datos:</p>
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
                
                //trae los proveedores para mostrar
                $resultadoPaginacion = traerTodo('usuario', $conexion, '');

                

                foreach ($resultadoPaginacion as $fila) { ?>

                    <tr>
                        <td><?php echo $fila['id_usuario'] ?></td>
                        <td><?php echo $fila['nombre_usuario'] ?></td>
                        <td><?php echo $fila['apellido_usuario'] ?></td>
                        <td><?php echo $fila['correo_usuario'] ?></td>
                        <td><?php echo $fila['legajo_usuario'] ?></td>

                        <td>
                            <div class="w-100">

                                <a href="#" onclick="confirmarEliminacion(<?php echo $fila['id_usuario']; ?>, '<?php echo $fila['nombre_usuario']; ?>')" class="boton-rojo-block-nuevo">ELIMINAR USUARIO</a>

                                <a href="./formulario-admin.php?form=usuario&id=<?php echo $fila['id_usuario'] ?>" class="boton-naranja-block-nuevo">VER / ACTUALIZAR usuario </a>
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