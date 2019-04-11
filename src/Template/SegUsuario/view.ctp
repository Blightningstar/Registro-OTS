<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SegUsuario $segUsuario
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Seg Usuario'), ['action' => 'edit', $segUsuario->SEG_USUARIO]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Seg Usuario'), ['action' => 'delete', $segUsuario->SEG_USUARIO], ['confirm' => __('Are you sure you want to delete # {0}?', $segUsuario->SEG_USUARIO)]) ?> </li>
        <li><?= $this->Html->link(__('List Seg Usuario'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Seg Usuario'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="segUsuario view large-9 medium-8 columns content">
    <h3><?= h($segUsuario->SEG_USUARIO) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('SEG USUARIO') ?></th>
            <td><?= h($segUsuario->SEG_USUARIO) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('NOMBRE') ?></th>
            <td><?= h($segUsuario->NOMBRE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('APELLIDO 1') ?></th>
            <td><?= h($segUsuario->APELLIDO_1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('APELLIDO 2') ?></th>
            <td><?= h($segUsuario->APELLIDO_2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('NOMBRE USUARIO') ?></th>
            <td><?= h($segUsuario->NOMBRE_USUARIO) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CONTRASEÑA') ?></th>
            <td><?= h($segUsuario->CONTRASEÑA) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CORREO') ?></th>
            <td><?= h($segUsuario->CORREO) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('NUMERO TELEFONO') ?></th>
            <td><?= h($segUsuario->NUMERO_TELEFONO) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('NACIONALIDAD') ?></th>
            <td><?= h($segUsuario->NACIONALIDAD) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ACTIVO') ?></th>
            <td><?= h($segUsuario->ACTIVO) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ESTUDIANTE') ?></th>
            <td><?= h($segUsuario->ESTUDIANTE) ?></td>
        </tr>
    </table>
</div>
