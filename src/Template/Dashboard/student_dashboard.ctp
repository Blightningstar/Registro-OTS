<?php
/**
 * @author Esteban Rojas Solis
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProCurso[]|\Cake\Collection\CollectionInterface $proCurso
 */

?>

<!--This makes the container able to adapt to diffent resolutions-->
<div class="DashboardAdministrador index large-9 medium-8 columns content container-fluid">
    <!--Title, subtitle and a line to separate-->
<fieldset>
      <legend class = "titulo"><?= __('Student Dashboard') ?>
      <br></br>
      <p class = "subtitulo"> <?=__('Application Information') ?></p>
   </legend>
   <br>
   
   <div class="row">
      <label style="margin-left:30px;" ><?= __('Search: ') ?></label>
      <input type="text" id="queryTextbox" style="width:50%;margin-left:20px;"> 
   </div>
   <div class="container-fluid table-responsive">
   <table cellpadding="0" cellspacing="0" class="gridIndex table table-bordered table-striped">
        <thead>
            <tr id="headTr">
                <!-- Puts each field of the table in the grid -->
                <th scope="col"><?= $this->Paginator->sort('Course') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Details') ?></th>
                <th scope="col" class="actions"><?= __('Action') ?></th>
            </tr>
            </thead>
        <tbody>
            <?php foreach($user_applications  as $application):?>
            <tr >
                <td style="vertical-align:middle;"><?= h($application["NOMBRE"]) ?></td>
                
                    <!-- Details will depend of application's status -->
                    <?php
                    
                    $details = "";
                    $buttonText = "";
					$link = [];
					$link["controller"] = 'SolSolicitud';
					$link["action"] = 'view/' .  $application["PRO_CURSO"];
                    $result =  str_replace(" ","",$application["RESULTADO"]);

                    switch($result)
                    {
                        case "Proceso": // Incomplete application
                            $details = "The application to course " . $application["NOMBRE"] ." is incomplete.";
                            $buttonText = "Complete Application";
							$link["action"] = 'edit/'  .  $application["PRO_CURSO"];
                            break;
                        case "Completo": //Pending of review application
                            $details = "The application to course " . $application["NOMBRE"] . " is pending of review.";
                            $buttonText = "View Application";							
                            break;
                        case "Rechazado": //Rejected application
                            $details = "The application to course " . $application["NOMBRE"] . " was rejected.";
                            $buttonText = "View Application";
                            break;
                        case "Aceptado":  //Approved application
                            $details = "The application to course " . $application["NOMBRE"] . " was accepted.";
                            $buttonText = "View Application";
                            break;
                    }?>
                <td style="vertical-align:middle;"><?= $details ?></td>
                <td style="vertical-align:middle;">
                    <button type="button" class="botonAgregar">
					<?= $this->Html->link(__($buttonText), $link, ['style' => 'color:white;']) ?>   
                </td>

            </tr>
            <?php endforeach;?>  

        </tbody>
    </table>
    </div>
    </fieldset>
    <!--
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('First')) ?>
            <?= $this->Paginator->prev('< ' . __('Previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('Next') . ' >') ?>
            <?= $this->Paginator->last(__('Last') . ' >>') ?>
        </ul>
        <?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} register(s) of {{count}}')]) ?></p>
    </div>-->
</div>
</div>

<?= $this->Html->script('scriptIndex.js'); ?>
