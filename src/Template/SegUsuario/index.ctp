<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SegUsuario[]|\Cake\Collection\CollectionInterface $segUsuario
 */
?>





<div class="segUsuario index large-9 medium-8 columns content container-fluid">
<fieldset>
        <legend class = "titulo"><?= __('Administración de usuarios') ?>
        <br></br>
        <p class = "subtitulo">Administra los usuarios del sistema </p>
    </legend>
    <br>
    <a href="add"> <button type="button" class="botonAgregar">Agregar Usuario</button> </a>
    <div class="container-fluid table-responsive">
    <table cellpadding="0" cellspacing="0" class="gridIndex table table-bordered">
        <thead>
            <tr >
                <th scope="col"><?= $this->Paginator->sort('ID') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Nombre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Apellido 1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Apellido 2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Nombre Usuario') ?></th>
                <th scope="col"><?= $this->Paginator->sort('E-mail') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Teléfono') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Nacionalidad') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Activo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Estudiante') ?></th>
                <th scope="col" class="actions"><?= __('') ?></th>
                <th scope="col" class="actions"><?= __('') ?></th>
                <th scope="col" class="actions"><?= __('') ?></th>
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
                <td><?= h($segUsuario->CORREO) ?></td>
                <td><?= h($segUsuario->NUMERO_TELEFONO) ?></td>
                <td><?= h($segUsuario->NACIONALIDAD) ?></td>
                <td><?= h($segUsuario->ACTIVO) ?></td>
                <td><?= h($segUsuario->ESTUDIANTE) ?></td>
                <td class="actions">
                <a href="view"> <button type="button" class="botonAccion btn btn-xs">Consultar</button> </a>
                </td>
                <td class="actions">
                <a href="edit"> <button type="button" class="botonAccion btn btn-xs">Editar</button> </a>
                </td>
                <td>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $segUsuario->SEG_USUARIO, 'class' => 'botonAccion btn'], ['confirm' => __('Are you sure you want to delete # {0}?', $segUsuario->SEG_USUARIO)]) ?>
                    </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    </fieldset>
    <br>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('primero')) ?>
            <?= $this->Paginator->prev('< ' . __('anterior')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('siguiente') . ' >') ?>
            <?= $this->Paginator->last(__('último') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Página {{page}} de{{pages}}, mostrando {{current}} registro(s) de {{count}}')]) ?></p>
    </div>
</div>


