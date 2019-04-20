<?php
/**
 * @author Anyelo Mijael Lobo Cheloukhin
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProPrograma $proPrograma
 */
?>
<!-- <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Pro Programa'), ['action' => 'edit', $proPrograma->PRO_PROGRAMA]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Pro Programa'), ['action' => 'delete', $proPrograma->PRO_PROGRAMA], ['confirm' => __('Are you sure you want to delete # {0}?', $proPrograma->PRO_PROGRAMA)]) ?> </li>
        <li><?= $this->Html->link(__('List Pro Programa'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Pro Programa'), ['action' => 'add']) ?> </li>
    </ul>
</nav> -->

<div class="proPrograma view large-9 medium-8 columns content">

    <fieldset>
        <legend class = "titulo">Administración de Programas<br></br>
        <legend class = "subtitulo">Mostrando programa: <?= h($proPrograma->PRO_PROGRAMA) ?><br></br></legend>
    </fieldset>

    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('ID del Programa') ?></th>
            <td><?= h($proPrograma->PRO_PROGRAMA) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nombre del programa') ?></th>
            <td><?= h($proPrograma->NOMBRE) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Activo / No Activo)') ?></th>
            <td><?= h($proPrograma->ACTIVO) ?></td>
        </tr>
    </table>
    <a href="/Registro-OTS/programa/"> <button type="button" class="botonCancelar">Regresar a Programas</button> </a>
</div>
