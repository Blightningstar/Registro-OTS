<?php
/**
 * @author Jason Zamora Trejos
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProCurso[]|\Cake\Collection\CollectionInterface $proCurso
 */
?>

<!--This makes the container able to adapt to diffent resolutions-->
<div class="DashboardAdministradorCurso index large-9 medium-8 columns content container-fluid">
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

            <tr>
               <!--Uses a form as wrapper to contain a checkbox which will modify active value of the course.
                Better than use hidden inputs, from a security's perspective.-->
                <td></td>
                <td class="actions">
                        <!-- Links to view of the form of a student in particular-->
                     <button type="button" class="botonDashboardAceptarConsultar">
                           <?= $this->Html->link(__('Review'), ['controller' => 'Dashboard'], ['style' => 'color:white;']) ?>
                     </button>
                </td>
                <td></td>
                <td></td>
                <td class="actions">
                <!-- Links the view button to the course-->
                     <button type="button" class="botonDashboardAceptarConsultar">
                           <?= $this->Html->link(__('Approve'), ['controller' => 'Dashboard'], ['style' => 'color:white;']) ?> 
                     </button>
                     
                     <button type="button" class="botonDashboardDenegar">
                           <?= $this->Html->link(__('Reject'), ['controller' => 'Dashboard'], ['style' => 'color:white;']) ?> 
                     </button>
                  </td>
            </tr>
        </tbody>
 </table>
</div>
