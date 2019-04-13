<?php
/**
 * Barra superior con el logo de la OET, el nombre del sistema y la información de sesión del usuario
 */
?>

<nav class="navbar navbar-fixed-top navbar-expand-xl justify-content-between" style="background-color:#659F31">
        <a class="navbar-nav">
	
            <?= $this->Html->image('logo.png', ['style' => 'height:50px'])?>
        </a>

        <div class="navbar-bar">
            <?php echo $this->Html->link( "NombreUsuario",   array('controller' => 'usuario', 'action' => 'edit'), [ 'class' => 'menuItem'] ); ?>

            <?php echo $this->Html->link( "Cerrar sesión",   array('controller' => 'security', 'action' => 'logout'), [ 'class' => 'menuItem'] ); ?>

    
            <?php echo $this->Html->link( "Cambiar a inglés",   array('controller' => 'idioma'), [ 'class' => 'menuItem'] ); ?>
        </div>



</nav>