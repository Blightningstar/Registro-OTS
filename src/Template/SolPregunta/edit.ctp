<?php
/**
 * @author Joel Chaves
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SolPreguntum $solPreguntum
 */
?>

<div class="solPregunta form large-9 medium-8 columns content">
    <?= $this->Form->create($solPreguntum) ?>
    <fieldset>
        <legend class = "titulo"><?= __('Edit Question') ?>
        <br></br>
        <p class = "subtitulo">Edit this question to the question bank.</p>
    </legend>
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
    </fieldset>
    <br>
    <a href=".."> <button type="button" class="botonCancelar"><?= __('CANCEL') ?></button> </a>
    <?= $this->Form->button(__('ACCEPT'), ['class' => 'botonAceptar'], ['label' => 'ACCEPT']) ?>
    <?= $this->Form->end() ?>
