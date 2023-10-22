<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalizer.css">
    <link rel="stylesheet" href="css/estilos.css">
    <title>TodoMochilas | Contacto</title>
</head>

<body>

    <?php
    include 'functions/arrays.php';
    include 'templates/header.php';

    ?>

    <main class="contenedor">
        <h1 class="subtitulo">Contacto</h1>

        <form method="POST" action="notificacion.php" class="formulario">

            <fieldset>
                <legend>Informacion de contacto</legend>

                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Ingrese su nomobre">

                <label for="apellido">Apellido</label>
                <input type="text" id="apellido" placeholder="Ingrese su apellido" name="apellido">

                <label for="telefono">Telefono</label>
                <input type="number" id="telefono" placeholder="Numero de contacto" name="telefono">

                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Correo electronico de contacto" name="email">

                <label for="mensaje">Mensaje</label>
                <textarea name="mensaje" id="mensaje"></textarea>
            </fieldset>

            <fieldset class="sublimado">
                <legend>Sublimados</legend>

                <label for="mochila">Talle de mochila</label>
                <select name="mochila" id="mochila">
                    <option value="S">Talle S</option>
                    <option value="M">Talle M</option>
                    <option value="L">Talle L</option>
                    <option value="XL">Talle XL</option>
                </select>

                <label for="foto">Foto</label>
                <p>Cargue el archivo para subimado</p>
                <input type="file" name="foto" id="foto">

                <p>En caso de que la imagen enviada no se pueda cargar</p>

                <div class="similitud">
                    <label for="igual">Adaptarla</label>
                    <input type="radio" name="similitud" value="adaptar" id="igual">

                    <label for="buscar">Buscar otra</label>
                    <input type="radio" name="similitud" value="buscar" id="buscar">
                </div>

            </fieldset>

            <input type="submit" class="boton-amarillo" value="ENVIAR">

        </form>
    </main>

    <?php

    include 'templates/footer.php';

    ?>

</body>

</html>