<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SolPreguntum $solPreguntum
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Sol Pregunta'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="solPregunta form large-9 medium-8 columns content">
    <?= $this->Form->create($solPreguntum) ?>
    <fieldset>
        <legend><?= __('Add Sol Preguntum') ?></legend>
        <?php
            echo $this->Form->control('DESCRIPCION_ESP');
            echo $this->Form->control('DESCRIPCION_ING');
            echo $this->Form->control('TIPO');
            echo $this->Form->control('REQUERIDO');
            echo $this->Form->control('ACTIVO');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
