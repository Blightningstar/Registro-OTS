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
        <?php// if(!$rol || $rol != "1" || $rol != "2" || $rol != "3"):?>
            <li id = 'MenubarMain' class="nav-item menuItem">
                <?= $this->Html->link( "Main",[
                    'controller' => 'main'
                ],[
                    'class' => 'nav-link menuLink'
                ]);?>
            </li>
        <?php// endif;?>

        <?php if(!$rol || $rol != "1" || $rol != "2" || $rol != "3"):?>
            <li id = 'MenubarUsers' class="nav-item menuItem">
                <?= $this->Html->link( "Users",[
                    'controller' => 'usuario'
                ],[
                    'class' => 'nav-link menuLink'
                ]);?>
            </li>
        <?php endif;?>

        <?php if(!$rol || $rol != "1" || $rol != "2" || $rol != "3"):?>
            <li id = 'MenubarPrograms' class="nav-item menuItem">
                <?= $this->Html->link( "Programs",[
                    'controller' => 'programa'
                ],[
                    'class' => 'nav-link menuLink'
                ]);?>
            </li>
        <?php endif;?>

        <?php if(!$rol || $rol != "1" || $rol != "2" || $rol != "3"):?>
            <li id = 'MenubarCourses', class="nav-item menuItem">
                <?= $this->Html->link( "Courses",[
                    'controller' => 'curso'
                ],[
                    'class' => 'nav-link menuLink'
                ]);?>
            </li>
        <?php endif;?>        

        <?php if(!$rol || $rol != "1" || $rol != "2" || $rol != "3"):?>
            <li id = 'MenubarQuestions' class="nav-item menuItem">
                <?= $this->Html->link( "Questions",[
                    'controller' => 'pregunta'
                ],[
                    'class' => 'nav-link menuLink'
                ]);?>
            </li>
        <?php endif;?>

        <?php if(!$rol || $rol != "1" || $rol != "2" || $rol != "3"):?>
            <li id = 'MenubarPermissions' class="nav-item menuItem">
                <?= $this->Html->link( "Permissions",[
                    'controller' => 'permiso'
                ],[
                    'class' => 'nav-link menuLink'
                ]);?>
            </li>
        <?php endif;?>
        
        <?php if(!$rol || $rol != "1" || $rol != "2" || $rol != "3"):?>
            <li id = 'MenubarDashboardAdministrator' class="nav-item menuItem">
                <?= $this->Html->link( "Administrator Dashboard",[
                    'controller' => 'DashboardAdministrador'
                ],[
                    'class' => 'nav-link menuLink'
                ]);?>
            </li>
        <?php endif;?>
                    
        <?php if($rol == $student):?>
 
            <li id = 'MenubarDashboardStudent' class="nav-item menuItem">
                <?= $this->Html->link( "Dashboard",[
                    'controller' => 'Dashboard',
                    'action' => 'studentDashboard'
                ],[
                    'class' => 'nav-link menuLink'
                ]);?>
            </li>
        <?php endif;?>

        <!-- 
            <?php if(!$rol || $rol != "1" || $rol != "2" || $rol != "3"):?>
                <li class="nav-item">
                    <?php //echo $this->Html->link( "Dashboard",   array('controller' => 'dashboard'), [ 'class' => 'menuItem'] ); ?>
                </li>
            <?php endif;?>

            <?php if(!$rol || $rol != "1" || $rol != "2" || $rol != "3"):?>
                <li class="nav-item">
                    <?php //echo $this->Html->link( "Applications",   array('controller' => 'solicitudes'), [ 'class' => 'menuItem'] ); ?>
                </li>
            <?php endif;?>

            <?php if(!$rol || $rol != "1" || $rol != "2" || $rol != "3"):?>
                <li class="nav-item">
                    <?php //echo $this->Html->link( "About OTS",   array('controller' => '', 'action' => ''), [ 'class' => 'menuItem'] ); ?>
                </li>
            <?php endif;?>
        -->
    <ul>    
</nav>