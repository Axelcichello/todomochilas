<?php

include 'functions/funciones.php';
include 'functions/config.php';
include 'templates/header-admin.php';

$archivo = $_FILES['foto'];
$tipoArchivo = $_FILES['foto']['type'];


$extencionFoto = evaluarExtencion($tipoArchivo);

$nombreArchivo = md5( uniqid( $_FILES['foto']['name'])) . $extencionFoto;




if(isset($_FILES)){
    if($tipoArchivo == "image/jpg" || $tipoArchivo == "image/png" || $tipoArchivo == "image/jpeg"){
        $rutaDestino = DIR_MOCHILA . $nombreArchivo;

        if(!is_dir(DIR_MOCHILA)){
            mkdir(DIR_MOCHILA);
        }

        move_uploaded_file($archivo['tmp_name'], $rutaDestino);

    }
}