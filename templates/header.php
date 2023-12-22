<!-- header de clientes     -->
    
    <header>
        <div class="contenedor">
            <a href="index.php">
                <p>Todo<span class="span-header">Mochilas</span></p>
            </a>


            <nav class="navegacion">

                <?php foreach ($menu as $pagina) { ?>

                    <a href="<?php echo  $pagina ?>.php"><?php echo $pagina ?></a>

                <?php } ?>



            </nav>
        </div>
    </header>