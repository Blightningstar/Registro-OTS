<?php
/**
 * @author Jason Zamora Trejos
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProCurso[]|\Cake\Collection\CollectionInterface $proCurso
 */
?>

<!--This makes the container able to adapt to diffent resolutions-->
<div class="DashboardAdministradorCurso curso_view_dashboard large-9 medium-8 columns content container-fluid">
    <!--Title, subtitle and a line to separate-->
<fieldset>
      <legend class = "titulo"><?= $proCurso->NOMBRE ?>
      <br></br>
      <p class = "subtitulo"> <?=__('Application Information') ?></p>
   </legend>
   <br>
   
   <div class="row">
      <label style="margin-left:30px;" ><?= __('Search: ') ?></label>
      <input type="text" id="queryTextbox" style="width:50%;margin-left:20px;"> 
      
    <!-- Shows a placebar in case that there are a lot of data to display -->
   <div class="container-fluid table-responsive">
      <table cellpadding="0" cellspacing="0" class="gridIndex table table-bordered">
        <thead>
            <tr id="headTr">
                <!-- Puts each field of the table in the grid -->
                <th scope="col"><?= $this->Paginator->sort('Student\'s name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Form Completion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('State') ?></th>
                <th scope="col" class="actions"><?= __('') ?></th>
            </tr>
        </thead>
        <tbody>
            <!-- Iterate the data and places it in the respective column -->
            <?php foreach ($Query as $Query): ?>
            <tr>
               <!--Uses a form as wrapper to contain a checkbox which will modify active value of the course.
                Better than use hidden inputs, from a security's perspective.-->
                <td><?= $Query['segUsuario']['NOMBRE'] . " ",
                        $Query['segUsuario']['APELLIDO_1'] . " ",
                        $Query['segUsuario']['APELLIDO_2']
                        ?></td>
                <td class="actions">
                        <!-- Links to view of the form of a student in particular-->
                     <button type="button" class="botonDashboardAceptarConsultar">
                           <?= $this->Html->link(__('Review'), ['controller' => 'Dashboard', 'action' => 'review',$Query['segUsuario']['SEG_USUARIO'],$proCurso->PRO_CURSO], ['style' => 'color:white;']) ?>
                     </button>
                </td>
                <td><?= $solicitud->getpercentage($proCurso->PRO_CURSO, $Query['segUsuario']['SEG_USUARIO']); ?></td>

                <td>
                <?php
                $state = $Query->RESULTADO;
                if($Query->RESULTADO == 'Aceptado')
                {
                  $state = 'Accepted';
                }
                else if($Query->RESULTADO == 'Completo')
                {
                  $state = 'Completed';
                }
                else if($Query->RESULTADO == 'Rechazado')
                {
                  $state = 'Denied';
                }
                else if($Query->RESULTADO == 'Proceso')
                {
                  $state = 'In Progress';
                } else
                { 
                  $state = 'Accepted';
                }?>
                
                
                <?php echo $state ?>
                </td>
                <td class="actions">
                <!-- Links the view button to the course-->
                     <button type="button" class="botonDashboardAceptarConsultar">
                           <?= $this->Html->link(__('Approve'), ['controller' => 'Dashboard', 'action' => 'accept', $proCurso->PRO_CURSO, $Query['segUsuario']['SEG_USUARIO']], ['style' => 'color:white;']) ?> 
                     </button>
                     
                     <button type="button" class="botonDashboardDenegar">
                           <?= $this->Html->link(__('Reject'), ['controller' => 'Dashboard', 'action' => 'denied', $proCurso->PRO_CURSO, $Query['segUsuario']['SEG_USUARIO']], ['style' => 'color:white;']) ?> 
                     </button>
                     
                     <button type="button" class="botonDashboardAceptarConsultar">
                           <?= $this->Html->link(__('Export PDF'), ['controller' => 'Dashboard', 'action' => 'exportPDF'], ['style' => 'color:white;']) ?> 
                     </button>
                  </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
 </table>
  <a href=".."> <button type="button" class="botonCancelar"><?=__('Return')?></button> </a>
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