<?php

include_once './config.php';



//traerTodo permite traer todo el contenido de una tabla de mysql sin tener que repetir el 
//query en el view. Se le pasa la tabla a buscar y la conexion
function traerTodo($tabla, $conn)
{
    $query = "SELECT * FROM $tabla";
    $query = mysqli_query($conn, $query);

    if (mysqli_num_rows($query) > 0) {

        while ($row = mysqli_fetch_assoc($query)) {
            $array[] = $row;
        }
        return $array;
    } else {
        return "error";
    }
}


//conectarDDBB conecta a la base de datos. Los datos los toma del view.
function conectarDDBB($host, $user, $password, $db)
{
    $conexion = mysqli_connect($host, $user, $password, $db);

    if (!$conexion) {
        die("Error al conectar con la base de datos: " . mysqli_connect_error());
    }

    return $conexion;
}

//Cierra la base de datos
function cerrarDDBB($conexion)
{
    mysqli_close($conexion);
}

//muestra datos completo de la variable o array
function debuguear($dato)
{
    echo "<pre>";
    echo var_dump($dato);
    echo "</pre>";
    exit;
}

//Muestra la info de la variable
function visualizar($dato)
{


    echo "<pre>";
    echo print_r($dato);
    echo "</pre>";
    exit;
}

//recorre un array de errores y los muestra.
function notificarErrores($errores)
{

    foreach ($errores as $error) { ?>

        <div class="notificacion error">
            <p><?php echo $error ?></p>
        </div>

    <?php }
}

//Muestra una serie de productos 
function mostrarProducto($productos)
{

    for ($i = 0; $i < count($productos); $i++) { ?>

        <form class="producto" method="POST" action="producto.php">
            <img src="img/<?php echo $productos[$i][1]; ?>.jpg" alt="Mochila">

            <div class="info-producto">
                <p class="producto-nombre"><?php echo $productos[$i][2]; ?></p>
                <p class="producto-precio">$<?php echo $productos[$i][3]; ?></p>
            </div>

            <input type="hidden" name="id" value="<?php echo $productos[$i][0]; ?>">
            <input type="hidden" name="imagen" value="<?php echo $productos[$i][1]; ?>">
            <input type="hidden" name="nombre" value="<?php echo $productos[$i][2]; ?>">
            <input type="hidden" name="precio" value="<?php echo $productos[$i][3]; ?>">
            <input type="hidden" name="descripcion" value="<?php echo $productos[$i][4]; ?>">


            <input type="submit" value="Ver Producto" class="boton-form">

        </form>

<?php }
}

//Metodo de saneo
function saneoString($dato, $caracteresEspeciales)
{
    $saneado = str_ireplace($caracteresEspeciales, "", strip_tags($dato));

    return $saneado;
}

//esta funcion evalua el tipo de extension del archivo que se subio y lo devuelve para concatenar
function evaluarExtencion($tipoArchivo)
{

    switch ($tipoArchivo) {
        case "image/png":
            return ".png";
            break;

        case "image/jpg":
            return ".jpg";
            break;

        case "image/jpeg":
            return ".jpeg";
            break;
    }
}


//Busco que formulario voy a cargar en mi view
function cargarFormulario($form)
{
    switch ($form) {
        case 'proveedor':
            return 'formulario-proveedor.php';
            break;

        case 'mochila':
            return 'formulario-mochila.php';
            break;

        case 'usuario':
            return 'formulario-usuario.php';
            break;
    }
}


//paginacion para reutilizar en la diferentes paginas con listados
function paginar($registrosPagina, $tabla, $conn, $queryTabla)
{


    //Definir numero de registros

    //Obtener el total de registros
    $query = "SELECT COUNT(*) AS total FROM {$tabla}";
    $resultadoTotal = $conn->query($query);
    $totalRegistros = $resultadoTotal->fetch_assoc()['total'];

    //Calcular los registros por pagina
    $totalPaginas = ceil($totalRegistros / $registrosPagina);

    $paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

    //Calcular el indice
    $indiceInicio = ($paginaActual - 1) * $registrosPagina;

    //Consultar para obtener resultados de pagina actual
    $queryPaginacion = "{$queryTabla} LIMIT $indiceInicio, $registrosPagina";

    $resultadoPaginacion = $conn->query($queryPaginacion);

    return [$totalPaginas, $resultadoPaginacion];
}


//Funcion para terminar la paginacion con los indices
function indices($totalPaginas)
{

    //Mostrar 
    for ($i = 1; $i <= $totalPaginas; $i++) {
        echo "<a href='?pagina=$i'>$i</a>";
    }
}

//Funcion para mandar a logear usuario si no lo esta
function isAuth(){
    if(!isset($_SESSION['sesion'])){
        header('Location: ../login.php');
    }
}

//Funcion para determinar si un usuario es admin y asi mostrar la pestaña de usuarios
function isAdmin(){
    if(!isset($_SESSION['sesion']) || $_SESSION['nivel'] != 3){
        header('Location: dashboard-admin.php');
    }
}


//function para verificar si un dato fue eliminado y mostrar la notificacion correspondiente
function verificarEliminacion($resultado, $conexion, $entidad){

    if (isset($resultado)) {
        $filasAfectadas = mysqli_affected_rows($conexion);

        if ($filasAfectadas > 0) { ?>

            <div class="notificacion exito">
                <p><?php echo $entidad ?> eliminada correctamente</p>
            </div>

        <?php } else { ?>

            <div class="notificacion error">
                <p>Error al eliminar <?php echo $entidad ?></p>
            </div>

    <?php }
    }
}


//Funcion para eliminar los elementos de una base de datos
function eliminarElemento($idEliminar, $getId, $tabla, $idTabla, $conn){
    if (isset($_GET) && isset($getId)) {

        $idEliminar = $getId;

        $sql = "DELETE FROM {$tabla} WHERE {$idTabla} = {$idEliminar}";

        return mysqli_query($conn, $sql);
    }
}