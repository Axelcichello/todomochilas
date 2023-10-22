<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos-admin.css">
    <link rel="stylesheet" href="css/normalizer.css">
    <title>Nuevo Producto | Dashboard</title>
</head>

<body>

    <?php
    
    include_once 'templates/header-admin.php';
    ?>

    <main class="contenedor">
        <h2 class="subtitulo">REGISTRAR PRODUCTO</h2>

        <form method="POST" action="notificacion-admin.php" class="formulario" enctype="multipart/form-data">

            <fieldset>
                <legend>Informacion General del Producto</legend>

                <label for="nombre">Nombre del producto</label>
                <input type="text" id="nombre" placeholder="Ingrese nombre del producto">

                <label for="proveedor">Proveedor</label>
                <input type="text" id="proveedor" placeholder="Ingrese nombre del proveedor">

                <label for="telefono">Telefono del proveedor</label>
                <input type="number" id="telefono" placeholder="Ingrese numero del proveedor">

                <label for="email">Email del proveedor</label>
                <input type="email" id="email" placeholder="Ingrese email del proveedor">

                <label for="nota">Notas sobre producto</label>
                <textarea id="nota"></textarea>
            </fieldset>

            <fieldset class="especifico">
                <legend>Datos Especificos del Producto</legend>

                <label for="entrega">Tiempo estimado de entrega</label>
                <select name="entrega" id="entrega">
                    <option value="menos 30">Menos de 30 dias</option>
                    <option value="mas 30">Mas de 30 dias</option>
                    <option value="mas 60">Mas de 60 dias</option>
                    <option value="Importacion">Importacion</option>
                </select>

                <label for="foto">Foto del Producto</label>
                <p>Foto a mostrar en la web principal</p>
                <input type="file" name="foto" id="foto">

                <label for="litros">litros del producto</label>
                <input type="number" id="litros" placeholder="Ingrese litros del producto">

                <label for="colores">Colores del producto</label>
                <input type="text" id="colores" placeholder="Ingrese colores del producto, separados por ','">

            </fieldset>

            <input type="submit" class="boton boton-verde" value="REGISTRAR PRODUCTO">

        </form>
    </main>

</body>

</html>