<!-- header de admin -->

<header class="header">
    <div class="contenedor contenido-header">
        <div class="barra">
            <a href="dashboard-admin.php" class="marca">TodoMochilasADM</a>

            <?php session_start(); ?>
            <P class="usuario">Bienvenido: <span class="span-usuario"><?php echo $_SESSION['nombre']; ?></span></P>
            <P class="usuario">Nivel: <span class="span-usuario"><?php echo $_SESSION['nivel']; ?></span></P>


        </div>
    </div>
</header>