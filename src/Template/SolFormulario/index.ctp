<?php
/**
 * @author Anyelo Mijael Lobo Cheloukhin
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SolFormulario[]|\Cake\Collection\CollectionInterface $solFormulario
 */
?>
<div class="proPrograma index large-9 medium-8 columns content container-fluid">
    <fieldset>

    <legend class = "titulo">Form Administration<br></br>
        <p class = "subtitulo">Form List</p>
    </legend>

    <br>
    <!--Linkea el boton a para que redireccione al agregar usuario -->
    <button type="button" class="botonAgregar">
        <!-- Se especifica que el controlador sea usuario para evitar que el nombre de la tabla aparezca en la url-->
        <a href="/Registro-OTS/SolFormulario/add" style="color:white;">Add Form</a>   
    </button>

    <div class="row">
        <label style="margin-left:30px;" ><?= __('Search Forms ') ?></label>
        <input type="text" id="queryTextbox" style="width:50%;margin-left:20px;"> 
    </div>

    <!-- Permite que aparezca la barra horizontal en caso de que no todos los campos de la tabla puedan verse a la vez -->
    <div class="container-fluid table-responsive">
    <table cellpadding="0" cellspacing="0" class="gridIndex table table-bordered">
        <thead>
            <tr id="headTr">
                <!-- Coloca cada campo de la tabla en el grid -->

                <th scope="col"><?= $this->Paginator->sort('Active') ?></th>
                <th scope="col"><?= $this->Paginator->sort('NOMBRE', ['label' => __('Form Name')]) ?></th>

                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>

        </thead>

        <thead>
            <tr id="headTr">
                <!-- Coloca cada campo de la tabla en el grid -->

                <th scope="col"><?= $this->Paginator->sort('Active') ?></th>
                <th scope="col"><?= $this->Paginator->sort('S', ['label' => __('Question Name')]) ?></th>

                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>

        </thead>

        <tbody>
            <!-- Itera tupla por tupla y coloca los datos en cada columna -->
            <?php foreach ($solFormulario as $solFormulario): ?>
            <tr>
                <td>
                <?= $this->Form->create('Post', ['url' => '/SolFormulario/delete/' . $solFormulario->SOL_FORMULARIO ]) ?>
                <?= $this->form->input(__('newActive'), ['type' => 'checkbox', 'label' => '', 'checked' => ($solFormulario->ACTIVO == 1) ,
                'onclick' => 'submit(12)']) ?>
                <?= $this->Form->end() ?>
                </td>

                <td><?= h($solFormulario->SOL_FORMULARIO) ?></td>

                <td>
                <?= $this->Html->link('<i class="fa fa-eye"></i>', ['controller' => 'programa', 'action' => 'view',  $solFormulario->SOL_FORMULARIO], ['escape'=>false]) ?>
                <?= $this->Html->link('<i class="fa fa-pencil-alt"></i>', ['action' => 'edit', $solFormulario->SOL_FORMULARIO], ['escape'=>false]) ?>
                </td

            </tr>
            <?php endforeach; ?>


        </tbody>

        <tbody>
            <!-- Itera tupla por tupla y coloca los datos en cada columna -->
            <?php foreach ($solFormulario as $solFormulario): ?>
            <tr>
                <td>
                <?= $this->Form->create('Post', ['url' => '/SolFormulario/delete/' . $data->SOL_PREGUNTA ]) ?>
                <?= $this->form->input(__('newActive'), ['type' => 'checkbox', 'label' => '', 'checked' => ($data->ACTIVO == 1) ,
                'onclick' => 'submit(12)']) ?>
                <?= $this->Form->end() ?>
                </td>

                <td><?= h($data->SOL_PREGUNTA) ?></td>

                <td>
                <?= $this->Html->link('<i class="fa fa-eye"></i>', ['controller' => 'programa', 'action' => 'view',  $data->SOL_FORMULARIO], ['escape'=>false]) ?>
                <?= $this->Html->link('<i class="fa fa-pencil-alt"></i>', ['action' => 'edit', $data->SOL_FORMULARIO], ['escape'=>false]) ?>
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