<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProCurso $proCurso
 * @author Nathan González H
 */
?>

<style>
    .MainContainer{
        width: 100%;
        padding-right: 0px;
        padding-left: 0px;
        margin-right: auto;
        margin-left: auto;
    }
    body{
        background-image: url("https://tropicalstudies.org/wp-content/uploads/2018/06/708OTS1124_web.jpg");
        background-repeat: no-repeat;
        width: 100%;
        padding-right: 0px;
        padding-left: 0px;
    }
</style>

<html>
    <div class = 'MainContainer'>
        <body style = 'background-color: #659F31'>
            <?php
                echo $this->Html->image('main_background.jpg', ['alt' => 'CakePHP']);
            ?>            
        </body>
    </div>
</html>