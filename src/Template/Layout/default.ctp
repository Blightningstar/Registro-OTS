<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __('Organization for Tropical Studies');
?>
<!DOCTYPE html>
<html>
<head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>
        <?= $this->fetch('title')?>
    </title>
    <!-- 
        Colocar dentro del title para mostrar el nombre del módulo actual
        : <?php /*echo $this->fetch('title')*/ ?> 
    -->
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->css('Estandar OTS.css')?>
	
	<!-- Archivos requeridos para el funcionamiento de bootstrap -->
	<?= $this->Html->css([
            'bootstrap.min',
            'bootstrap',
     ]);

	$this->Html->script([
            'jquery.min',
            'bootstrap.min',
    ]);

    $this->Html->script(['bootstrap.min']);
    $this->Html->script(['bootstrap.js']);

    ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

</head>
<body>

    <?= $this->Flash->render() ?>
    <?=$this->element('titlebar')?>
    <?=$this->element('menubar')?>
    
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>

</body>
</html>
