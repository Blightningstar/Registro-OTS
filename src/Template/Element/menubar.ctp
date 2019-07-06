<?php
    /**
     * Barra del menú de navegación para el registro de estudiantes de la OET
     */
    $rol = $actualUser["SEG_ROL"];

    $superuser = "1";
    $administrator = "2";
    $student = "3";
?>

<?php 
    /**
     * La variable $active_menu se usa para indicar cuál es el menú activo. Los posibles valores son:
     * - MenubarQuestions
     * - MenubarCourses
     * - MenubarPrograms
     * - MenubarUsers
     * - MenubarDashboardAdministrator
     * - LogIn
     */
    if(isset($active_menu)):?>
        <script type="text/javascript">
            $(document).ready(function() {
                var obj_id = '#<?php echo $active_menu; ?>';
                var clase = $(obj_id).attr('class');
                $(obj_id).attr('class', clase + ' active' );
            });
        </script>
<?php endif; ?>


<nav class="navbar menubar navbar-fixed-top navbar-expand-xl collapse navbar-collapse sticky " style="background-color:#7BC143">
    <ul class = "navbar-nav mr-auto">
        <li id = 'MenubarMain' class="nav-item menuItem">
            <?= $this->Html->link( "Main",[
                'controller' => 'main'
            ],[
                'class' => 'nav-link menuLink'
            ]);?>
        </li>
         
        <!-- The user got the right permission for the action? -->
        <?php if(array_key_exists(30, $roles)):?>
            <li id = 'MenubarUsers' class="nav-item menuItem">
                <?= $this->Html->link( "Users",[
                    'controller' => 'usuario'
                ],[
                    'class' => 'nav-link menuLink'
                ]);?>
            </li>
        <?php endif;?>

        <li id = 'MenubarPrograms' class="nav-item menuItem">
            <?= $this->Html->link( "Programs",[
                'controller' => 'programa'
            ],[
                'class' => 'nav-link menuLink'
            ]);?>
        </li>  

        <!-- The user got the right permission for the action? -->
        <?php if(array_key_exists(30, $roles)):?>
            <li id = 'MenubarQuestions' class="nav-item menuItem">
                <?= $this->Html->link( "Questions",[
                    'controller' => 'pregunta'
                ],[
                    'class' => 'nav-link menuLink'
                ]);?>
            </li>
        <?php endif;?>

        <!-- The user got the right permission for the action? -->
        <?php if(array_key_exists(9, $roles)):?>
            <li id = 'MenubarPermissions' class="nav-item menuItem">
                <?= $this->Html->link( "Permissions",[
                    'controller' => 'permiso'
                ],[
                    'class' => 'nav-link menuLink'
                ]);?>
            </li>
        <?php endif;?>

        <!-- The user got the right permission for the action? -->
        <?php if(array_key_exists(30, $roles)):?>
            <li id = 'MenubarForm' class="nav-item menuItem">
                <?= $this->Html->link( "Form",[
                    'controller' => 'solFormulario'
                ],[
                    'class' => 'nav-link menuLink'
                ]);?>
            </li>
        <?php endif;?>
        
        <!-- The user got the right permission for the action? -->
        <?php if(array_key_exists(14, $roles)):?>
            <li id = 'MenubarDashboard' class="nav-item menuItem">
                <?= $this->Html->link( "Dashboard",[
                    'controller' => 'Dashboard'
                ],[
                    'class' => 'nav-link menuLink'
                ]);?>
            </li>
        <?php endif;?>

        <!-- The user got the right permission for the action? -->
        <?php if(array_key_exists(13, $roles)):?>
            <li id = 'MenubarDashboard' class="nav-item menuItem">
                <?= $this->Html->link( "Dashboard",[
                    'controller' => 'Dashboard',
                    'action' => 'studentDashboard'
                ],[
                    'class' => 'nav-link menuLink'
                ]);?>
            </li>
        <?php endif;?>
    <ul>    
</nav>