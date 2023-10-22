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
    include 'templates/header.php';

    $id = $_POST['id'];
    $imagen = $_POST['imagen'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];

    ?>

    <main class="contenedor">
        <h1><?php echo $nombre ?></h1>

        <div class="descripcion">
            <img src="img/<?php echo $imagen ?>.jpg" alt="Mochila">

            <div class="mochila-descripcion">
                <p><?php echo $descripcion ?></p>

                <p class="precio-prod">$<?php echo $precio ?></p>

                <form action="#" class="formulario" method="POST">
                    <select name="talle" id="talle">
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>

                    <input type="number" placeholder="cantidad" min="1">

                    <input type="submit" class="boton-amarillo" value="comprar" disabled= "disabled">


                </form>
            </div>
        </div>
    </main>

    <?php

    include 'templates/footer.php';

    ?>

</body>

</html>