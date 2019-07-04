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
    <!-- The user got the right permission for the action? -->
    <?php if(array_key_exists(10, $roles)): ?>
        <button type="button" class="botonAgregar">
            <!-- Se especifica que el controlador sea usuario para evitar que el nombre de la tabla aparezca en la url-->
            <a href="/Registro-OTS/SolFormulario/add" style="color:white;">Add Form</a>   
        </button>
    <?php endif; ?>

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
                <!-- The user got the right permission for the action? -->
                <?php if(array_key_exists(12, $roles)): ?>
                    <th scope="col"><?= $this->Paginator->sort('Active') ?></th>
                <?php endif; ?>
                <th scope="col"><?= $this->Paginator->sort('NOMBRE', ['label' => __('Form Name')]) ?></th>

                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>

        </thead>

        <tbody>
            <!-- Itera tupla por tupla y coloca los datos en cada columna -->
            <?php foreach ($solFormulario as $solFormulario): ?>
            <tr>
                <!-- The user got the right permission for the action? -->
                <?php if(array_key_exists(12, $roles)): ?>
                    <td>
                        <?= $this->Form->create('Post', ['url' => '/SolFormulario/delete1/' . $solFormulario->SOL_FORMULARIO ]) ?>
                        <?= $this->form->input(__('newActive'), ['type' => 'checkbox', 'label' => '', 'checked' => ($solFormulario->ACTIVO == 1) ,
                        'onclick' => 'submit(12)']) ?>
                        <?= $this->Form->end() ?>
                    </td>
                <?php endif; ?>

               <td><?= h($solFormulario->NOMBRE) ?></td>

                <td>
                    <!-- The user got the right permission for the action? -->
                    <?php if(array_key_exists(11, $roles)): ?>
                        <?= $this->Html->link('<i class="fa fa-eye"></i>', ['controller' => 'SolFormulario', 'action' => 'view',  $solFormulario->SOL_FORMULARIO], ['escape'=>false]) ?>
                    <?php endif; ?>
                    <!-- The user got the right permission for the action? -->
                    <?php if(array_key_exists(12, $roles)): ?>
                        <?= $this->Html->link('<i class="fa fa-trash"></i>', ['controller' => 'SolFormulario', 'action' => 'delete',  $solFormulario->SOL_FORMULARIO], ['escape'=>false]) ?>
                    <?php endif; ?>
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

<?= $this->Html->script('scriptIndex.js'); ?>