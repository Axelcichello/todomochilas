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

                <?php $totalPaginas = paginar(3, 'proveedor', $conexion); ?>

            </tbody>
        </table>


        <div class="indices">
            <?php indices($totalPaginas); ?>
        </div>


    </main>

</body>

</html>