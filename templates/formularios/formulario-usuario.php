<?php

isAdmin();

if (isset($_GET['id'])) {

    $idBuscar = $_GET['id'];

    $usuarios = traerTodo('usuario', $conexion, $agregado);
    $buscado = traerBuscado($usuarios, $idBuscar, 'usuario');
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nombre = saneoString($_POST['nombre'], $caracteresEspeciales);
    $apellido = saneoString($_POST['apellido'], $caracteresEspeciales);
    $legajo = intval(filter_var($_POST['legajo'], FILTER_SANITIZE_NUMBER_INT));
    $dni = intval(filter_var($_POST['dni'], FILTER_SANITIZE_NUMBER_INT));
    $correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $password2 = $_POST['password2'];


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

        if (!isset($password) || $password === '') {
            array_push($errores, "El password no puede ir vacio");
        }

        if (!isset($password2) || $password2 === '') {
            array_push($errores, "El password repetido no puede ir vacio");
        } else if ($password != '' && $password != $password2) {
            array_push($errores, "Las contraseñas no coinciden");
        }

        if (count($errores) > 0) {
            notificarErrores($errores);
        } else {
            $query = "INSERT INTO usuario (nombre_usuario, apellido_usuario, dni_usuario, legajo_usuario, password_usuario, correo_usuario) VALUES ('{$nombre}', '{$apellido}', '{$dni}', '{$legajo}', '{$password}', '{$correo}')";

            $respuesta = mysqli_query($conexion, $query);

            if ($respuesta ==    TRUE) {
                notificacionExito("usuario", "registrado");
            }
        }
    } else {

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

<?php if (isset($idBuscar)) { ?>
    <h2 class="subtitulo">EDITAR Usuario</h2>

<?php } else { ?>
    <h2 class="subtitulo">REGISTRAR usuario</h2>

<?php } ?>


<?php echo isset($_GET['id']) ? '<button class="boton-editar" onclick="editar()" type="button">EDITAR USUARIO</button>' : ''; ?>


<?php if (isset($idBuscar)) { ?>

    <form action="./formulario-admin.php?form=usuario&id=<?php echo $_GET['id'] ?>" method="POST" class="formulario">


    <?php } else { ?>

        <form action="./formulario-admin.php?form=usuario" method="POST" class="formulario">

        <?php } ?>

        <fieldset>
            <legend>Informacion del usuario</legend>


            <label for="nombre">Nombre del usuario</label>
            <input <?php echo isset($_GET['id']) ? 'disabled' : '' ?> type="text" value="<?php echo (isset($_GET) ? $buscado[0]['nombre_usuario'] : "") ?>" name="nombre" id="nombre" placeholder="Ingrese nombre del usuario">

            <label for="apellido">Apellido del usuario</label>
            <input <?php echo isset($_GET['id']) ? 'disabled' : '' ?> type="text" value="<?php echo (isset($_GET) ? $buscado[0]['apellido_usuario'] : "") ?>" name="apellido" id="apellido" placeholder="Ingrese apellido del usuario">

            <label for="dni">DNI del usuario</label>
            <input type="number" <?php echo isset($_GET['id']) ? 'disabled' : '' ?> value="<?php echo (isset($_GET) ? $buscado[0]['dni_usuario'] : "") ?>" name="dni" id="dni" placeholder="Ingrese DNI del usuario">

            <label for="legajo">Legajo del usuario</label>
            <input type="number" <?php echo isset($_GET['id']) ? 'disabled' : '' ?> value="<?php echo (isset($_GET) ? $buscado[0]['legajo_usuario'] : "") ?>" id="legajo" name="legajo" placeholder="Ingrese legajo del usuario">

            <label for="correo">Correo del usuario</label>
            <input type="email" <?php echo isset($_GET['id']) ? 'disabled' : '' ?> value="<?php echo (isset($_GET) ? $buscado[0]['correo_usuario'] : "") ?>" id="correo" name="correo" placeholder="Ingrese correo del usuario">


            <?php if (!isset($_GET['id'])) { ?>

                <label for=password">Contraseña del usuario</label>
                <input type="password" id="password" name="password" oninput="verificarPassword()" placeholder="Ingrese contraseña del usuario">

                <label for="password2">Repetir contraseña</label>
                <input type="password" name="password2" id="password2" oninput="verificarPassword()" placeholder="Repetir contraseña">

            <?php } ?>

        </fieldset>

        <input type="submit" class="boton boton-verde" value="REGISTRAR USUARIO">

        </form>