<?php



if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    include_once './functions/config.php';
    include_once './functions/funciones.php';
    include_once './functions/arrays.php';

    $correo = $_POST['correo'];
    $password = $_POST['password'];

    $query = "SELECT * FROM usuario WHERE correo = '${correo}'";
    debuguear($query);
}


































?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalizer.css">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Login | TodoMochilas</title>
</head>

<body>
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

</html>