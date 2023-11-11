<?php

include_once 'functions/funciones.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];

    debuguear($nombre);
}


?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="test.php" method="POST">
        <label for="nombre">nombre</label>
        <input name= "nombre" type="text">

        <input type="submit">
    </form>
</body>

</html>



SELECT * FROM mochila INNER JOIN proveedor ON mochila.proveedor_id_proveedor = proveedor.id_proveedor WHERE mochila.proveedor_id_proveedor = 1