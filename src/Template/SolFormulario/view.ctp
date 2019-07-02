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

		             <?php if($pregunta['TIPO'] =='0'):?>
                <p class= "value"> <?= __('Type: Short Text')  ?></p>
            <?php elseif($pregunta['TIPO'] =='1'):?>
               <p class= "value"> <?= __('Type: Medium Text') ?></p>
            <?php elseif($pregunta['TIPO'] =='2'):?>
               <p class= "value"> <?= __('Type: Large Text') ?></p>
            <?php elseif($pregunta['TIPO'] =='3'):?>
               <p class= "value"> <?= __('Type: Number') ?></p>
             <?php elseif($pregunta['TIPO'] =='4'):?>
               <p class= "value"> <?= __('Type: Date') ?></p>
               <?php elseif($pregunta['TIPO'] =='5'):?>
               <p class= "value"> <?= __('Type: Select') ?></p>
               <?php elseif($pregunta['TIPO'] =='6'):?>
               <p class= "value"> <?= __('Type: Upload Document') ?></p>
               <?php elseif($pregunta['TIPO'] =='7'):?>
               <p class= "value"> <?= __('Type: Email') ?></p>
               <?php elseif($pregunta['TIPO'] =='8'):?>
               <p class= "value"> <?= __('Type: Phone Number') ?></p>
             <?php elseif($pregunta['TIPO'] =='9'):?>
               <p class= "value"> <?= __('Type: URL') ?></p>
            <?php endif ?>

            <?php if($pregunta['REQUERIDO'] =='0'):?>
                <p class= "value"> <?= __('Required: Not required')  ?></p>
               
            <?php else: ?>
               <p class= "value"> <?= __('Required: Required') ?></p>
            <?php endif ?>
		            
		            <hr class= "separator">
        		</div>       
                
 		    <?php endforeach; ?>
		</fieldset>
    
<a href=".."> <button type="button" class="botonCancelar"><?= __('Return') ?></button> </a>

	</div>
