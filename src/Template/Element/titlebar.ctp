<?php
/**
 * Barra superior con el logo de la OET, el nombre del sistema y la información de sesión del usuario
 */
?>

<nav class="navbar navbar-fixed-top navbar-expand-xl justify-content-between" style="background-color:#659F31">
        <div class="navbar-nav">
	
            <?= $this->Html->image('logo.png', ['style' => 'height:50px'])?>
        
        </div>

  


        <div class="nav-item dropdown">
                <a class="menuItem dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                NombreUsuario 
                </a>
                <div class="dropdown-menu" style="background-color:#659F31 " aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">
                    <?php echo $this->Html->link( __("Consultar perfil"),   array('controller' => 'usuario', 'action' => 'profileView'), [ 'class' => 'menuItem'] ); ?>
                    </a>
                    <a class="dropdown-item" href="#">
                    <?php echo $this->Html->link( __("Editar perfil"),   array('controller' => 'usuario', 'action' => 'profileEdit'), [ 'class' => 'menuItem'] ); ?>
                    </a>
                    <a class="dropdown-item" href="#">
                    <?php echo $this->Html->link( __("Cambiar Contraseña"),   array('controller' => 'usuario', 'action' => 'passwordChange'), [ 'class' => 'menuItem'] ); ?>
                    </a>
                    <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"> 
                            <?php echo $this->Html->link( "Cerrar sesión",   array('controller' => 'security', 'action' => 'logout'), [ 'class' => 'menuItem'] ); ?>
                        </a>
                </div>
                <?php echo $this->Html->link( __("Cambiar a inglés"),   array('controller' => 'idioma'), [ 'class' => 'menuItem'] ); ?>
            </div>



    
            
        </div>



</nav>