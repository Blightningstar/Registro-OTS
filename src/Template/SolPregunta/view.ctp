<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SolPreguntum $solPreguntum
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
         <li><?= $this->Html->link(__('Edit this question'), ['action' => 'edit', $solPreguntum->SOL_PREGUNTA]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete this question'), ['action' => 'delete', $solPreguntum->SOL_PREGUNTA], ['confirm' => __('Are you sure you want to delete # {0}?', $solPreguntum->SOL_PREGUNTA)]) ?> </li>
        <li><?= $this->Html->link(__('Question bank'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Add a new question'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="solPregunta view large-9 medium-8 columns content">
    <h3><?= h($solPreguntum->SOL_PREGUNTA) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Description in spanish') ?></th>
            <td><?= h($solPreguntum->DESCRIPCION_ESP) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description in english') ?></th>
            <td><?= h($solPreguntum->DESCRIPCION_ING) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Required') ?></th>

            <?php if($solPreguntum->REQUERIDO ==0):?>

                <td><?= h('Required') ?></td>
            <?php else: ?>
                <td><?= h('Not required') ?></td>

            <?php endif ?>



        </tr>
        <tr>
            <th scope="row"><?= __('State') ?></th>
            <?php if($solPreguntum->ACTIVO ==0):?>

                <td><?= h('Active') ?></td>
            <?php else: ?>
                <td><?= h('Inactive') ?></td>

            <?php endif ?>
        </tr>
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            
            

            <?php if(($this->Number->format($solPreguntum->TIPO)) ==0):?>

                <td><?= h('Text') ?></td>

            <?php elseif(($this->Number->format($solPreguntum->TIPO)) ==1):?>

                <td><?= h('Number') ?></td>

            <?php elseif(($this->Number->format($solPreguntum->TIPO)) ==2):?>

                <td><?= h('Date') ?></td>

            <?php elseif(($this->Number->format($solPreguntum->TIPO)) ==3):?>

                <td><?= h('Select') ?></td>


            <?php endif ?>






        </tr>
    </table>
</div>
