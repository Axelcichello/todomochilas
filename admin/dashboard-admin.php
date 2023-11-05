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
include_once '../templates/header-admin.php'; ?>

 
    <?php 
    session_start();
    echo $_SESSION['nombre']; ?>


</body>
</html>