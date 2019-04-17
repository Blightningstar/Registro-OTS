<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProPrograma[]|\Cake\Collection\CollectionInterface $proPrograma
 */
?>
    <fieldset>
        <legend class = "titulo">Administración de Programas<br></br>
    </legend>
    <br>
    <h2>Programas</h2>
    <!--Linkea el boton a para que redireccione al agregar usuario -->
    <button type="button" class="botonAgregar">
        <!-- Se especifica que el controlador sea usuario para evitar que el nombre de la tabla aparezca en la url-->
        <a href="/Registro-OTS/programa/add" style="color:white;">Añadir Programa</a>   
    </button>

    <!-- Permite que aparezca la barra horizontal en caso de que no todos los campos de la tabla puedan verse a la vez -->
    <div class="container-fluid table-responsive">
    <table cellpadding="0" cellspacing="0" class="gridIndex table table-bordered">
        <thead>
            <tr >
                <!-- Coloca cada campo de la tabla en el grid -->


                <th scope="col"><?= $this->Paginator->sort('NOMBRE', ['label' => __('Nombre')]) ?></th>

                <th scope="col" class="actions">Ver</th>
                <th scope="col" class="actions">Modificar</th>
                <th scope="col" class="actions">Borrar</th>
            </tr>
        </thead>
        <tbody>
            <!-- Itera tupla por tupla y coloca los datos en cada columna -->
            <?php foreach ($proPrograma as $proPrograma): ?>
            <tr>

                <td><?= h($proPrograma->NOMBRE) ?></td>

                <td  class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $proPrograma->PRO_PROGRAMA]) ?>
                </td>

                <td  class="actions">
                    <?= $this->Html->link(__('Modificar'), ['action' => 'edit', $proPrograma->PRO_PROGRAMA]) ?>
                </td> 
                <td  class="actions">
                    <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $proPrograma->PRO_PROGRAMA], ['confirm' => __('Are you sure you want to delete # {0}?', $proPrograma->PRO_PROGRAMA)]) ?>
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
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
