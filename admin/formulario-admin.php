<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilos-admin.css">
    <link rel="stylesheet" href="../css/normalizer.css">
    <title>TodoMochilasADM | Formulario <?php echo $_GET['form'] ?></title>
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

    //Formulario template general
    //Se evalua que formulario se va a cargar dependiendo el tipo que se pase por url


    $form = cargarFormulario($_GET['form']);


    ?>

    <main class="contenedor seccion">

        <?php include_once "../templates/formularios/{$form}" ?>

    </main>

</body>

<?php mysqli_close($conexion); ?>


<script>

function editar() {
            var formulario = document.querySelector('.formulario');
            var elementos = formulario.elements;

            // Iterar sobre los elementos del formulario y quitar el atributo 'disabled'
            for (var i = 0; i < elementos.length; i++) {
                elementos[i].removeAttribute('disabled');
            }
        }

</script>


</html>