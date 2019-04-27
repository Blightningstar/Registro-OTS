<?php
/**
 * Barra superior con el logo de la OET, el nombre del sistema y la información de sesión del usuario
 */
?>

<?php 
/**
 * La variable $active_title se usa para indicar cuál sección está activo. Los posibles valores son:
 * - LogIn
 * - User
 */
if(isset($active_title)):?>
    <script type="text/javascript">
        $(document).ready(function() {
            var obj_id = '#<?php echo $active_title; ?>';
            var clase = $(obj_id).attr('class');
            $(obj_id).attr('class', clase + ' active' );
        });
    </script>
<?php endif; ?>

<nav class="navbar navbar-fixed-top navbar-expand-xl justify-content-between" style="background-color:#659F31">
        <div class="navbar-nav">
	
            <?= $this->Html->image('Logos/eng/s/3.png', ['style' => 'height:50px'])?>
        
        </div>

  
        <div class="navbar-bar">
            <?php echo $this->Html->link( $actualUser['NOMBRE_USUARIO'],   array('controller' => 'usuario', 'action' => 'profileView'), [ 'id'=>'User', 'class' => 'menuItem'] ); ?>

            
            <?php 
  
                if($actualUser){
                    echo $this->Html->link( "Sign out",   array('controller' => 'seguridad', 'action' => 'logout'), ['class' => 'menuItem'] );
                }else{
                    echo $this->Html->link( "Sign in",   array('controller' => 'seguridad', 'action' => 'login'), [ 'id'=>'LogIn','class' => 'menuItem', 'style' => 'text-decoration: underline;font-weight:normal;'] ); 
                    echo $this->Html->link( "Sign up",   array('controller' => 'usuario', 'action' => 'register'), [ 'class' => 'menuItem', 'style' => 'border-style: solid;font-weight:normal;border-width: 2px;'] ); 
                }
            ?>
            <?php //echo $this->Html->link( "Cambiar a inglés",   array('controller' => 'idioma'), [ 'class' => 'menuItem'] ); ?>




    
            
        </div>

</nav>