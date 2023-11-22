<?php

if (isset($_GET['id'])) {

    $idBuscar = $_GET['id'];

    $query = "SELECT * FROM mochila INNER JOIN proveedor ON mochila.proveedor_id_proveedor = proveedor.id_proveedor";
    $query = mysqli_query($conexion, $query);

    if (mysqli_num_rows($query) > 0) {

        while ($row = mysqli_fetch_assoc($query)) {
            if ($row['id_mochila'] == $idBuscar) {
                $buscado[] = $row;
            }
        }
    }
}

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

    if ($_FILES['foto']['size'] > 1000000 && isset($_FILES) && $_FILES['foto']['name'] != "") {
        array_push($errores, "Archivo muy grande");
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


    if (!isset($_GET['id'])) {

        if (count($errores) > 0) {
            notificarErrores($errores);
        } else {

            $query = "INSERT INTO mochila (nombre_mochila, precio_mochila, stock_mochila, descripcion_mochila, proveedor_id_proveedor, foto_mochila) VALUES ('{$nombre}', '{$precio}', '{$stock}', '{$descripcion}', '{$proveedor}', '{$nombreFoto}')";

            $respuesta = mysqli_query($conexion, $query);

            if ($respuesta == true) { ?>

                <div class="notificacion exito">
                    <p>Mochila registrada correctamente</p>
                </div>

            <?php }
        }
    } else {

        if (count($errores) > 0) {
            notificarErrores($errores);
        } else {

            $sql = "UPDATE mochila SET nombre_mochila = '{$nombre}', precio_mochila = '{$precio}', stock_mochila = '{$stock}', descripcion_mochila = '{$descripcion}', proveedor_id_proveedor = '{$proveedor}', foto_mochila = '{$nombreFoto}' WHERE id_mochila = '{$idBuscar}'";

            $respuesta = mysqli_query($conexion, $sql);

            if ($respuesta == TRUE) { ?>

                <div class="notificacion exito">
                    <p>Mochila actualizada correctamente</p>
                </div>

<?php }
        }
    }
}

?>






<?php if (isset($idBuscar)) { ?>
    <h2 class="subtitulo">EDITAR Mochila</h2>

<?php } else { ?>
    <h2 class="subtitulo">REGISTRAR mochila</h2>
<?php } ?>

<?php echo isset($_GET['id']) ? '<button class="boton-editar" onclick="editar()" type="button">EDITAR MOCHILA</button>' : ''; ?>

<?php if (isset($idBuscar)) { ?>

    <form action="./formulario-admin.php?form=mochila&id=<?php echo $_GET['id'] ?>" enctype="multipart/form-data" method="POST" class="formulario">

    <?php } else { ?>

        <form action="./formulario-admin.php?form=mochila" method="POST" enctype="multipart/form-data" class="formulario">

        <?php } ?>

    <fieldset>
        <legend>Informacion General del Producto</legend>

        <label for="nombre">Nombre de la mochila</label>
        <input <?php echo isset($_GET['id']) ? 'disabled' : '' ?> type="text" value="<?php echo (isset($_GET) ? $buscado[0]['nombre_mochila'] : "") ?>" id="nombre" name="nombre" placeholder="Ingrese nombre del producto">

        <label for="proveedor">Proveedor</label>

        <select <?php echo isset($_GET['id']) ? 'disabled' : '' ?> name="proveedor" id="proveedor">

            <?php if (!isset($_GET['id'])) {

                $proveedores = traerTodo('proveedor', $conexion);
                foreach ($proveedores as $proveedor) { ?>

                    <option value="<?php echo $proveedor['id_proveedor']; ?>"> <?php echo $proveedor['nombre_proveedor']; ?> </option>

                <?php  }
            } else { ?>
                <option value="<?php echo $buscado[0]['id_proveedor']; ?>"> <?php echo $buscado[0]['nombre_proveedor']; ?> </option>
            <?php } ?>
        </select>

        <label for="precio">precio</label>
        <input <?php echo isset($_GET['id']) ? 'disabled' : '' ?> type="number" value="<?php echo (isset($_GET) ? $buscado[0]['precio_mochila'] : "") ?>" id="precio" name="precio" placeholder="Ingrese el precio">

        <label for="stock">stock</label>
        <input <?php echo isset($_GET['id']) ? 'disabled' : '' ?> type="number" value="<?php echo (isset($_GET) ? $buscado[0]['stock_mochila'] : "") ?>" name="stock" id="stock" placeholder="Ingrese el stock">

        <label for="descripcion">descripcion</label>
        <textarea <?php echo isset($_GET['id']) ? 'disabled' : '' ?> style="resize: none;" name="descripcion" id="descripcion" cols="30" rows="10"><?php echo (isset($_GET) ? $buscado[0]['descripcion_mochila'] : "") ?></textarea>

        <label for="foto">foto</label>
        <input <?php echo isset($_GET['id']) ? 'disabled' : '' ?> type="file" name="foto" id="foto" placeholder="Foto de la mochila">



        <?php

        if (isset($_GET['id'])) { ?>

            <img class="mochila-editar" src="<?php echo DIR_MOCHILA . $buscado[0]['foto_mochila'] ?>" alt="Foto mochila buscada">

        <?php } ?>

    </fieldset>

    <input type="submit" class="boton boton-verde" value="REGISTRAR PRODUCTO">

</form>