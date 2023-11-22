<?php



if (isset($_GET['id'])) {

    $idBuscar = $_GET['id'];

    $proveedores = traerTodo('proveedor', $conexion);

    foreach ($proveedores as $proveedor) {

        if ($proveedor['id_proveedor'] == $idBuscar) {
            $buscado[] = $proveedor;
        }
    }
}

//Si se entra mediante un POST pasara a la parte de saneo, validacion e insersion en la BBDD

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //Etapa de saneo

    $nombre = saneoString($_POST['nombre'], $caracteresEspeciales);

    $telefono = intval(filter_var($_POST['telefono'], FILTER_SANITIZE_NUMBER_INT));

    $correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);

    $direccion = saneoString($_POST['direccion'], $caracteresEspeciales);

    $localidad = saneoString($_POST['localidad'], $caracteresEspeciales);

    //Etapa de validacion

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

    

    if (!isset($_GET['id'])) {

        //Validacion de correo repetido

        $query = "SELECT * FROM proveedor WHERE correo_proveedor = '${correo}'";
        $resultado = mysqli_query($conexion, $query);

        if (mysqli_num_rows($resultado) > 0) {
            array_push($errores, "Este proveedor ya existe");
        }


        //Etapa de mostrar errores o continuar a la insersion

        if (count($errores) > 0) {
            notificarErrores($errores);
        } else {

            $query = "INSERT INTO proveedor (nombre_proveedor, telefono_proveedor, correo_proveedor , direccion_proveedor, localidad_proveedor) VALUES ('{$nombre}', '{$telefono}', '{$correo}', '{$direccion}', '{$localidad}')";

            $respuesta = mysqli_query($conexion, $query);


            if ($respuesta == TRUE) { ?>

                <div class="notificacion exito">
                    <p>Proveedor registrado correctamente</p>
                </div>

            <?php }
        }
    } else {

        if (count($errores) > 0) {
            notificarErrores($errores);
        } else {

            $sql = "UPDATE proveedor SET nombre_proveedor = '{$nombre}', telefono_proveedor = '{$telefono}', correo_proveedor = '{$correo}', direccion_proveedor = '{$direccion}', localidad_proveedor = '{$localidad}' WHERE id_proveedor = '{$idBuscar}'";

            $respuesta = mysqli_query($conexion, $sql);

            if ($respuesta == TRUE) { ?>

                <div class="notificacion exito">
                    <p>Proveedor actualizado correctamente</p>
                </div>

<?php }
        }
    }
}
?>



<?php if (isset($idBuscar)) { ?>
    <h2 class="subtitulo">EDITAR proveedor</h2>

<?php } else { ?>
    <h2 class="subtitulo">REGISTRAR proveedor</h2>
<?php } ?>


<?php echo isset($_GET['id']) ? '<button class="boton-editar" onclick="editar()" type="button">EDITAR PROVEEDOR</button>' : ''; ?>


<?php if (isset($idBuscar)) { ?>

    <form action="./formulario-admin.php?form=proveedor&id=<?php echo $_GET['id'] ?>" method="POST" class="formulario">


    <?php } else { ?>

        <form action="./formulario-admin.php?form=proveedor" method="POST" class="formulario">

        <?php } ?>


        <fieldset>
            <legend>Informacion General del Proveedor</legend>


            <label for="nombre">Nombre del proveedor</label>
            <input <?php echo isset($_GET['id']) ? 'disabled' : '' ?> type="text" value="<?php echo (isset($_GET) ? $buscado[0]['nombre_proveedor'] : "") ?>" name="nombre" id="nombre" placeholder="Ingrese nombre del proveedor">

            <label for="telefono">Telefono del proveedor</label>
            <input <?php echo isset($_GET['id']) ? 'disabled' : '' ?> type="number" value="<?php echo (isset($_GET) ? $buscado[0]['telefono_proveedor'] : "") ?>" name="telefono" id="telefono" placeholder="Ingrese telefono del proveedor">

            <label for="email">Correo electronico del proveedor</label>
            <input <?php echo isset($_GET['id']) ? 'disabled' : '' ?> type="email" value="<?php echo (isset($_GET) ? $buscado[0]['correo_proveedor'] : "") ?>" name="correo" id="email" placeholder="Ingrese correo del proveedor">

            <label for="direccion">Direccion del proveedor</label>
            <input <?php echo isset($_GET['id']) ? 'disabled' : '' ?> type="text" value="<?php echo (isset($_GET) ? $buscado[0]['direccion_proveedor'] : "") ?>" name="direccion" id="direccion" placeholder="Ingrese direccion del proveedor">

            <label for="localidad">Localidad del proveedor</label>
            <input <?php echo isset($_GET['id']) ? 'disabled' : '' ?> type="text" value="<?php echo (isset($_GET) ? $buscado[0]['localidad_proveedor'] : "") ?>" name="localidad" id="localidad" placeholder="Ingrese localidad del proveedor">



        </fieldset>


        <?php if (isset($idBuscar)) { ?>
            <input type="submit" class="boton boton-verde" value="ACTUALIZAR PROVEEDOR">
        <?php } else { ?>
            <input type="submit" class="boton boton-verde" value="REGISTRAR PROVEEDOR">
        <?php } ?>

        </form>