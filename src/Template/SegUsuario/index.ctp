<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SegUsuario[]|\Cake\Collection\CollectionInterface $segUsuario
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Seg Usuario'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="segUsuario index large-9 medium-8 columns content">
    <h3><?= __('Seg Usuario') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('SEG_USUARIO') ?></th>
                <th scope="col"><?= $this->Paginator->sort('NOMBRE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('APELLIDO_1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('APELLIDO_2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('NOMBRE_USUARIO') ?></th>
                <th scope="col"><?= $this->Paginator->sort('CONTRASEÑA') ?></th>
                <th scope="col"><?= $this->Paginator->sort('CORREO') ?></th>
                <th scope="col"><?= $this->Paginator->sort('NUMERO_TELEFONO') ?></th>
                <th scope="col"><?= $this->Paginator->sort('NACIONALIDAD') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ACTIVO') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ESTUDIANTE') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($segUsuario as $segUsuario): ?>
            <tr>
                <td><?= h($segUsuario->SEG_USUARIO) ?></td>
                <td><?= h($segUsuario->NOMBRE) ?></td>
                <td><?= h($segUsuario->APELLIDO_1) ?></td>
                <td><?= h($segUsuario->APELLIDO_2) ?></td>
                <td><?= h($segUsuario->NOMBRE_USUARIO) ?></td>
                <td><?= h($segUsuario->CONTRASEÑA) ?></td>
                <td><?= h($segUsuario->CORREO) ?></td>
                <td><?= h($segUsuario->NUMERO_TELEFONO) ?></td>
                <td><?= h($segUsuario->NACIONALIDAD) ?></td>
                <td><?= h($segUsuario->ACTIVO) ?></td>
                <td><?= h($segUsuario->ESTUDIANTE) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $segUsuario->SEG_USUARIO]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $segUsuario->SEG_USUARIO]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $segUsuario->SEG_USUARIO], ['confirm' => __('Are you sure you want to delete # {0}?', $segUsuario->SEG_USUARIO)]) ?>
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
