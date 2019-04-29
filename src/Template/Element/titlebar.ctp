<?php
/**
 * Barra superior con el logo de la OET, el nombre del sistema y la información de sesión del usuario
 */
if($actualUser)
    $username = $actualUser['NOMBRE_USUARIO'];
    $rol = $actualUser['SEG_ROL']
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
    <?= $this->Html->image('Logos/eng/s/3.png', ['style' => 'height:50px'])?>
    <div>
        <ul class = "navbar-nav mr-auto">
            <?php if($actualUser):?>
                <?php if(!$rol || $rol != "1" || $rol != "2" || $rol != "3"):?>
                    <li id = 'TitlebarUser' class="nav-item menuItem">
                        <?= $this->Html->link( $username,[
                            'controller' => 'usuario',
                            'action' => 'profileView'
                        ],[
                            'class' => 'nav-link menuLink'
                        ]);?>
                    </li>
                <?php endif;?>
                <?php if(!$rol || $rol != "1" || $rol != "2" || $rol != "3"):?>
                    <li class="nav-item menuItem">
                        <?= $this->Html->link( "Sign out",[
                            'controller' => 'seguridad',
                            'action' => 'logout'
                        ],[
                            'class' => 'nav-link menuLink'
                        ]);?>
                    </li>
                <?php endif;?>
                <?php if($country == 'CR'):?>
                    <?php if(!$rol || $rol != "1" || $rol != "2" || $rol != "3"):?>
                        <li id="Language" class="nav-item menuItem">
                            <?= $this->Html->link( '',[
                                'controller' => 'idioma',
                                'action' => 'change'
                            ],[
                               'class' => 'fa fa-globe-americas menuLink icon'
                            ]);?>
                        </li>
                    <?php endif;?>
                <?php else:?>
                    <?php if(!$rol || $rol != "1" || $rol != "2" || $rol != "3"):?>
                        <li  class="nav-item menuItem">
                            <?= $this->Html->link( '',[
                                'controller' => 'idioma',
                                'action' => 'change'
                            ],[
                                'class' => 'fa fa-globe-africa menuLink icon'
                            ]);?>
                        </li>
                    <?php endif;?>
                <?php endif;?>
            <?php else:?>
                <?php if(!$rol || $rol != "1" || $rol != "2" || $rol != "3"):?>
                    <li id = 'TitlebarSignIn' class="nav-item menuItem">
                        <?= $this->Html->link( "Sign in",[
                            'controller' => 'seguridad',
                            'action' => 'login'
                        ],[
                            'class' => 'nav-link menuLink underlined'
                        ]);?>
                    </li>
                <?php endif;?>
                <?php if(!$rol || $rol != "1" || $rol != "2" || $rol != "3"):?>
                    <li id = 'TitlebarSignUp' class="nav-item menuItem">
                        <?= $this->Html->link( "Sign up",[
                            'controller' => 'usuario',
                            'action' => 'register'
                        ],[
                            'id'=>'TitlebarSignUp',
                            'class' => 'nav-link menuLink boxed'
                        ]);?>
                    </li>
                <?php endif;?>
            <?php endif;?>
        </ul>
    <div>
</nav>