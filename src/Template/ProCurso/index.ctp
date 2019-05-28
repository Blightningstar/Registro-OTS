<?php
/**
 * @author Jason Zamora Trejos
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProCurso[]|\Cake\Collection\CollectionInterface $proCurso
 */
?>

<!--This makes the container able to adapt to diffent resolutions-->
<div class="proCurso index large-9 medium-8 columns content container-fluid">
    <!--Title, subtitle and a line to separate-->
<fieldset>
      <legend class = "titulo"><?= __('Administration of courses') ?>
      <br></br>
      <p class = "subtitulo"> Administration of courses in the system </p>
   </legend>
   <br>
    
    <!--Links the create button to a new course -->
    <button type="button" class="botonAgregar">
        <?= $this->Html->link(__('Add Course'), ['controller' => 'curso', 'action' => 'add'], ['style' => 'color:white;']) ?>   
    </button>
    
    <div class="row">
      <label style="margin-left:30px;" ><?= __('Search Courses ') ?></label>
      <input type="text" id="queryTextbox" style="width:50%;margin-left:20px;"> 
    </div>
    
 <!-- Shows a placebar in case that there are a lot of data to display -->
 <div class="container-fluid table-responsive">
 <table cellpadding="0" cellspacing="0" class="gridIndex table table-bordered">
        <thead>
            <tr id="headTr">
                <!-- Puts each field of the table in the grid -->
                <th scope="col"><?= $this->Paginator->sort('Active') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Course ID') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Course name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Parent program') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Start date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Final date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Last enrollment date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Location') ?></th>
                <th scope="col" class="actions"><?= __('') ?></th>
            </tr>
        </thead>
        <tbody>
            <!-- Iterate the data and places it in the respective column -->
            <?php foreach ($proCurso as $proCurso): ?>
            <tr>
               <!--Uses a form as wrapper to contain a checkbox which will modify active value of the course.
                Better than use hidden inputs, from a security's perspective.-->
                <td>    
                    <?= $this->Form->create('Post', ['url' => '/curso/delete/' . $proCurso->PRO_CURSO ]) ?>
                    <!-- Checkbox will submit each time user modify his value. -->
                    <?=  $this->form->input(__('newActive'), ['type' => 'checkbox', 'label' => '', 'checked' => ($proCurso->ACTIVO == 1) ,
                    'onclick' => 'submit()']) ?>
                    <?= $this->Form->end() ?>
                </td>
                <td><?= h($proCurso->SIGLA) ?></td>
                <td><?= h($proCurso->NOMBRE) ?></td>
                <td><?= h($proCurso->PRO_PROGRAMA) ?></td>
                 <?php   //Converts the format of the dates in one that the database can save it.
                     $proCurso->FECHA_INICIO = date("m/d/Y", strtotime($proCurso->FECHA_INICIO)); 
                     $proCurso->FECHA_FINALIZACION = date("m/d/Y", strtotime($proCurso->FECHA_FINALIZACION));
                     $proCurso->FECHA_LIMITE = date("m/d/Y", strtotime($proCurso->FECHA_LIMITE));          
                ?>
                <td><?= h($proCurso->FECHA_INICIO) ?></td>
                <td><?= h($proCurso->FECHA_FINALIZACION) ?></td>
                <td><?= h($proCurso->FECHA_LIMITE) ?></td>
                <td><?= h($proCurso->LOCACION) ?></td>
                
                <td class="actions">
                <!-- Links the view button to the course-->
                  <?= $this->Html->link('<i class="fa fa-eye"></i>', ['controller' => 'curso', 'action' => 'view', $proCurso->PRO_CURSO], ['escape'=>false])?>  
                  <?= $this->Html->link('<i class="fa fa-pencil-alt"></i>', ['controller' => 'curso', 'action' => 'edit', $proCurso->PRO_CURSO], ['escape'=>false]) ?>    
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
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>

<script>
//When the user write in the search bar it filters the table.
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