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

<sidebar class="sidebar">

<div class="link-sidebar">


    <a href="dashboard-admin.php">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home-2" width="36" height="36" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
            <path d="M10 12h4v4h-4z" />
        </svg>
        <a href="" class="texto-sidebar">Home</a>
    </a>

</div>

<div class="link-sidebar">


    <a href="proveedores-admin.php">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-truck-delivery" width="36" height="36" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
            <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
            <path d="M5 17h-2v-4m-1 -8h11v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5" />
            <path d="M3 9l4 0" />
        </svg>
        <a href="" class="texto-sidebar">Proveedores</a>
    </a>

</div>

<div class="link-sidebar">


    <a href="proveedores-admin.php">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shopping-bag" width="36" height="36" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M6.331 8h11.339a2 2 0 0 1 1.977 2.304l-1.255 8.152a3 3 0 0 1 -2.966 2.544h-6.852a3 3 0 0 1 -2.965 -2.544l-1.255 -8.152a2 2 0 0 1 1.977 -2.304z" />
            <path d="M9 11v-5a3 3 0 0 1 6 0v5" />
        </svg>
        <a href="" class="texto-sidebar">Mochilas</a>
    </a>

</div>

<div class="link-sidebar">


    <a href="proveedores-admin.php">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="36" height="36" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
        </svg>
        <a href="" class="texto-sidebar">Usuarios</a>
    </a>

</div>


</sidebar>



    <main class="contenedor seccion">
        <h1 class="titulo-table">Administrador de Proveedores</h1>

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

                <?php list($totalPaginas, $resultadoPaginacion) = paginar(3, 'proveedor', $conexion);

                foreach ($resultadoPaginacion as $fila) { ?>

                    <tr>
                        <td><?php echo $fila['id_proveedor'] ?></td>
                        <td><?php echo $fila['nombre_proveedor'] ?></td>
                        <td><?php echo $fila['correo_proveedor'] ?></td>
                        <td><?php echo $fila['direccion_proveedor'] ?></td>
                        <td><?php echo $fila['localidad_proveedor'] ?></td>

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


        <div class="indices">
            <?php indices($totalPaginas); ?>
        </div>


    </main>

</body>

</html>