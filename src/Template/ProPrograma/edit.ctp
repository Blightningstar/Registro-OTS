<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProPrograma $proPrograma
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $proPrograma->PRO_PROGRAMA],
                ['confirm' => __('Are you sure you want to delete # {0}?', $proPrograma->PRO_PROGRAMA)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Pro Programa'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="proPrograma form large-9 medium-8 columns content">
    <?= $this->Form->create($proPrograma) ?>
    <fieldset>
        <legend><?= __('Edit Pro Programa') ?></legend>
        <?php
            echo $this->Form->control('NOMBRE');
            echo $this->Form->control('IDIOMA');
            echo $this->Form->control('CREDITAJE');
            echo $this->Form->control('PAIS');
            echo $this->Form->control('ACTIVO');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
