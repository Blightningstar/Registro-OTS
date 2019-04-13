<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProCurso[]|\Cake\Collection\CollectionInterface $proCurso
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Pro Curso'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="proCurso index large-9 medium-8 columns content-fluid">
    <h3><?= __('Pro Curso') ?></h3>
    <div class="container-fluid table-responsive">
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('PRO_CURSO') ?></th>
                <th scope="col"><?= $this->Paginator->sort('NOMBRE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('FECHA_INICIO') ?></th>
                <th scope="col"><?= $this->Paginator->sort('FECHA_FINALIZACION') ?></th>
                <th scope="col"><?= $this->Paginator->sort('FECHA_LIMITE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('CREDITOS') ?></th>
                <th scope="col"><?= $this->Paginator->sort('IDIOMA') ?></th>
                <th scope="col"><?= $this->Paginator->sort('LOCACION') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ACTIVO') ?></th>
                <th scope="col"><?= $this->Paginator->sort('PRO_PROGRAMA') ?></th>
                <th scope="col"><?= $this->Paginator->sort('SEG_USUARIO') ?></th>
                <th scope="col"><?= $this->Paginator->sort('SOL_FORMULARIO') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($proCurso as $proCurso): ?>
            <tr>
                <td><?= h($proCurso->PRO_CURSO) ?></td>
                <td><?= h($proCurso->NOMBRE) ?></td>
                <td><?= h($proCurso->FECHA_INICIO) ?></td>
                <td><?= h($proCurso->FECHA_FINALIZACION) ?></td>
                <td><?= h($proCurso->FECHA_LIMITE) ?></td>
                <td><?= $this->Number->format($proCurso->CREDITOS) ?></td>
                <td><?= h($proCurso->IDIOMA) ?></td>
                <td><?= h($proCurso->LOCACION) ?></td>
                <td><?= h($proCurso->ACTIVO) ?></td>
                <td><?= h($proCurso->PRO_PROGRAMA) ?></td>
                <td><?= h($proCurso->SEG_USUARIO) ?></td>
                <td><?= h($proCurso->SOL_FORMULARIO) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $proCurso->PRO_CURSO]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $proCurso->PRO_CURSO]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $proCurso->PRO_CURSO], ['confirm' => __('Are you sure you want to delete # {0}?', $proCurso->PRO_CURSO)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
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
