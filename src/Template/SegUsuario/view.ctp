<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SegUsuario $segUsuario
 */
?>



<div class="segUsuario view large-9 medium-8 columns content">
    <h3><?= h($segUsuario->SEG_USUARIO) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('SEG USUARIO') ?></th>
            <td><?= h($segUsuario->SEG_USUARIO) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
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
