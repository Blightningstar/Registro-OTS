<?php
/**
 * @author Jason Zamora Trejos
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProCurso[]|\Cake\Collection\CollectionInterface $proCurso
 */
?>
<!--Everything necessary to implement a toggle button to change the ACTIVE field in the index view-->
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

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
        <!-- Se especifica que el controlador sea curso para evitar que el nombre de la tabla aparezca en la url-->
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
                <th scope="col"><?= $this->Paginator->sort('Course ID') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Course name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Start date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Final date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Last enrollment date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Academic charge') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Location') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Active') ?></th>
                <th scope="col" class="actions"><?= __('') ?></th>
            </tr>
        </thead>
        <tbody>
            <!-- Iterate the data and places it in the respective column -->
            <?php foreach ($proCurso as $proCurso): ?>
            <tr>
                <td><?= h($proCurso->PRO_CURSO) ?></td>
                <td><?= h($proCurso->NOMBRE) ?></td>
                 <?php   //Converts the format of the dates in one that the database can save it.
                     $proCurso->FECHA_INICIO = date("m/d/Y", strtotime($proCurso->FECHA_INICIO)); 
                     $proCurso->FECHA_FINALIZACION = date("m/d/Y", strtotime($proCurso->FECHA_FINALIZACION));
                     $proCurso->FECHA_LIMITE = date("m/d/Y", strtotime($proCurso->FECHA_LIMITE));          
                ?>
                <td><?= h($proCurso->FECHA_INICIO) ?></td>
                <td><?= h($proCurso->FECHA_FINALIZACION) ?></td>
                <td><?= h($proCurso->FECHA_LIMITE) ?></td>
                <td><?= $this->Number->format($proCurso->CREDITOS) ?></td>
                <td><?= h($proCurso->LOCACION) ?></td>
                
                
                <td>
                  <?php if( h($proCurso->ACTIVO) == 1) { ?>  
                     <input id="toggle-activo" type="checkbox" data-toggle="toggle" data-on="Enabled" data-off="Disabled" checked>
                  <?php } else { ?>
                     <input id="toggle-activo" type="checkbox" data-toggle="toggle" data-on="Enabled" data-off="Disabled">
                  <?php } ?>
                 
                </td>
                
                 
                <td class="actions">
                <!-- Links the view button to the course-->
                  <?= $this->Html->link('<i class="fa fa-eye"></i>', ['controller' => 'curso', 'action' => 'view', $proCurso->PRO_CURSO], ['escape'=>false])?> 
                  &nbsp;  
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

<script>
//Changes the ACTIVE row in the course table
$(document).ready(function(){
//   $("#toggle-event").change(function() {
//      <?= $this->Form->postLink(__('Active'), ['controller' => 'curso', 'action' => 'logicalDelete', $proCurso->PRO_CURSO, $proCurso->ACTIVO]) ?>
//    });
$( "#toggle-activo" ).change(function() { 
   alert( "val" ); 
   });
});
</script>