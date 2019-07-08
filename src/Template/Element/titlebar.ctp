<?php
/**
 * Barra superior con el logo de la OET, el nombre del sistema y la información de sesión del usuario
 */
if($actualUser)
    $username = $actualUser['NOMBRE_USUARIO'];
    $rol = $actualUser['SEG_ROL'];
?>

<?php if(isset($active_title)):?>
    <script type="text/javascript">
        $(document).ready(function() {
            var obj_id = '#<?php echo $active_title; ?>';
            var clase = $(obj_id).attr('class');
            $(obj_id).attr('class', clase + ' active' );
        });
    </script>
<?php endif; ?>

<nav class="navbar topbar navbar-fixed-top navbar-expand-xl justify-content-between">
    <a class="navbar-brand" href="https://tropicalstudies.org/">
        <?= $this->Html->image('Logos/eng/s/3.png', ['style' => 'height:50px'])?>
    </a>
    <div class="ml-auto">
            
            <?php if($actualUser):?>
                <?= $this->Html->link(__('Profile'), ['controller' => 'usuario', 'action' => 'profileView' ], ['class' => 'navbar-text text-white d-inline-block mr-3']) ?>
                <?= $this->Html->link(__('Log out'), ['controller' => 'seguridad', 'action' => 'logout'], ['class' => 'navbar-text text-white d-inline-block mr-3']) ?>
            <?php else:?>
                <?= $this->Html->link('Log in', ['controller' => 'seguridad', 'action' => 'login'], ['id'=>'TitlebarSignIn','class' => 'navbar-text text-white d-inline-block mr-3']); ?>
                <?= $this->Html->link('Sign up', ['controller' => 'usuario', 'action' => 'register'], ['id'=>'TitlebarSignUp','class' => 'btn btn-success text-white border border-white shadow mr-3']); ?>
            <?php endif;?>

    </div>
</nav>