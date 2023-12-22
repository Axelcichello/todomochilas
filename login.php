<?php

include_once './functions/config.php';
include_once './functions/funciones.php';
include_once './functions/arrays.php';

$mysqli = conectarDDBB(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {





    //Inicia la preparada

    $query = "SELECT * FROM usuario WHERE correo_usuario = ? AND password_usuario = ?";
    $stmt = $mysqli->prepare($query);

    //Enlaza valores segun el tipo y la variable

    $stmt->bind_param("ss", $correo, $password);
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    //Ejecuta la consulta

    $stmt->execute();

    //Procesa los resultados

    $result = $stmt->get_result();

    //Si devuelve una columna es por que encontro un usuario con el pass correspondiente

    if (mysqli_num_rows($result) === 1) {

        $datos = mysqli_fetch_assoc($result);

        //Se inicia una sesion y se cargan los datos 

        session_start();

        $_SESSION['sesion'] = true;
        $_SESSION['nombre'] = $datos['nombre_usuario'];
        $_SESSION['apellido'] = $datos['apellido_usuario'];
        $_SESSION['legajo'] = $datos['legajo_usuario'];
        $_SESSION['dni'] = $datos['dni_usuario'];
        $_SESSION['correo'] = $datos['correo_usuario'];
        $_SESSION['nivel'] = $datos['nivel_usuario'];

        header("Location: ./admin/dashboard-admin.php");
    } else {
        //Si no se encuentra nada se muestra el error
        array_push($errores, "Usuario o contraseña incorrecta");
        notificarErrores($errores);
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalizer.css">
    <link rel="stylesheet" href="css/estilos.css">
    <title>TodoMochilas | Login</title>
</head>

<body>

    <!-- formulario para inicio de sesion (login) -->
    <div class="contenedor-login">
        <div class="login">
            <h1 class="titulo-login">TodoMochilas Admin</h1>
            <p class="parrafo-login">Ingrese sus credenciales</p>

            <form action="login.php" method="POSt">
                <label for="correo">Correo Electronico</label>
                <input type="text" name="correo" id="correo">

                <label for="password">Password</label>
                <input type="password" name="password" id="password">

                <input type="submit" value="INGRESAR">
            </form>
        </div>
    </div>
</body>

<?php mysqli_close($mysqli); ?>


</html>