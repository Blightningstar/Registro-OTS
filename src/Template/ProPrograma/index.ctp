<?php
/**
 * @author Anyelo Mijael Lobo Cheloukhin
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProPrograma[]|\Cake\Collection\CollectionInterface $proPrograma
 */
?>
    <fieldset>

    <legend class = "titulo">Program Administration<br></br>
        <p class = "subtitulo">Program List</p>
    </legend>

    <br>
    <!--Linkea el boton a para que redireccione al agregar usuario -->
    <button type="button" class="botonAgregar">
        <!-- Se especifica que el controlador sea usuario para evitar que el nombre de la tabla aparezca en la url-->
        <a href="/Registro-OTS/programa/add" style="color:white;">Add Program</a>   
    </button>

    <!-- Permite que aparezca la barra horizontal en caso de que no todos los campos de la tabla puedan verse a la vez -->
    <div class="container-fluid table-responsive">
    <table cellpadding="0" cellspacing="0" class="gridIndex table table-bordered">
        <thead>
            <tr >
                <!-- Coloca cada campo de la tabla en el grid -->


                <th scope="col"><?= $this->Paginator->sort('NOMBRE', ['label' => __('Program Name')]) ?></th>
                <th scope="col"><?= $this->Paginator->sort('ACTIVO', ['label' => __('Active / Inactive')]) ?></th>

                <th scope="col" class="actions">View</th>
                <th scope="col" class="actions">Edit</th>
                <th scope="col" class="actions">Delete</th>
            </tr>
        </thead>
        <tbody>
            <!-- Itera tupla por tupla y coloca los datos en cada columna -->
            <?php foreach ($proPrograma as $proPrograma): ?>
            <tr>

                <td><?= h($proPrograma->NOMBRE) ?></td>
                <td><?= h($proPrograma->ACTIVO) ?></td>

                <!-- Botones Consultar, Modificar y Borrar de la grilla de Programas -->
                <td class="actions">
                <button type="button" class="botonAccion btn btn-xs"> 
                        <?= $this->Html->link(__('View'), ['controller' => 'programa', 'action' => 'view', $proPrograma->PRO_PROGRAMA]) ?>    
                    </button>
                </td>

                <td class="actions">
                <button type="button" class="botonAccion btn btn-xs"> 
                        <?= $this->Html->link(__('Edit'), ['controller' => 'programa', 'action' => 'edit', $proPrograma->PRO_PROGRAMA]) ?>    
                    </button>
                </td>

                <td class="actions">
                <button type="button" class="botonAccion btn btn-xs"> 
                        <?= $this->Html->link(__('Delete'), ['controller' => 'programa', 'action' => 'delete', $proPrograma->PRO_PROGRAMA], ['confirm' => __('Are you sure you want to delete program # {0}?', $proPrograma->PRO_PROGRAMA)]) ?>    
                    </button>
                </td>


            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    </fieldset>

    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} program(s) out of {{count}} total')]) ?></p>
    </div>
</div>
