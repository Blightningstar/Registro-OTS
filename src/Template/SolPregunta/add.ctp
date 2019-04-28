<?php
/**
 * @author Joel Chaves
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SegUsuario $solPreguntum
 */
?>

<div class="solPreguntum form large-9 medium-8 columns content">
    <?= $this->Form->create($solPreguntum) ?>
    <fieldset>
        <legend class = "titulo"><?= __('Add Question') ?>
        <br></br>
        <p class = "subtitulo">Adds a new question to the question bank.</p>
    </legend>
        
        <br>
        <?php

            echo $this->Form->control('DESCRIPCION_ESP', [
                'label' => 'Description in spanish',
                'pattern' => '^[A-Za-z0-9 _,.\/ ?¿]*$', 
                'placeholder' => 'Only alphanumeric characters'
            ]);
            echo $this->Form->control('DESCRIPCION_ING', [
                'label' => 'Description in english',
                'pattern' => '^[A-Za-z0-9 _,.\/ ?¿]*$', 
                'placeholder' => 'Only alphanumeric characters'
            ]);

            echo '<label for="TIPO">Type</label>';
            echo $this->Form->select('TIPO',$TIPO);
            echo '<label for="ACTIVO">State</label>';
            echo $this->Form->select('ACTIVO',$ACTIVO);
            echo '<label for="REQUERIDO">Required</label>';
            echo $this->Form->select('REQUERIDO',$REQUERIDO);
        ?>
    </fieldset>
    <br>
    <a href="."> <button type="button" class="botonCancelar">Go back</button> </a>
    <?= $this->Form->button(__('Save'), ['class' => 'botonAceptar'], ['label' => 'Save']) ?>
    <?= $this->Form->end() ?>
</div>