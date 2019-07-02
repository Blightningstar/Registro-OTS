<?php
/**
 * @author Esteban Rojas
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SegUsuario[]|\Cake\Collection\CollectionInterface $segUsuario
 */
?>




<div class="segUsuario index large-9 medium-8 columns content container-fluid">
   
<fieldset>
        <legend class = "titulo"><?= __('User Administration') ?>
        <br></br>
        <p class = "subtitulo"> <?= __('Administrate system users') ?></p>
    </legend>
    <br>

    <!--Shows the button to add users-->
    <button type="button" class="botonAgregar">
        
        <?= $this->Html->link(__('Add User'), ['controller' => 'usuario', 'action' => 'add'], ['style' => 'color:white;']) ?>   
    </button>
    <br>
  
    <!-- Shows/hide rows by user input -->
    <div class="row">
    <label style="margin-left:30px;" ><?= __('Search Users ') ?></label>
        <input type="text" id="queryTextbox" style="width:50%;margin-left:20px;"> 
    </div>
  
    <!-- grid with all users-->
    <div class="container-fluid table-responsive">
    <table cellpadding="0" cellspacing="0" class="gridIndex table table-bordered table-striped">
        <thead>
            <!-- id="headTr" allows the search function to keep headers right! -->
            <tr id="headTr">
                
                <th scope="col"><?= $this->Paginator->sort(__('Active')) ?></th>
                <th scope="col"><?= $this->Paginator->sort(__('Username')) ?></th>
                <th scope="col"><?= $this->Paginator->sort(__('E-mail')) ?></th>
                <th scope="col"><?= $this->Paginator->sort(__('Telephone'))?></th>
                <th scope="col"><?= $this->Paginator->sort(__('Role')) ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
    
        <tbody>         
            
            <?php foreach ($segUsuario as $segUsuario): ?>
            <!--Each user is a row-->
            <tr>
                

                <!--Uses a form as wrapper to contain a checkbox wich will modify active value of the user.
                Better than use hidden inputs, from a security's perspective.-->
                <td>    
                    <?= $this->Form->create('Post', ['url' => '/usuario/delete/' . $segUsuario->SEG_USUARIO ]) ?>
                    <!-- Checkbox will submit each time user modify his value. -->
                    <?=  $this->form->input(__('newActive'), ['type' => 'checkbox', 'label' => '', 'checked' => ($segUsuario->ACTIVO == 1) ,
                    'onclick' => 'submit()', 'disabled' => ($segUsuario["NOMBRE_USUARIO"] == $actualUserName)]) ?>
                    <?= $this->Form->end() ?>
                </td>

                <td><?= h($segUsuario->NOMBRE_USUARIO) ?></td>
                <td><?= h($segUsuario->CORREO) ?></td>
                <td><?= h($segUsuario->NUMERO_TELEFONO) ?></td>

                <!-- mapping between role number and role name -->
                <?php   if($segUsuario->SEG_ROL == 1): ?>
                        <td><?= __('Superuser') ?></td>
                    <?php else: if($segUsuario->SEG_ROL == 2): ?>
                        <td><?= __('Administrator') ?></td>
                        <?php else: if($segUsuario->SEG_ROL == 3): ?>
                            <td><?= __('Student') ?></td>
                        <?php endif ?>
                <?php endif ?>
                <?php endif ?>

                <!-- eye and pencil buttons allows to view and edit users -->
                <td>
                <?= $this->Html->link('<i class="fa fa-eye"></i>', ['controller' => 'usuario', 'action' => 'view',  $segUsuario->SEG_USUARIO], ['escape'=>false]) ?>
                <?= $this->Html->link('<i class="fa fa-pencil-alt"></i>', ['action' => 'edit', $segUsuario->SEG_USUARIO], ['escape'=>false]) ?>
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
            <?= $this->Paginator->first('<< ' . __('First')) ?>
            <?= $this->Paginator->prev('< ' . __('Previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('Next') . ' >') ?>
            <?= $this->Paginator->last(__('Last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} register(s) of {{count}}')]) ?></p>
    </div>
</div>

<?= $this->Html->script('scriptIndex.js'); ?>