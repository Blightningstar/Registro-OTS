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
      <p class = "subtitulo"> <?=__('Application Information') ?></p>
   </legend>
   <br>
   
   <div class="row">
      <label style="margin-left:30px;" ><?= __('Search: ') ?></label>
      <input type="text" id="queryTextbox" style="width:50%;margin-left:20px;"> 
   </div>
        <thead>
            <tr id="headTr">
                <!-- Puts each field of the table in the grid -->
                <th scope="col"><?= $this->Paginator->sort('Student\'s name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Form Completion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('State') ?></th>
                <th scope="col" class="actions"><?= __('') ?></th>
                <th scope="col"><?= $this->Paginator->sort('') ?></th>
            </tr>
        </thead>
</div>
