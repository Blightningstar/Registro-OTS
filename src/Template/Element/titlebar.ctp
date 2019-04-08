<?php
/**
 * Barra superior con el logo de la OET, el nombre del sistema y la información de sesión del usuario
 */
?>

<nav class="navbar navbar-fixed-top navbar-expand-xl justify-content-between" style="background-color:#659F31">
    <div class="col-2">
        <a class="navbar-brand">
	
            <?= $this->Html->image('logo.png', ['style' => ''])?>
        </a>
    </div>
</nav>