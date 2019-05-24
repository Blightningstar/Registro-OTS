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
      <p class = "subtitulo"> Administration of application in your courses </p>
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
</div>
