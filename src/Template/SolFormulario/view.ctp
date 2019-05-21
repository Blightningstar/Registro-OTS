<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SolFormulario $solFormulario
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Sol Formulario'), ['action' => 'edit', $solFormulario->SOL_FORMULARIO]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Sol Formulario'), ['action' => 'delete', $solFormulario->SOL_FORMULARIO], ['confirm' => __('Are you sure you want to delete # {0}?', $solFormulario->SOL_FORMULARIO)]) ?> </li>
        <li><?= $this->Html->link(__('List Sol Formulario'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sol Formulario'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="solFormulario view large-9 medium-8 columns content">
    <h3><?= h($solFormulario->SOL_FORMULARIO) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('ACTIVO') ?></th>
            <td><?= h($solFormulario->ACTIVO) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('SOL FORMULARIO') ?></th>
            <td><?= $this->Number->format($solFormulario->SOL_FORMULARIO) ?></td>
        </tr>
    </table>
</div>
