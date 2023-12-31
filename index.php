<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalizer.css">
    <link rel="stylesheet" href="css/estilos.css">
    <title>TodoMochilas | Index</title>
</head>

<body>

    <?php
    include_once './functions/funciones.php';
    include_once './functions/config.php';
    include_once './functions/arrays.php';

    $conexion = conectarDDBB(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    include_once 'templates/header.php';


    ?>


    <main class="contenedor">
        <h1 class="titulo">Somos TodoMochilas</h1>

        <div class="iconos-conocenos">

            <!-- Muestra iconos con los valores del emprendimiento -->

            <div class="icono">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-receipt-2" width="84" height="84" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffbf00" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2" />
                    <path d="M14 8h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5m2 0v1.5m0 -9v1.5" />
                </svg>
                <h2 class="titulo-icono">precio</h2>
                <p>Cuidamos de la mejor forma tu bolsillo, dandote los mejores precios y la mejor calidad en productos
                    para que no tengas la necesidad de buscar en otr lado</p>
            </div>

            <div class="icono">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-tir" width="84" height="84" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffbf00" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M5 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    <path d="M7 18h8m4 0h2v-6a5 7 0 0 0 -5 -7h-1l1.5 7h4.5" />
                    <path d="M12 18v-13h3" />
                    <path d="M3 17l0 -5l9 0" />
                </svg>
                <h2 class="titulo-icono">logistica</h2>
                <p>Tenemos un servicio de envios autonomo, para que no tengas que usar aplicaciones de terceros para
                    gestionar envios, cambios o devoluciones</p>
            </div>

            <div class="icono">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-packages" width="84" height="84" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffbf00" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M7 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" />
                    <path d="M2 13.5v5.5l5 3" />
                    <path d="M7 16.545l5 -3.03" />
                    <path d="M17 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" />
                    <path d="M12 19l5 3" />
                    <path d="M17 16.5l5 -3" />
                    <path d="M12 13.5v-5.5l-5 -3l5 -3l5 3v5.5" />
                    <path d="M7 5.03v5.455" />
                    <path d="M12 8l5 -3" />
                </svg>
                <h2 class="titulo-icono">mayorista</h2>
                <p>¿Estas buscando abastecer tu negocio? consultanos para ofrecerte ofertas de ventas por mayor. Tenemos
                    ofertas en todos los tipos de mochilas</p>
            </div>

        </div>
    </main>

    <!-- banner de mochilas -->

    <section class="seccion-imagen">
        <h2 class="encabezado">¿Estas buscando la mochila ideal?</h2>
        <p class="subencabezado">Consultanos por nuestros modelos personalizados y a medida</p>

        <a href="contacto.php" class="boton-amarillo">Contactanos</a>
    </section>

    <section class="contenedor">
        <h2 class="subtitulo">modelos mas vendidos</h2>

        <!-- muestro los tres modelos mas vendidos mediante php y sql -->

        <div class="contenedor-anuncios">

            <?php

            //Traigo las tres mochilas mas caras
            $resultado = traerTodo('mochila', $conexion, 'ORDER BY precio_mochila DESC LIMIT 3');

            //Las muestro en un array
            foreach ($resultado as $mochila) { ?>


                <div class="anuncio">
                    <img class="anuncio-foto" src="img/mochilas/<?php echo $mochila['foto_mochila'] ?>" alt="anuncio">
                    <div class="contenido-anuncio">
                        <h3><?php echo $mochila['nombre_mochila'] ?></h3>
                        <p><?php echo $mochila['descripcion_mochila'] ?></p>
                        <p class="precio">$<?php echo $mochila['precio_mochila'] ?></p>
                        <a href="galeria.php" class="boton-amarillo">Ver galeria</a>

                    </div>
                </div>

            <?php } ?>



        </div>

        <div class="centrado">
            <a href="galeria.php" class="boton-verde">Ver Todas</a>
        </div>
    </section>


    <section class="contenedor">

        <!-- muestro una pequeña lista de precios -->
        <h2 class="subtitulo">Listado de Precios Actualizado</h2>
        <p class="txt-precios">Los precios se encuentra siempre actualizado. LLevando mas de 5 productos accedes a
            promociones unicas</p>

        <div class="precios">
            <div class="lista">




                <ul class="articulos">


                    <?php
                    //Traigo las 5 mochilas mas caras
                    $resultado = traerTodo('mochila', $conexion, 'ORDER BY precio_mochila DESC LIMIT 5');

                    //Las muestro en pantalla
                    foreach ($resultado as $dato) { ?>

                        <li class="articulo">
                            <p class="articulo-nombre"><?php echo $dato['nombre_mochila'] ?></p>
                            <p class="articulo-precio">$<?php echo $dato['precio_mochila'] ?></p>
                        </li>

                    <?php } ?>


                </ul>

            </div>

            <div class="lista">
                <ul class="articulos">

                    <?php

                    //Traigo las 5 mochilas mas baratas
                    $resultado = traerTodo('mochila', $conexion, 'ORDER BY precio_mochila ASC LIMIT 4');

                    //Las muestro en pantalla
                    foreach ($resultado as $dato) { ?>

                        <li class="articulo">
                            <p class="articulo-nombre"><?php echo $dato['nombre_mochila'] ?></p>
                            <p class="articulo-precio">$<?php echo $dato['precio_mochila'] ?></p>
                        </li>

                    <?php } ?>

                    <li class="articulo">

                        <!-- muestro una item que envia a la pagina de contacto para un asunto personalizado -->
                        <p class="articulo-nombre">Mochila estampado a pedido</p>
                        <p class="articulo-precio"><a href="contacto.php">CONSULTAR</a></p>
                    </li>

                </ul>
            </div>
        </div>

    </section>

    <?php

    include 'templates/footer.php';

    mysqli_close($conexion);


    ?>

</body>

</html>