<?php
/**
 * Barra del menú de navegación para el registro de estudiantes de la OET
 */
?>


<nav class="navbar navbar-fixed-top navbar-expand-xl justify-content-center sticky" style="background-color:#7BC143">



<div class="navbar-bar flex flex-horizontal justify-content-center">
    
<?php if($actualUser["SEG_ROL"] != "1"):?>
            <?php echo $this->Html->link( "Preguntas",   array('controller' => 'pregunta'), [ 'class' => 'menuItem'] ); ?>

            <?php echo $this->Html->link( "Cursos",   array('controller' => 'curso'), [ 'class' => 'menuItem'] ); ?>

            <?php echo $this->Html->link( "Programas",   array('controller' => 'programa'), [ 'class' => 'menuItem'] ); ?>

            <?php echo $this->Html->link( "Dashboard",   array('controller' => 'dashboard'), [ 'class' => 'menuItem'] ); ?>

            <?php echo $this->Html->link( "Usuarios",   array('controller' => 'usuario'), [ 'class' => 'menuItem'] ); ?>

            <?php echo $this->Html->link( "Solicitudes",   array('controller' => 'solicitudes'), [ 'class' => 'menuItem'] ); ?>

            <?php echo $this->Html->link( "Acerca de OTS",   array('controller' => '', 'action' => ''), [ 'class' => 'menuItem'] ); ?>
        </div>


<?php else:?>

<?php echo $this->Html->link( "Cursos",   array('controller' => 'curso'), [ 'class' => 'menuItem'] ); ?>

<?php echo $this->Html->link( "Programas",   array('controller' => 'programa'), [ 'class' => 'menuItem'] ); ?>

<?php echo $this->Html->link( "Solicitudes",   array('controller' => 'solicitudes'), [ 'class' => 'menuItem'] ); ?>

<?php echo $this->Html->link( "Acerca de OTS",   array('controller' => '', 'action' => ''), [ 'class' => 'menuItem'] ); ?>


<?php endif;?>


</nav>