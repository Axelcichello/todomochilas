<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalizer.css">
    <link rel="stylesheet" href="css/estilos.css">
    <title>TodoMochilas | Producto</title>
</head>


<body>

    <?php

    include 'functions/arrays.php';
    include 'functions/config.php';
    include 'functions/funciones.php';
    include 'templates/header.php';

    $conexion = conectarDDBB(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


    $id = $_POST['id'];

    $sql = "SELECT * FROM mochila WHERE id_mochila = {$id}";

    $resultado = mysqli_query($conexion, $sql);

    if(mysqli_num_rows($resultado) > 0){

        $producto = mysqli_fetch_assoc($resultado);
    }else{

        array_push($errores, "Producto inexistente");
        notificarErrores($errores);
    }


    ?>

    <main class="contenedor">
        <h1><?php echo $producto['nombre_mochila'] ?></h1>

        <div class="descripcion">
            <img src="./img/mochilas/<?php echo $producto['foto_mochila'] ?>" alt="Mochila">

            <div class="mochila-descripcion">
                <p><?php echo $producto['descripcion_mochila'] ?></p>

                <p class="precio-prod">$<?php echo $producto['precio_mochila'] ?></p>

                <form action="#" class="formulario" method="POST">
                    <select name="talle" id="talle">
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>

                    <input type="number" placeholder="cantidad" min="1">

                    <input type="submit" class="boton-amarillo" value="comprar" disabled="disabled">


                </form>
            </div>
        </div>
    </main>

    <?php

    include 'templates/footer.php';

    ?>

</body>

</html>