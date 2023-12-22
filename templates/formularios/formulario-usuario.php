<?php

isAdmin();

if (isset($_GET['id'])) {

    //Funcion para cargar los datos para editar


    $idBuscar = $_GET['id'];
    $agregado = '';


    $usuarios = traerTodo('usuario', $conexion, $agregado);
    $buscado = traerBuscado($usuarios, $idBuscar, 'usuario');
}

//Si se entra mediante un POST pasara a la parte de saneo, validacion e insersion en la BBDD

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //Etapa de saneo


    $nombre = saneoString($_POST['nombre'], $caracteresEspeciales);
    $apellido = saneoString($_POST['apellido'], $caracteresEspeciales);
    $legajo = intval(filter_var($_POST['legajo'], FILTER_SANITIZE_NUMBER_INT));
    $dni = intval(filter_var($_POST['dni'], FILTER_SANITIZE_NUMBER_INT));
    $correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);

    if (!isset($_GET['id'])) {

        $password = $_POST['password'];
        $password2 = $_POST['password2'];
    }

    //Etapa de validacion


    if (!isset($nombre) || $nombre === '') {
        array_push($errores, "El nombre no puede ir vacio");
    }

    if (!isset($apellido) || $apellido === '') {
        array_push($errores, "El apellido no puede ir vacio");
    }

    if (!isset($legajo) || $legajo === 0) {
        array_push($errores, "El legajo no puede ir vacio");
    }

    if (!isset($dni) || $dni === 0) {
        array_push($errores, "El dni no puede ir vacio");
    }

    if (!isset($correo) || $correo === '') {
        array_push($errores, "El correo no puede ir vacio");
    }




    if (!isset($_GET['id'])) {

        //Validacion de correo repetido


        if (!isset($password) || $password === '') {
            array_push($errores, "El password no puede ir vacio");
        }

        if (!isset($password2) || $password2 === '') {
            array_push($errores, "El password repetido no puede ir vacio");
        } else if ($password != '' && $password != $password2) {
            array_push($errores, "Las contraseñas no coinciden");
        }

        //Etapa de mostrar errores o continuar a la insersion


        if (count($errores) > 0) {
            notificarErrores($errores);
        } else {

            //etapa de registro

            $query = "INSERT INTO usuario (nombre_usuario, apellido_usuario, dni_usuario, legajo_usuario, password_usuario, correo_usuario) VALUES ('{$nombre}', '{$apellido}', '{$dni}', '{$legajo}', '{$password}', '{$correo}')";

            $respuesta = mysqli_query($conexion, $query);

            if ($respuesta ==    TRUE) {
                notificacionExito("usuario", "registrado");
            }
        }
    } else {

        //esta es la parte de ediciopn
        //muestra errores si los hay

        if (count($errores) > 0) {
            notificarErrores($errores);
        } else {

            $sql = "UPDATE usuario SET nombre_usuario = '{$nombre}', apellido_usuario = '{$apellido}', dni_usuario = '{$dni}', legajo_usuario = '{$legajo}', correo_usuario = '{$correo}' WHERE id_usuario = '{$idBuscar}'";

            $respuesta = mysqli_query($conexion, $sql);

            if ($respuesta == TRUE) {

                notificacionExito("usuario", "actualizado");
            }
        }
    }
}
?>

<!-- muestra el titulo de editar o registrar segun sea el caso -->


<?php if (isset($idBuscar)) { ?>
    <h2 class="subtitulo">EDITAR Usuario</h2>

<?php } else { ?>
    <h2 class="subtitulo">REGISTRAR usuario</h2>

<?php } ?>

<!-- si es una edicion va a mostrar el boton para editar -->



<?php echo isset($_GET['id']) ? '<button class="boton-editar" id="editarBoton" onclick="editar()" type="button">EDITAR USUARIO</button>' : ''; ?>


<?php if (isset($idBuscar)) { ?>

    <!-- carga el formulario segun sea de edicion o de registro -->


    <form id="formG" action="./formulario-admin.php?form=usuario&id=<?php echo $_GET['id'] ?>" method="POST" class="formulario" onsubmit="return validarFormulario();">


    <?php } else { ?>

        <form id="formG" action="./formulario-admin.php?form=usuario" method="POST" class="formulario" onsubmit="return validarFormulario();">

        <?php } ?>

        <fieldset>

            <!-- si es un registro no se van a mostrar datos en los inputs
        si es una edicion los campos van a estar rellenos con la info que se quiera ver o actualizar y se debera tocar en editar para que sea editable -->

            <legend>Informacion del usuario</legend>


            <label for="nombre">Nombre del usuario</label>
            <input <?php echo isset($_GET['id']) ? 'disabled' : '' ?> type="text" value="<?php echo (isset($_GET['id']) ? $buscado[0]['nombre_usuario'] : "") ?>" name="nombre" id="nombre" placeholder="Ingrese nombre del usuario">

            <label for="apellido">Apellido del usuario</label>
            <input <?php echo isset($_GET['id']) ? 'disabled' : '' ?> type="text" value="<?php echo (isset($_GET['id']) ? $buscado[0]['apellido_usuario'] : "") ?>" name="apellido" id="apellido" placeholder="Ingrese apellido del usuario">

            <label for="dni">DNI del usuario</label>
            <input type="number" <?php echo isset($_GET['id']) ? 'disabled' : '' ?> value="<?php echo (isset($_GET['id']) ? $buscado[0]['dni_usuario'] : "") ?>" name="dni" id="dni" placeholder="Ingrese DNI del usuario">

            <label for="legajo">Legajo del usuario</label>
            <input type="number" <?php echo isset($_GET['id']) ? 'disabled' : '' ?> value="<?php echo (isset($_GET['id']) ? $buscado[0]['legajo_usuario'] : "") ?>" id="legajo" name="legajo" placeholder="Ingrese legajo del usuario">

            <label for="correo">Correo del usuario</label>
            <input type="email" <?php echo isset($_GET['id']) ? 'disabled' : '' ?> value="<?php echo (isset($_GET['id']) ? $buscado[0]['correo_usuario'] : "") ?>" id="correo" name="correo" placeholder="Ingrese correo del usuario">


            <?php if (!isset($_GET['id'])) { ?>

                <label for="password">Contraseña del usuario</label>
                <input type="password" id="password" name="password" oninput="verificarPassword()" placeholder="Ingrese contraseña del usuario">

                <label for="password2">Repetir contraseña</label>
                <input type="password" name="password2" id="password2" oninput="verificarPassword()" placeholder="Repetir contraseña">

            <?php } ?>

        </fieldset>

        <!-- muestro el submit segun sea editar o registrar -->


        <?php if (isset($idBuscar)) { ?>
            <input type="submit" disabled class="boton boton-gris" value="ACTUALIZAR USUARIO">
        <?php } else { ?>
            <input type="submit" class="boton boton-verde" value="REGISTRAR USUARIO">
        <?php } ?>

        </form>