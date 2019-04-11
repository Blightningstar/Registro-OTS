<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProPrograma $proPrograma
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Pro Programa'), ['action' => 'edit', $proPrograma->PRO_PROGRAMA]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Pro Programa'), ['action' => 'delete', $proPrograma->PRO_PROGRAMA], ['confirm' => __('Are you sure you want to delete # {0}?', $proPrograma->PRO_PROGRAMA)]) ?> </li>
        <li><?= $this->Html->link(__('List Pro Programa'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Pro Programa'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="proPrograma view large-9 medium-8 columns content">
    <h3><?= h($proPrograma->PRO_PROGRAMA) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('PRO PROGRAMA') ?></th>
            <td><?= h($proPrograma->PRO_PROGRAMA) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('NOMBRE') ?></th>
            <td><?= h($proPrograma->NOMBRE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IDIOMA') ?></th>
            <td><?= h($proPrograma->IDIOMA) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('PAIS') ?></th>
            <td><?= h($proPrograma->PAIS) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ACTIVO') ?></th>
            <td><?= h($proPrograma->ACTIVO) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CREDITAJE') ?></th>
            <td><?= $this->Number->format($proPrograma->CREDITAJE) ?></td>
        </tr>
    </table>
</div>
