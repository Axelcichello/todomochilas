<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalizer.css">
    <link rel="stylesheet" href="css/estilos.css">
    <title>TodoMochilas | Contacto</title>
</head>

<body>

    <?php

    include 'functions/arrays.php';
    include 'functions/funciones.php';
    include 'templates/header.php';

    $nombre = saneoString($_POST['nombre'], $caracteresEspeciales);

    $apellido = strip_tags($_POST['apellido']);

    $telefono = intval(filter_var($_POST['telefono'], FILTER_SANITIZE_NUMBER_INT));

    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    $mensaje = strip_tags($_POST['mensaje']);

    $mochila = strip_tags($_POST['mochila']);

    $foto = strip_tags($_POST['foto']);




    if (!isset($nombre) || $nombre === "") {
        array_push($errores, "Error al cargar el nombre");
    } else {
        if (!is_string($nombre) || is_null($nombre)) {
            array_push($errores, "El nombre no puede tener numeros");
        }
    }


    if (!isset($apellido) || $apellido === "") {
        array_push($errores, "Error al cargar el apellido");
    } else {
        if (!is_string($apellido) || is_null($apellido)) {
            array_push($errores, "El apellido no puede tener numeros");
        }
    }


    if (!isset($telefono) || $telefono === 0) {
        array_push($errores, "Error al cargar el telefono");
    } else {
        if (!is_int($telefono)) {
            array_push($errores, "El telefono no pudo ser cargado");
        }
    }


    if (!isset($email) || $email === "") {
        array_push($errores, "Error al cargar el email");
    }

    if (!isset($mensaje) || $mensaje === "") {
        array_push($errores, "Debe cargar un mensaje");
    }

    ?>

    <main class="contenedor">
        <h1 class="cont">Solicitud de contacto</h1>


        <div class="notificaciones">

            <?php

            if (count($errores) > 0) { ?>


                <div class="notificar-error">

                    <?php notificarErrores($errores); ?>

                </div>

                <div class="div-fotomochila">
                        <img src="./img/mochila-llorando.jpg" alt="Mochila llorando" class="foto-mochila">
                    </div>




                <p>Por favor, vuelva a cargar el formulario.</p>


            <?php } else { ?>

                <div class="notificacion exito">
                    <p>Datos cargados correctamente</p>
                </div>

                <p>Gracias por comunicarse con nosotros, a continuacion le detallamos el pedido:</p>

                <ul class="detalle">
                    <li>Nombre: <?php echo $nombre ?></li>
                    <li>Apellido: <?php echo $apellido ?></li>
                    <li>Telefono: <?php echo $telefono ?></li>
                    <li>Email: <?php echo $email ?></li>
                    <li>Mensaje: <?php echo $mensaje ?></li>
                </ul>

                <p>Uno de nuestros representastes se estara poniendo en contacto con usted a la brevedad. En caso de que los datos que se visualizan no sean los correctos, vuelva a cargar un nuevo formulario.</p>

                <div class="div-fotomochila">
                    <img src="./img/mochila-feliz.jpg" alt="Mochila llorando" class="foto-mochila">
                </div>


            <?php } ?>





        </div>
    </main>

    <?php
    include 'templates/footer.php';
    ?>

</body>

</html>