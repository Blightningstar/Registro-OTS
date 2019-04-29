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
            <p class= "field"> <?= __('Description in spanish:') ?></p>
            <p class= "value"> <?= $solPreguntum["DESCRIPCION_ESP"] ?></p>
            <hr class= "separator">
        </div>

        <div>
            <p class= "field"> <?= __('Description in english:') ?></p>
            <p class= "value"> <?= $solPreguntum["DESCRIPCION_ING"] ?></p>
            <hr class= "separator">
        </div>

       <div>
            <p class= "field"> <?= __('Type:') ?></p>
            <?php if($solPreguntum->REQUERIDO ==0):?>
                <p class= "value"> <?= __('Text')  ?></p>
            <?php elseif($solPreguntum->REQUERIDO ==1):?>
               <p class= "value"> <?= __('Number') ?></p>
            <?php elseif($solPreguntum->REQUERIDO ==2):?>
               <p class= "value"> <?= __('Date') ?></p>
            <?php elseif($solPreguntum->REQUERIDO ==3):?>
               <p class= "value"> <?= __('Select') ?></p>
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

<a href=".."> <button type="button" class="botonCancelar"><?= __('GO BACK') ?></button> </a>
</div>