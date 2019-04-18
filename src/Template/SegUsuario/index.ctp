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
                <th scope="col"><?= $this->Paginator->sort(__('ID')) ?></th>
                <th scope="col"><?= $this->Paginator->sort(__('Nombre')) ?></th>
                <th scope="col"><?= $this->Paginator->sort(__('Apellido 1')) ?></th>
                <th scope="col"><?= $this->Paginator->sort(__('Apellido 2')) ?></th>
                <th scope="col"><?= $this->Paginator->sort(__('Nombre Usuario')) ?></th>
                <th scope="col"><?= $this->Paginator->sort(__('E-mail')) ?></th>
                <th scope="col"><?= $this->Paginator->sort(__('Teléfono'))?></th>
                <th scope="col"><?= $this->Paginator->sort(__('Nacionalidad')) ?></th>
                <th scope="col"><?= $this->Paginator->sort(__('Activo')) ?></th>
                <th scope="col"><?= $this->Paginator->sort(__('Rol')) ?></th>
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

                <?php   if($segUsuario->SEG_ROL == 1): ?>
                        <td><?= __('Estudiante') ?></td>
                    <?php else: if($segUsuario->SEG_ROL == 2): ?>
                        <td><?= __('Administrador') ?></td>
                        <?php else: if($segUsuario->SEG_ROL == 3): ?>
                            <td><?= __('Superusuario') ?></td>
                        <?php endif ?>
                <?php endif ?>
                <?php endif ?>

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
                       <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'usuario', 'action' => 'delete', $segUsuario->SEG_USUARIO], ['confirm' => __('¿Desea eliminar el usuario con identificación: # {0}?', $segUsuario->SEG_USUARIO)]) ?>
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


