<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SolSolicitud[]|\Cake\Collection\CollectionInterface $solSolicitud
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Sol Solicitud'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="solSolicitud index large-9 medium-8 columns content">
    <h3><?= __('Sol Solicitud') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('SEG_USUARIO') ?></th>
                <th scope="col"><?= $this->Paginator->sort('PRO_CURSO') ?></th>
                <th scope="col"><?= $this->Paginator->sort('RESULTADO') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ACTIVO') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($solSolicitud as $solSolicitud): ?>
            <tr>
                <td><?= $this->Number->format($solSolicitud->SEG_USUARIO) ?></td>
                <td><?= $this->Number->format($solSolicitud->PRO_CURSO) ?></td>
                <td><?= h($solSolicitud->RESULTADO) ?></td>
                <td><?= h($solSolicitud->ACTIVO) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $solSolicitud->SEG_USUARIO]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $solSolicitud->SEG_USUARIO]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $solSolicitud->SEG_USUARIO], ['confirm' => __('Are you sure you want to delete # {0}?', $solSolicitud->SEG_USUARIO)]) ?>
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
