<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {



    $nombre = saneoString($_POST['nombre'], $caracteresEspeciales);
    $proveedor = intval(filter_var($_POST['proveedor'], FILTER_SANITIZE_NUMBER_INT));
    $precio = intval(filter_var($_POST['precio'], FILTER_SANITIZE_NUMBER_INT));
    $stock = intval(filter_var($_POST['stock'], FILTER_SANITIZE_NUMBER_INT));
    $descripcion = saneoString($_POST['descripcion'], $caracteresEspeciales);

    $nombreFoto = "";


    if (isset($_FILES) && $_FILES['foto']['name'] != "") {

        $archivo = $_FILES['foto'];
        $tipoArchivo = $_FILES['foto']['type'];

        if ($tipoArchivo == "image/jpg" || $tipoArchivo == "image/png" || $tipoArchivo == "image/jpeg") {

            $extencionFoto = evaluarExtencion($tipoArchivo);

            $nombreFoto = md5(uniqid($_FILES['foto']['name'])) . $extencionFoto;

            $rutaDestino = DIR_MOCHILA . $nombreFoto;

            if (!is_dir(DIR_MOCHILA)) {
                mkdir(DIR_MOCHILA);
            }

            move_uploaded_file($archivo['tmp_name'], $rutaDestino);
        }
    }



    if (!isset($nombre) || $nombre === '') {
        array_push($errores, "El nombre no puede ir vacio");
    }

    if (!isset($proveedor) || $proveedor == 0) {
        array_push($errores, "El proveedor no puede ir vacio");
    }

    if (!isset($precio) || $precio == 0) {
        array_push($errores, "El precio no puede ir vacio");
    }

    if (!isset($stock) || $stock == 0) {
        array_push($errores, "El stock no puede ir vacio");
    }

    if (count($errores) > 0) {
        notificarErrores($errores);
    } else {

        $query = "INSERT INTO mochila (nombre_mochila, precio_mochila, stock_mochila, descripcion_mochila, proveedor_id_proveedor, foto_mochila) VALUES ('{$nombre}', '{$precio}', '{$stock}', '{$descripcion}', '{$proveedor}', '{$nombreFoto}')";

        $respuesta = mysqli_query($conexion, $query);

        if ($respuesta == true) { ?>

            <div class="notificacion exito">
                <p>Proveedor registrado correctamente</p>
            </div>

<?php }
    }
}


?>


<h2 class="subtitulo">REGISTRAR mochila</h2>


<form method="POST" action="./formulario-admin.php?form=mochila" class="formulario" enctype="multipart/form-data">

    <fieldset>
        <legend>Informacion General del Producto</legend>

        <label for="nombre">Nombre de la mochila</label>
        <input type="text" id="nombre" name="nombre" placeholder="Ingrese nombre del producto">

        <label for="proveedor">Proveedor</label>

        <select name="proveedor" id="proveedor">

            <?php

            $proveedores = traerTodo('proveedor', $conexion);
            foreach ($proveedores as $proveedor) { ?>


                <option value="<?php echo $proveedor['id_proveedor']; ?>"> <?php echo $proveedor['nombre_proveedor']; ?> </option>

            <?php  } ?>
        </select>

        <label for="precio">precio</label>
        <input type="number" id="precio" name="precio" placeholder="Ingrese el precio">

        <label for="stock">stock</label>
        <input type="number" name="stock" id="stock" placeholder="Ingrese el stock">

        <label for="descripcion">descripcion</label>
        <textarea style="resize: none;" name="descripcion" id="descripcion" cols="30" rows="10"></textarea>

        <label for="foto">foto</label>
        <input type="file" name="foto" id="foto" placeholder="Foto de la mochila">

    </fieldset>



    <input type="submit" class="boton boton-verde" value="REGISTRAR PRODUCTO">

</form>