<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SolPreguntum[]|\Cake\Collection\CollectionInterface $solPregunta
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Add a new question'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="solPregunta index large-9 medium-8 columns content">
    <h3><?= __('Questions:') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('QUESTION ID') ?></th>
                <th scope="col"><?= $this->Paginator->sort('DESCRIPTION IN SPANISH') ?></th>
                <th scope="col"><?= $this->Paginator->sort('DESCRIPTION IN ENGLISH') ?></th>
                <th scope="col"><?= $this->Paginator->sort('TYPE') ?></th>
                <th scope="col"><?= $this->Paginator->sort('REQUIRED') ?></th>
                <th scope="col"><?= $this->Paginator->sort('STATE') ?></th>
                <th scope="col" class="actions"><?= __('ACTIONS') ?></th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($solPregunta as $solPreguntum): ?>
           
            <tr>
                 <?php if($solPreguntum->ACTIVO ==0):?>
                    
                <td><?= $this->Number->format($solPreguntum->SOL_PREGUNTA) ?></td>

                <td><?= h($solPreguntum->DESCRIPCION_ESP) ?></td>
                <td><?= h($solPreguntum->DESCRIPCION_ING) ?></td>
                




                <?php if(($this->Number->format($solPreguntum->TIPO)) ==0):?>

                <td><?= h('Text') ?></td>

            <?php elseif(($this->Number->format($solPreguntum->TIPO)) ==1):?>

                <td><?= h('Number') ?></td>

            <?php elseif(($this->Number->format($solPreguntum->TIPO)) ==2):?>

                <td><?= h('Date') ?></td>

            <?php elseif(($this->Number->format($solPreguntum->TIPO)) ==3):?>

                <td><?= h('Select') ?></td>


            <?php endif ?>






                 <?php if($solPreguntum->REQUERIDO ==0):?>

                <td><?= h('Required') ?></td>
            <?php else: ?>
                <td><?= h('Not required') ?></td>

            <?php endif ?>




                <?php if($solPreguntum->ACTIVO ==0):?>

                <td><?= h('Active') ?></td>
            <?php else: ?>
                <td><?= h('Inactive') ?></td>

            <?php endif ?>




                
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $solPreguntum->SOL_PREGUNTA]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $solPreguntum->SOL_PREGUNTA]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $solPreguntum->SOL_PREGUNTA], ['confirm' => __('Are you sure you want to delete # {0}?', $solPreguntum->SOL_PREGUNTA)]) ?>
                </td>
            </tr>
            <?php endif ?>
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
