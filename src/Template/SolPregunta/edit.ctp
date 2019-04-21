<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SolPreguntum $solPreguntum
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete this question'),
                ['action' => 'delete', $solPreguntum->SOL_PREGUNTA],
                ['confirm' => __('Are you sure you want to delete # {0}?', $solPreguntum->SOL_PREGUNTA)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Question bank'), ['action' => 'index']) ?></li>
    </ul>
</nav>
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
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
