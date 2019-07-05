<?php
/**
 * @author Joel Chaves
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SolPreguntum[]|\Cake\Collection\CollectionInterface $solPregunta
 */
?>

<div class="solPregunta index large-9 medium-8 columns content container-fluid">
    <fieldset>
        <legend class = "titulo"><?= __('Questions') ?>
             <br></br>
            <p class = "subtitulo"> <?= __('Administrate questions') ?></p>
        </legend>
        <br>

    <!-- The user got the right permission for the action? -->
    <?php if(array_key_exists(5, $roles)): ?>
        <button type="button" class="botonAgregar">
            <?= $this->Html->link(__('Add question'), ['controller' => 'pregunta', 'action' => 'add'],['style' => 'color:white;']) ?>   
        </button>
    <?php endif; ?>

    <div class="row">
        <label style="margin-left:30px;" ><?= __('Search Questions ') ?></label>
        <input type="text" id="queryTextbox" style="width:50%;margin-left:20px;"> 
    </div>
  
    <div class="container-fluid table-responsive"> 
    <table cellpadding="0" cellspacing="0" class="gridIndex table table-bordered">
        <thead>
            <tr id="headTr">
                <!-- The user got the right permission for the action? -->
                <?php if(array_key_exists(8, $roles)): ?>
                    <th scope="col"><?= $this->Paginator->sort('Active') ?></th>
                <?php endif; ?>
                <th scope="col"><?= $this->Paginator->sort('Description') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Required') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
                
            </tr>
        </thead>

        <tbody>

            <?php foreach ($solPregunta as $solPreguntum): ?>
           
            <tr>
                <!-- The user got the right permission for the action? -->
                <?php if(array_key_exists(8, $roles)): ?>
                    <td>
                        <?= $this->Form->create('Post', ['url' => '/pregunta/delete/' . $solPreguntum->SOL_PREGUNTA ]) ?>
                        <?=  $this->form->input(__('newActive'), ['type' => 'checkbox', 'label' => '', 'checked' => ($solPreguntum->ACTIVO == 1) ,
                        'onclick' => 'submit(12)']) ?>
                        <?= $this->Form->end() ?>       
                    </td>
                <?php endif; ?>

                <td><?= h($solPreguntum->DESCRIPCION_ING) ?></td>
                <?php if($solPreguntum->REQUERIDO ==0):?>

                    <td><?= h('Not required') ?></td>
                     <?php else: ?>
                     <td><?= h('Required') ?></td>

                <?php endif ?>

                <td>
                    <!-- The user got the right permission for the action? -->
                    <?php if(array_key_exists(6, $roles)): ?>
                        <?= $this->Html->link('<i class="fa fa-eye"></i>', ['controller' => 'pregunta', 'action' => 'view',  $solPreguntum->SOL_PREGUNTA], ['escape'=>false]) ?>
                    <?php endif; ?>
                    <!-- The user got the right permission for the action? -->
                    <?php if(array_key_exists(7, $roles)): ?>
                        <?= $this->Html->link('<i class="fa fa-pencil-alt"></i>', ['action' => 'edit', $solPreguntum->SOL_PREGUNTA], ['escape'=>false]) ?>
                    <?php endif; ?>
                </td>
             </tr>
           
            <?php endforeach; ?>
        </tbody>
    </table>
     </div>


    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>

            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} register(s) of {{count}}')]) ?></p>
    </div>
</div>

<?= $this->Html->script('scriptIndex.js'); ?>