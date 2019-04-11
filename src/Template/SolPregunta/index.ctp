<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SolPreguntum[]|\Cake\Collection\CollectionInterface $solPregunta
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Sol Preguntum'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="solPregunta index large-9 medium-8 columns content">
    <h3><?= __('Sol Pregunta') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('SOL_PREGUNTA') ?></th>
                <th scope="col"><?= $this->Paginator->sort('DESCRIPCION_ESP') ?></th>
                <th scope="col"><?= $this->Paginator->sort('DESCRIPCION_ING') ?></th>
                <th scope="col"><?= $this->Paginator->sort('TIPO') ?></th>
                <th scope="col"><?= $this->Paginator->sort('REQUERIDO') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ACTIVO') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($solPregunta as $solPreguntum): ?>
            <tr>
                <td><?= $this->Number->format($solPreguntum->SOL_PREGUNTA) ?></td>
                <td><?= h($solPreguntum->DESCRIPCION_ESP) ?></td>
                <td><?= h($solPreguntum->DESCRIPCION_ING) ?></td>
                <td><?= $this->Number->format($solPreguntum->TIPO) ?></td>
                <td><?= h($solPreguntum->REQUERIDO) ?></td>
                <td><?= h($solPreguntum->ACTIVO) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $solPreguntum->SOL_PREGUNTA]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $solPreguntum->SOL_PREGUNTA]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $solPreguntum->SOL_PREGUNTA], ['confirm' => __('Are you sure you want to delete # {0}?', $solPreguntum->SOL_PREGUNTA)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
