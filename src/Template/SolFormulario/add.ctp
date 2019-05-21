<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SolFormulario $solFormulario
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Sol Formulario'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="solFormulario form large-9 medium-8 columns content">
    <?= $this->Form->create($solFormulario) ?>
    <fieldset>
        <legend><?= __('Add Sol Formulario') ?></legend>
        <?php
            echo $this->Form->control('ACTIVO');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
