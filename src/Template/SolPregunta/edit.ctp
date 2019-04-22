<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SolPreguntum $solPreguntum
 */
?>

<div class="solPregunta form large-9 medium-8 columns content">
    <?= $this->Form->create($solPreguntum) ?>
    <fieldset>
        <legend><?= __('Edit Question') ?></legend>
        <?php
            echo $this->Form->control('DESCRIPCION_ESP', ['label' => 'Description in spanish']);
            echo $this->Form->control('DESCRIPCION_ING', ['label' => 'Description in english']);
            //echo $this->Form->control('TIPO');
            //echo $this->Form->control('REQUERIDO');
            //echo $this->Form->control('ACTIVO');
            echo '<label for="TIPO">Type</label>';
            echo $this->Form->select('TIPO',$TIPO);
            echo '<label for="ACTIVO">State</label>';
            echo $this->Form->select('ACTIVO',$ACTIVO);
            echo '<label for="REQUERIDO">Required</label>';
            echo $this->Form->select('REQUERIDO',$REQUERIDO);
        ?>
    </fieldset>
    </fieldset>
    <br>
    <a href="."> <button type="button" class="botonCancelar">Go back</button> </a>
    <?= $this->Form->button(__('Save'), ['class' => 'botonAceptar'], ['label' => 'Save']) ?>
    <?= $this->Form->end() ?>
