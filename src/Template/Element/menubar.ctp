<?php
/**
 * Barra del menú de navegación para el registro de estudiantes de la OET
 */
?>

<?php 
/**
 * La variable $active_menu se usa para indicar cuál es el menú activo. Los posibles valores son:
 * - MenubarQuestions
 * - MenubarCourses
 * - MenubarPrograms
 * - MenubarUsers
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


<nav class="navbar navbar-fixed-top navbar-expand-xl justify-content-center sticky" style="background-color:#7BC143">



<div class="navbar-bar flex flex-horizontal justify-content-center">    
    <?php if($actualUser["SEG_ROL"] != "1"):?>
                <?php echo $this->Html->link( "Questions",   array('controller' => 'pregunta'), ['id'=>'MenubarQuestions','class' => 'menuItem'] ); ?>

                <?php echo $this->Html->link( "Courses",   array('controller' => 'curso'), ['id'=> 'MenubarCourses', 'class' => 'menuItem'] ); ?>

                <?php echo $this->Html->link( "Programs",   array('controller' => 'programa'), ['id'=> 'MenubarPrograms', 'class' => 'menuItem'] ); ?>
                
                <?php //echo $this->Html->link( "Dashboard",   array('controller' => 'dashboard'), [ 'class' => 'menuItem'] ); ?>

                <?php echo $this->Html->link( "Users",   array('controller' => 'usuario'), ['id'=> 'MenubarUsers', 'class' => 'menuItem'] ); ?>

                <?php //echo $this->Html->link( "Applications",   array('controller' => 'solicitudes'), [ 'class' => 'menuItem'] ); ?>

                <?php //echo $this->Html->link( "About OTS",   array('controller' => '', 'action' => ''), [ 'class' => 'menuItem'] ); ?>
            

            </ul>
        </div>
    <?php else:?>

        <?php echo $this->Html->link( "Courses",   array('controller' => 'curso'), [ 'class' => 'menuItem'] ); ?>

        <?php echo $this->Html->link( "Programs",   array('controller' => 'programa'), [ 'class' => 'menuItem'] ); ?>

        <?php echo $this->Html->link( "Applications",   array('controller' => 'solicitudes'), [ 'class' => 'menuItem'] ); ?>

        <?php echo $this->Html->link( "About OTS",   array('controller' => '', 'action' => ''), [ 'class' => 'menuItem'] ); ?>


    <?php endif;?>


</div>
</nav>