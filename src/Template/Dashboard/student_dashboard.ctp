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
   <table cellpadding="0" cellspacing="0" class="gridIndex table table-bordered">
        <thead>
            <tr id="headTr">
                <!-- Puts each field of the table in the grid -->
                <th scope="col"><?= $this->Paginator->sort('Course') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Details') ?></th>
                <th scope="col" class="actions"><?= __('') ?></th>
            </tr>
            </thead>
        <tbody>
            <?php foreach($user_applications  as $application): ?>
            <tr>
                <td><? h($user_applications["PRO_CURSO"]) ?></td>
                
                    <!-- Details will depend of application's status -->
                    <?
                    $application_status = 1;
                    
                    $details = "";
                    $buttonText = "";
                    $link = "";

                    switch($application_status)
                    {
                        case 1: // Incomplete application
                            $details = "This application is incomplete.";
                            $buttonText = "Complete Application";
                            break;
                        case 2: //Pending of review application
                            $details = "This application is pending of review.";
                            $buttonText = "View Application";
                            break;
                        case 3: //Rejected application
                            $details = "This application was rejected.";
                            $buttonText = "View Application";
                            break;
                        case 4:  //Approved application
                            $details = "This application was accepted.";
                            $buttonText = "View Application";
                            break;
                    }
                    ?>
                <td><? h($user_applications["PRO_CURSO"]) ?></td>
                <td></td>

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
