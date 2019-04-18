<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProCurso $proCurso
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Pro Curso'), ['action' => 'edit', $proCurso->PRO_CURSO]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Pro Curso'), ['action' => 'delete', $proCurso->PRO_CURSO], ['confirm' => __('Are you sure you want to delete # {0}?', $proCurso->PRO_CURSO)]) ?> </li>
        <li><?= $this->Html->link(__('List Pro Curso'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Pro Curso'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="proCurso view large-9 medium-8 columns content">
    <h3><?= h($proCurso->PRO_CURSO) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('PRO CURSO') ?></th>
            <td><?= h($proCurso->PRO_CURSO) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('NOMBRE') ?></th>
            <td><?= h($proCurso->NOMBRE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IDIOMA') ?></th>
            <td><?= h($proCurso->IDIOMA) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('LOCACION') ?></th>
            <td><?= h($proCurso->LOCACION) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ACTIVO') ?></th>
            <td><?= h($proCurso->ACTIVO) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('PRO PROGRAMA') ?></th>
            <td><?= h($proCurso->PRO_PROGRAMA) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('SEG USUARIO') ?></th>
            <td><?= h($proCurso->SEG_USUARIO) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('SOL FORMULARIO') ?></th>
            <td><?= h($proCurso->SOL_FORMULARIO) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CREDITOS') ?></th>
            <td><?= $this->Number->format($proCurso->CREDITOS) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('FECHA INICIO') ?></th>
            <td><?= h($proCurso->FECHA_INICIO) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('FECHA FINALIZACION') ?></th>
            <td><?= h($proCurso->FECHA_FINALIZACION) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('FECHA LIMITE') ?></th>
            <td><?= h($proCurso->FECHA_LIMITE) ?></td>
        </tr>
    </table>
</div>
