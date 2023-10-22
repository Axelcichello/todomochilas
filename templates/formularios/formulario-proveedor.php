<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $nombre = saneoString($_POST['nombre'], $caracteresEspeciales);

    $telefono = intval(filter_var($_POST['telefono'], FILTER_SANITIZE_NUMBER_INT));

    $correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);

    $direccion = saneoString($_POST['direccion'], $caracteresEspeciales);

    $localidad = saneoString($_POST['localidad'], $caracteresEspeciales);

    if (!isset($nombre) || $nombre === '') {
        array_push($errores, "El nombre no puede ir vacio");
    }

    if (!isset($telefono) || $telefono === 0) {
        array_push($errores, "El telefono no puede ir vacio");
    }

    if (!isset($correo) || $correo === "") {
        array_push($errores, "El correo no puede ir vacio");
    }

    if (!isset($direccion) || $direccion === '') {
        array_push($errores, "El direccion no puede ir vacia");
    }

    if (!isset($localidad) || $localidad === '') {
        array_push($errores, "El localidad no puede ir vacia");
    }

    if (count($errores) > 0) {
        notificarErrores($errores);
    } else {
        $query = "INSERT INTO proveedor (nombre_proveedor, telefono_proveedor, correo_proveedor , direccion_proveedor, localidad_proveedor) VALUES ('{$nombre}', '{$telefono}', '{$correo}', '{$direccion}', '{$localidad}')";

        $respuesta = mysqli_query($conexion, $query);

        debuguear($respuesta);

    }
}
?>




<h2 class="subtitulo">REGISTRAR proveedor</h2>


<form action="./formulario-admin.php?form=proveedor" method="POST" class="formulario">

    <fieldset>
        <legend>Informacion General del Proveedor</legend>

        <label for="nombre">Nombre del proveedor</label>
        <input type="text" name="nombre" id="nombre" placeholder="Ingrese nombre del proveedor">

        <label for="telefono">Telefono del proveedor</label>
        <input type="number" name="telefono" id="telefono" placeholder="Ingrese telefono del proveedor">

        <label for="email">Correo electronico del proveedor</label>
        <input type="email" name="correo" id="email" placeholder="Ingrese correo del proveedor">

        <label for="direccion">Direccion del proveedor</label>
        <input type="text" name="direccion" id="direccion" placeholder="Ingrese direccion del proveedor">

        <label for="localidad">Localidad del proveedor</label>
        <input type="text" name="localidad" id="localidad" placeholder="Ingrese localidad del proveedor">

    </fieldset>


    <input type="submit" class="boton boton-verde" value="REGISTRAR PROVEEDOR">

</form>