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
        <legend class = "titulo"><?= __('User Administration') ?>
        <br></br>
        <p class = "subtitulo"> <?= __('Administrate system users') ?></p>
    </legend>
    <br>

    <!--Linkea el boton a para que redireccione al agregar usuario -->
    <button type="button" class="botonAgregar">
        <!-- Se especifica que el controlador sea usuario para evitar que el nombre de la tabla aparezca en la url-->
        <?= $this->Html->link(__('Add User'), ['controller' => 'usuario', 'action' => 'add'], ['style' => 'color:white;']) ?>   
    </button>

    <!-- Permite que aparezca la barra horizontal en caso de que no todos los campos de la tabla puedan verse a la vez -->
    <div class="container-fluid table-responsive">
    <table cellpadding="0" cellspacing="0" class="gridIndex table table-bordered">
        <thead>
            <tr >
                <!-- Coloca cada campo de la tabla en el grid -->
                <th scope="col"><?= $this->Paginator->sort(__('ID')) ?></th>
                <th scope="col"><?= $this->Paginator->sort(__('Name')) ?></th>
                <th scope="col"><?= $this->Paginator->sort(__('Lastname 1')) ?></th>
                <th scope="col"><?= $this->Paginator->sort(__('Lastname 2')) ?></th>
                <th scope="col"><?= $this->Paginator->sort(__('Username')) ?></th>
                <th scope="col"><?= $this->Paginator->sort(__('E-mail')) ?></th>
                <th scope="col"><?= $this->Paginator->sort(__('Telephone'))?></th>
                <th scope="col"><?= $this->Paginator->sort(__('Country')) ?></th>
                <th scope="col"><?= $this->Paginator->sort(__('Activo')) ?></th>
                <th scope="col"><?= $this->Paginator->sort(__('Role')) ?></th>
                <th scope="col" class="actions"><?= __('') ?></th>
                <th scope="col" class="actions"><?= __('') ?></th>
                <th scope="col" class="actions"><?= __('') ?></th>
            </tr>
        </thead>
        <tbody>
            <!-- Itera tupla por tupla y coloca los datos en cada columna -->
            <?php foreach ($segUsuario as $segUsuario): ?>
            <?php if(($segUsuario["ACTIVO"] != "N") && ($segUsuario->SEG_ROL != "3" || $lc_role != "2")):?>
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
                        <td><?= __('Student') ?></td>
                    <?php else: if($segUsuario->SEG_ROL == 2): ?>
                        <td><?= __('Administrator') ?></td>
                        <?php else: if($segUsuario->SEG_ROL == 3): ?>
                            <td><?= __('Superuser') ?></td>
                        <?php endif ?>
                <?php endif ?>
                <?php endif ?>

                <td class="actions">
                <!-- Linkea el boton consultar con el consultar usuario -->
                <button type="button" class="botonAccion btn btn-xs"> 
                        <?= $this->Html->link(__('View'), ['controller' => 'usuario', 'action' => 'view', $segUsuario->SEG_USUARIO]) ?>    
                    </button>
                </td>
                <td class="actions">

                <!-- Linkea el boton editar con el editar usuario -->
                <button type="button" class="botonAccion btn btn-xs"> 
                        <?= $this->Html->link(__('Edit'), ['controller' => 'usuario', 'action' => 'edit', $segUsuario->SEG_USUARIO]) ?>    
                    </button>
                </td>

                <!-- Linkea el boton eliminar-->
                <td>
                   <button type="button" class="botonAccion btn btn-xs"> 
                       <?= $this->Form->postLink(__('Delete'), ['controller' => 'usuario', 'action' => 'delete', $segUsuario->SEG_USUARIO], ['confirm' => __('¿Desea eliminar el usuario con identificación: # {0}?', $segUsuario->SEG_USUARIO)]) ?>
                    </button>
                </td>
            </tr>
            <?php endif;?>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    </fieldset>
    <br>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('First')) ?>
            <?= $this->Paginator->prev('< ' . __('Previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('Next') . ' >') ?>
            <?= $this->Paginator->last(__('Last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} register(s) of {{count}}')]) ?></p>
    </div>
</div>


