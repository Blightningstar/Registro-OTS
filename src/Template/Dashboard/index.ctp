<?php
/**
 * @author Jason Zamora Trejos
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProCurso[]|\Cake\Collection\CollectionInterface $proCurso
 */
?>

<!--This makes the container able to adapt to diffent resolutions-->
<div class="DashboardAdministrador index large-9 medium-8 columns content container-fluid">
    <!--Title, subtitle and a line to separate-->
<fieldset>
      <legend class = "titulo"><?= __('Administrator Dashboard') ?>
      <br></br>
      <p class = "subtitulo"><?= __('Administration of application in your courses')?> </p>
   </legend>
   <br>
   
   <div class="row">
      <label style="margin-left:30px;" ><?= __('Search: ') ?></label>
      <input type="text" id="queryTextbox" style="width:50%;margin-left:20px;"> 
   </div>
   
   <!-- Shows a placebar in case that there are a lot of data to display -->
 <div class="container-fluid table-responsive">
 <table cellpadding="0" cellspacing="0" class="gridIndex table table-bordered">
        <thead>
            <tr id="headTr">
                <!-- Puts each field of the table in the grid -->
                <th scope="col"><?= $this->Paginator->sort('Parent Program\'s name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Course ID') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Course name') ?></th>
                <th scope="col" class="actions"><?= __('') ?></th>
            </tr>
        </thead>
         <tbody>
            <!-- Iterate the data and places it in the respective column -->
            <?php foreach ($queryDashboard as $queryDashboard): ?>
            <tr>
               <!--Uses a form as wrapper to contain a checkbox which will modify active value of the course.
                Better than use hidden inputs, from a security's perspective.-->
                <td><?= h($queryDashboard->PRO_PROGRAMA) ?></td>
                <td><?= h($queryDashboard->SIGLA) ?></td>
                <td><?= h($queryDashboard->NOMBRE) ?></td>
                
                <td class="actions">
                <!-- Links the view button to the course-->
                  <button type="button" class="botonDashboardDenegar">
                        <?= $this->Html->link(__('See Aplications'), ['controller' => 'Dashboard', 'action' => 'cursoViewDashboard', $queryDashboard->PRO_CURSO], ['style' => 'color:white;']) ?>   
                  </button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
 </table>
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
