<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProPrograma $proPrograma
 */
?>

<div class="proPrograma form large-9 medium-8 columns content">
    <?= $this->Form->create($proPrograma) ?>
    <fieldset>
        <legend><?= __('Añadir Programa') ?></legend>
        <br>
        <?php
            echo $this->Form->control('ProPrograma', ['label' => __('ID')]);
            echo $this->Form->control('NOMBRE', ['label' => __('Nombre')]);
            echo $this->Form->control('ACTIVO', ['label' => __('Activo')]);
        ?>
    </fieldset>
    <button class="botonCancelar">
        <?= $this->Html->link(__('Cancelar'), ['action' => 'index']) ?>
    </button>
    
    <?= $this->Form->button(__('Añadir')) ?>

    <?= $this->Form->end() ?>
</div>