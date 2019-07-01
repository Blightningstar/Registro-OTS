<?php
/**
 * @author Joel Chaves
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SolPreguntum $solPreguntum
 */
?>

<div class="solPregunta view large-9 medium-8 columns content">
   
<fieldset>
        <legend class = "titulo"><?= __('View Question') ?>
        <br></br>
        <p class = "subtitulo"> <?= __('Info about this question') ?></p>
    </legend>
    <br>

<br>
        <div>
            <p class= "field"> <?= __('ID:') ?></p>
            <p class= "value"> <?= $solPreguntum["SOL_PREGUNTA"] ?></p>
            <hr class= "separator">
        </div>

        <div>
            <p class= "field"> <?= __('Description in english:') ?></p>
            <p class= "value"> <?= $solPreguntum["DESCRIPCION_ING"] ?></p>
            <hr class= "separator">
        </div>

       <div>
            <p class= "field"> <?= __('Type:') ?></p>
            <?php if($solPreguntum->TIPO ==0):?>
                <p class= "value"> <?= __('Short Text')  ?></p>
            <?php elseif($solPreguntum->TIPO ==1):?>
               <p class= "value"> <?= __('Medium Text') ?></p>
            <?php elseif($solPreguntum->TIPO ==2):?>
               <p class= "value"> <?= __('Large Text') ?></p>
            <?php elseif($solPreguntum->TIPO ==3):?>
               <p class= "value"> <?= __('Number') ?></p>
             <?php elseif($solPreguntum->TIPO ==4):?>
               <p class= "value"> <?= __('Date') ?></p>
               <?php elseif($solPreguntum->TIPO ==5):?>
              
              <!-- If is select, show it´s options -->
               <p class= "value"> <?= __('Select');
                    foreach($options as $option): ?>
                      <p class= "value"> Option: <?= __($option['DESCRIPCION_ING']) ?>
                    <?php endforeach;
               ?>
               </p>

               <?php elseif($solPreguntum->TIPO ==6):?>
               <p class= "value"> <?= __('Upload Document') ?></p>
               <?php elseif($solPreguntum->TIPO ==7):?>
               <p class= "value"> <?= __('Email') ?></p>
               <?php elseif($solPreguntum->TIPO ==8):?>
               <p class= "value"> <?= __('Phone Number') ?></p>
             <?php elseif($solPreguntum->TIPO ==9):?>
               <p class= "value"> <?= __('URL') ?></p>
            <?php endif ?>
            <hr class= "separator">
        </div>

        <div>
            <p class= "field"> <?= __('Required:') ?></p>
            <?php if($solPreguntum->REQUERIDO ==0):?>
                <p class= "value"> <?= __('Not required')  ?></p>
               
            <?php else: ?>
               <p class= "value"> <?= __('Required') ?></p>
            <?php endif ?>
            <hr class= "separator">
        </div>

        <div>
            <p class= "field"> <?= __('State:') ?></p>
            <?php if($solPreguntum->REQUERIDO ==0):?>
                <p class= "value"> <?= __('Inactive')  ?></p>
              
            <?php else: ?>
               <p class= "value"> <?= __('Active') ?></p>
            <?php endif ?>
           <hr class= "separator">
        </div>

</fieldset>

<a href=".."> <button type="button" class="botonCancelar"><?= __('Return') ?></button> </a>
</div>