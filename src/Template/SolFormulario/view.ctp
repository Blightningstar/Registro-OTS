<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SolFormulario $solFormulario
 */
?>
	<div class="solFormulario view large-9 medium-8 columns content">

		<fieldset>
			<legend class = "titulo"><?= __('Info about this form') ?>
    		</legend>

    		<div>
            	<p class= "field"> <?= __('Form Name:') ?></p>
            	<p class= "value"> <?= $solFormulario["NOMBRE"] ?></p>
           		<hr class= "separator">
            </div>
			<?php foreach ($preguntas as $pregunta): ?>
				<div>
		            <p class= "field"> <?= __('Question '.$pregunta['NUMERO_PREGUNTA'].':') ?></p>
		            <p class= "value"> <?= $pregunta['DESCRIPCION_ING'] ?></p>
		            <hr class= "separator">
        		</div>       
                
 		    <?php endforeach; ?>
		</fieldset>


	</div>
