<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SolPreguntum $solPreguntum
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Sol Preguntum'), ['action' => 'edit', $solPreguntum->SOL_PREGUNTA]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Sol Preguntum'), ['action' => 'delete', $solPreguntum->SOL_PREGUNTA], ['confirm' => __('Are you sure you want to delete # {0}?', $solPreguntum->SOL_PREGUNTA)]) ?> </li>
        <li><?= $this->Html->link(__('List Sol Pregunta'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sol Preguntum'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="solPregunta view large-9 medium-8 columns content">
    <h3><?= h($solPreguntum->SOL_PREGUNTA) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('DESCRIPCION ESP') ?></th>
            <td><?= h($solPreguntum->DESCRIPCION_ESP) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('DESCRIPCION ING') ?></th>
            <td><?= h($solPreguntum->DESCRIPCION_ING) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('REQUERIDO') ?></th>
            <td><?= h($solPreguntum->REQUERIDO) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ACTIVO') ?></th>
            <td><?= h($solPreguntum->ACTIVO) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('SOL PREGUNTA') ?></th>
            <td><?= $this->Number->format($solPreguntum->SOL_PREGUNTA) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('TIPO') ?></th>
            <td><?= $this->Number->format($solPreguntum->TIPO) ?></td>
        </tr>
    </table>
</div>
