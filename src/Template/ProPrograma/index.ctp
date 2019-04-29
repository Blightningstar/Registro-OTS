<?php
/**
 * @author Anyelo Mijael Lobo Cheloukhin
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProPrograma[]|\Cake\Collection\CollectionInterface $proPrograma
 */
?>
<div class="proPrograma index large-9 medium-8 columns content container-fluid">
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

    <div class="row">
        <label style="margin-left:30px;" ><?= __('Search Programs ') ?></label>
        <input type="text" id="queryTextbox" style="width:50%;margin-left:20px;"> 
    </div>

    <!-- Permite que aparezca la barra horizontal en caso de que no todos los campos de la tabla puedan verse a la vez -->
    <div class="container-fluid table-responsive">
    <table cellpadding="0" cellspacing="0" class="gridIndex table table-bordered">
        <thead>
            <tr id="headTr">
                <!-- Coloca cada campo de la tabla en el grid -->

                <th scope="col"><?= $this->Paginator->sort('Active') ?></th>
                <th scope="col"><?= $this->Paginator->sort('NOMBRE', ['label' => __('Program Name')]) ?></th>

                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <!-- Itera tupla por tupla y coloca los datos en cada columna -->
            <?php foreach ($proPrograma as $proPrograma): ?>
            <tr>
                <td>
                <?= $this->Form->create('Post', ['url' => '/programa/delete/' . $proPrograma->PRO_PROGRAMA ]) ?>
                <?= $this->form->input(__('newActive'), ['type' => 'checkbox', 'label' => '', 'checked' => ($proPrograma->ACTIVO == 1) ,
                'onclick' => 'submit(12)']) ?>
                <?= $this->Form->end() ?>
                </td>

                <td><?= h($proPrograma->NOMBRE) ?></td>

                <td>
                <?= $this->Html->link('<i class="fa fa-eye"></i>', ['controller' => 'programa', 'action' => 'view',  $proPrograma->PRO_PROGRAMA], ['escape'=>false]) ?>
                <?= $this->Html->link('<i class="fa fa-pencil-alt"></i>', ['action' => 'edit', $proPrograma->PRO_PROGRAMA], ['escape'=>false]) ?>
                </td

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

<?= $this->Html->script('scriptIndex.js'); ?>