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


    <button type="button" class="botonAgregar">
        
        <?= $this->Html->link(__('Add User'), ['controller' => 'usuario', 'action' => 'add'], ['style' => 'color:white;']) ?>   
    </button>
    <br>
  


  
    <label style=" display: inline-block;;margin-top:40px;margin-left:80px;"><?= __('Search Users ') ?></label>
        <input type="text" id="queryTextbox" style="width:50%;float:right;margin-top:40px;margin-right:120px;"> 
        


    <div class="container-fluid table-responsive">
    <table cellpadding="0" cellspacing="0" class="gridIndex table table-bordered">
        <thead>
            <tr id="headTr">
                
                <th scope="col"><?= $this->Paginator->sort(__('ID')) ?></th>
                <th scope="col"><?= $this->Paginator->sort(__('Name')) ?></th>
                <th scope="col"><?= $this->Paginator->sort(__('Lastname 1')) ?></th>
                <th scope="col"><?= $this->Paginator->sort(__('Lastname 2')) ?></th>
                <th scope="col"><?= $this->Paginator->sort(__('Username')) ?></th>
                <th scope="col"><?= $this->Paginator->sort(__('E-mail')) ?></th>
                <th scope="col"><?= $this->Paginator->sort(__('Telephone'))?></th>
                <th scope="col"><?= $this->Paginator->sort(__('Country')) ?></th>

                <th scope="col"><?= $this->Paginator->sort(__('Role')) ?></th>
                <th scope="col" class="actions"><?= __('') ?></th>
                <th scope="col" class="actions"><?= __('') ?></th>
                <th scope="col" class="actions"><?= __('') ?></th>
            </tr>
        </thead>
    
        <tbody  >
            
            <?php foreach ($segUsuario as $segUsuario): ?>
           <!-- <?php if(($segUsuario["ACTIVO"] != "N") && ($segUsuario->SEG_ROL != "3" || $lc_role != "2")):?>-->
            <tr >
                <td><?= h($segUsuario->SEG_USUARIO) ?></td>
                <td><?= h($segUsuario->NOMBRE) ?></td>
                <td><?= h($segUsuario->APELLIDO_1) ?></td>
                <td><?= h($segUsuario->APELLIDO_2) ?></td>
                <td><?= h($segUsuario->NOMBRE_USUARIO) ?></td>
                <td><?= h($segUsuario->CORREO) ?></td>
                <td><?= h($segUsuario->NUMERO_TELEFONO) ?></td>
                <td><?= h($segUsuario->NACIONALIDAD) ?></td>


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

                <button type="button" class="botonAccion btn btn-xs"> 
                        <?= $this->Html->link(__('View'), ['controller' => 'usuario', 'action' => 'view', $segUsuario->SEG_USUARIO]) ?>    
                    </button>
                </td>
                <td class="actions">

              
                <button type="button" class="botonAccion btn btn-xs"> 
                        <?= $this->Html->link(__('Edit'), ['controller' => 'usuario', 'action' => 'edit', $segUsuario->SEG_USUARIO]) ?>    
                    </button>
                </td>

        
                <td>
                   <button type="button" class="botonAccion btn btn-xs"> 
                       <?= $this->Form->postLink(__('Delete'), ['controller' => 'usuario', 'action' => 'delete', $segUsuario->SEG_USUARIO], ['confirm' => __('¿Desea eliminar el usuario con identificación: # {0}?', $segUsuario->SEG_USUARIO)]) ?>
                    </button>
                </td>
            </tr>
           <!-- <?php endif;?>-->
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

<script>
$(document).ready(function(){
  $("#queryTextbox").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("tr").filter(function() 
    {
        var excludeHeader = $(this).attr("id") == "headTr";
        if(!excludeHeader)
            $(this).toggle(($(this).text().toLowerCase().indexOf(value) > -1));
    });
  });
});
</script>

