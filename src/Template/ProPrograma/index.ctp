<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProPrograma[]|\Cake\Collection\CollectionInterface $proPrograma
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Pro Programa'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="proPrograma index large-9 medium-8 columns content">
    <h3><?= __('Pro Programa') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('PRO_PROGRAMA') ?></th>
                <th scope="col"><?= $this->Paginator->sort('NOMBRE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('IDIOMA') ?></th>
                <th scope="col"><?= $this->Paginator->sort('CREDITAJE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('PAIS') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ACTIVO') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($proPrograma as $proPrograma): ?>
            <tr>
                <td><?= h($proPrograma->PRO_PROGRAMA) ?></td>
                <td><?= h($proPrograma->NOMBRE) ?></td>
                <td><?= h($proPrograma->IDIOMA) ?></td>
                <td><?= $this->Number->format($proPrograma->CREDITAJE) ?></td>
                <td><?= h($proPrograma->PAIS) ?></td>
                <td><?= h($proPrograma->ACTIVO) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $proPrograma->PRO_PROGRAMA]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $proPrograma->PRO_PROGRAMA]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $proPrograma->PRO_PROGRAMA], ['confirm' => __('Are you sure you want to delete # {0}?', $proPrograma->PRO_PROGRAMA)]) ?>
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
