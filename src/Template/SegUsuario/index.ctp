<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SegUsuario[]|\Cake\Collection\CollectionInterface $segUsuario
 */
?>




<!--Se hace el contenedor fluido para que sea adaptable a distintas resoluciones-->
<div class="segUsuario index large-9 medium-8 columns content container-fluid">
    <!--Titulo, subtitulo y la raya-->
<fieldset>
        <legend class = "titulo"><?= __('Administración de usuarios') ?>
        <br></br>
        <p class = "subtitulo">Administra los usuarios del sistema </p>
    </legend>
    <br>

    <!--Linkea el boton a para que redireccione al agregar usuario -->
    <button type="button" class="botonAgregar">
        <!-- Se especifica que el controlador sea usuario para evitar que el nombre de la tabla aparezca en la url-->
        <?= $this->Html->link(__('Agregar Usuario'), ['controller' => 'usuario', 'action' => 'add'], ['style' => 'color:white;']) ?>   
    </button>

    <!-- Permite que aparezca la barra horizontal en caso de que no todos los campos de la tabla puedan verse a la vez -->
    <div class="container-fluid table-responsive">
    <table cellpadding="0" cellspacing="0" class="gridIndex table table-bordered">
        <thead>
            <tr >
                <!-- Coloca cada campo de la tabla en el grid -->
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
            <!-- Itera tupla por tupla y coloca los datos en cada columna -->
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
                <!-- Linkea el boton consultar con el consultar usuario -->
                <button type="button" class="botonAccion btn btn-xs"> 
                        <?= $this->Html->link(__('Consultar'), ['controller' => 'usuario', 'action' => 'view', $segUsuario->SEG_USUARIO]) ?>    
                    </button>
                </td>
                <td class="actions">

                <!-- Linkea el boton editar con el editar usuario -->
                <button type="button" class="botonAccion btn btn-xs"> 
                        <?= $this->Html->link(__('Editar'), ['controller' => 'usuario', 'action' => 'edit', $segUsuario->SEG_USUARIO]) ?>    
                    </button>
                </td>

                <!-- Linkea el boton eliminar-->
                <td>
                   <button type="button" class="botonAccion btn btn-xs"> 
                       <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'usuario', 'action' => 'delete', $segUsuario->SEG_USUARIO], ['confirm' => __('Are you sure you want to delete # {0}?', $segUsuario->SEG_USUARIO)]) ?>
                    </button>
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


