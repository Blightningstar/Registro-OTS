<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SolFormulario[]|\Cake\Collection\CollectionInterface $solFormulario
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Sol Formulario'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="solFormulario index large-9 medium-8 columns content">
    <h3><?= __('Sol Formulario') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('SOL_FORMULARIO') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ACTIVO') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($solFormulario as $solFormulario): ?>
            <tr>
                <td><?= $this->Number->format($solFormulario->SOL_FORMULARIO) ?></td>
                <td><?= h($solFormulario->ACTIVO) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $solFormulario->SOL_FORMULARIO]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $solFormulario->SOL_FORMULARIO]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $solFormulario->SOL_FORMULARIO], ['confirm' => __('Are you sure you want to delete # {0}?', $solFormulario->SOL_FORMULARIO)]) ?>
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
