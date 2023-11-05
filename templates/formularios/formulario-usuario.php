<?php


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

        if ($respuesta ==    TRUE) { ?>

            <div class="notificacion exito">
                <p>Usuario registrado correctamente</p>
            </div>

<?php }
    }
}















































?>


<h2 class="subtitulo">REGISTRAR usuario</h2>


<form method="POST" action="./formulario-admin.php?form=usuario" class="formulario" enctype="multipart/form-data">

    <fieldset>
        <legend>Informacion del usuario</legend>

        <label for="nombre">Nombre del usuario</label>
        <input type="text" name="nombre" id="nombre" placeholder="Ingrese nombre del usuario">

        <label for="apellido">Apellido del usuario</label>
        <input type="text" name="apellido" id="apellido" placeholder="Ingrese apellido del usuario">

        <label for="dni">DNI del usuario</label>
        <input type="number" name="dni" id="dni" placeholder="Ingrese DNI del usuario">

        <label for="legajo">Legajo del usuario</label>
        <input type="number" id="legajo" name="legajo" placeholder="Ingrese legajo del usuario">

        <label for="correo">Correo del usuario</label>
        <input type="email" id="correo" name="correo" placeholder="Ingrese correo del usuario">

        <label for=password">Contraseña del usuario</label>
        <input type="text" id="password" name="password" placeholder="Ingrese contraseña del usuario">

        <label for="password2">Repetir contraseña</label>
        <input type="text" name="password2" id="password2" placeholder="Repetir contraseña">

    </fieldset>

    <input type="submit" class="boton boton-verde" value="REGISTRAR USUARIO">

</form>