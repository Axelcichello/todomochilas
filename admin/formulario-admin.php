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

    //formulario base


    include_once '../functions/config.php';
    include_once '../functions/funciones.php';
    include_once '../functions/arrays.php';
    include_once '../templates/header-admin.php';
    include_once '../templates/sidebar-admin.php';



    //verifica si el usuario esta autenticado
    isAuth();


    $conexion = conectarDDBB(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    //Formulario template general
    //Se evalua que formulario se va a cargar dependiendo el tipo que se pase por url


    //evaluo el tipo de formulario a mostrar
    $form = cargarFormulario($_GET['form']);


    ?>

    <!-- cargo el formulario -->
    <main class="contenedor seccion">

        <?php include_once "../templates/formularios/{$form}" ?>

    </main>

</body>

<?php mysqli_close($conexion); ?>


<script>
    //funcion js para permitir la edicion del formulario
    function editar() {
        var formulario = document.querySelector('.formulario');
        var elementos = formulario.elements;

        // Iterar sobre los elementos del formulario y quitar el atributo 'disabled'
        for (var i = 0; i < elementos.length; i++) {
            elementos[i].removeAttribute('disabled');
        }


    }
</script>

<script>
    //cambio de color de la edicion
    document.getElementById('editarBoton').addEventListener('click', function() {
        // Cambia el color del botón de enviar cuando se hace clic en "Editar proveedor"
        document.getElementById('formG').querySelector('input[type="submit"]').classList.remove('boton-gris');
        document.getElementById('formG').querySelector('input[type="submit"]').classList.add('boton-verde');
    });
</script>



<?php

//validacion segun el tipo de formulario
switch ($_GET['form']) {

    case 'proveedor': ?>
        <script src="../functions/validacionesFrontAdmin/valProveedor.js"></script>
    <?php break;

    case 'usuario': ?>
        <script src="../functions/validacionesFrontAdmin/valUsuario.js"></script>
    <?php break;

    case 'mochila': ?>
        <script src="../functions/validacionesFrontAdmin/valMochila.js"></script>

<?php break;
} ?>





</html>