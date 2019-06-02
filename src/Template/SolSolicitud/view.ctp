<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SolSolicitud $solSolicitud
 */
?>

<div class="solSolicitud view large-9 medium-8 columns content">
    <fieldset>
    <legend class = "titulo"><?= __('View Application') ?>
        <br></br>
        <p class = "subtitulo"><?=__('View the status of a application')?></p>
    </legend>
    <br>
	
	<div>
		<p class= "field"> <?= __('User:') ?></p>
		<p class= "value"> <?= h($solSolicitud->NOMBRE_USUARIO) ?></p>
		<hr class= "separator">
	</div>
	
	<div>
		<p class= "field"> <?= __('Course:') ?></p>
		<p class= "value"> <?= h($solSolicitud->NOMBRE) ?></p>
		<hr class= "separator">
	</div>
	
	<div>
		<p class= "field"> <?= __('Status:') ?></p>
		<p class= "value"> <?= h($solSolicitud->RESULTADO) ?></p>
		<hr class= "separator">
	</div>
	
</div>
