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
        <!-- Se especifica que el controlador sea curso para evitar que el nombre de la tabla aparezca en la url-->
        <?= $this->Html->link(__('Add Course'), ['controller' => 'curso', 'action' => 'add'], ['style' => 'color:white;']) ?>   
    </button>
    
 <!-- Shows a placebar in case that there are a lot of data to display -->
 <div class="container-fluid table-responsive">
 <table cellpadding="0" cellspacing="0" class="gridIndex table table-bordered">
        <thead>
            <tr>
                <!-- Puts each field of the table in the grid -->
                <th scope="col"><?= $this->Paginator->sort('Course ID') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Course name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Start date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Final date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Last enrollment date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Academic charge') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Language') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Location') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Active') ?></th>
                <!--<th scope="col"><?= $this->Paginator->sort('PRO_PROGRAMA') ?></th>
                <th scope="col"><?= $this->Paginator->sort('SEG_USUARIO') ?></th>-->
                <th scope="col" class="actions"><?= __('') ?></th>
                <th scope="col" class="actions"><?= __('') ?></th>
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
                     $proCurso->FECHA_INICIO = date("Y-m-d", strtotime($proCurso->FECHA_INICIO)); 
                     $proCurso->FECHA_FINALIZACION = date("Y-m-d", strtotime($proCurso->FECHA_FINALIZACION));
                     $proCurso->FECHA_LIMITE = date("Y-m-d", strtotime($proCurso->FECHA_LIMITE));          
                ?>
                <td><?= h($proCurso->FECHA_INICIO) ?></td>
                <td><?= h($proCurso->FECHA_FINALIZACION) ?></td>
                <td><?= h($proCurso->FECHA_LIMITE) ?></td>
                <td><?= $this->Number->format($proCurso->CREDITOS) ?></td>
                <td><?= h($proCurso->IDIOMA) ?></td>
                <td><?= h($proCurso->LOCACION) ?></td>
                <td><?= h($proCurso->ACTIVO) ?></td>
                 <!--<td><?= h($proCurso->PRO_PROGRAMA) ?></td>
                <td><?= h($proCurso->SEG_USUARIO) ?></td>-->
                <td class="actions">
                <!-- Links the view button to the course-->
                <button type="button" class="botonAccion btn btn-xs"> 
                        <?= $this->Html->link(__('View'), ['controller' => 'curso', 'action' => 'view', $proCurso->PRO_CURSO]) ?>    
                    </button>
                </td>
                <td class="actions">

                <!-- Links the edit button to the course-->
                <button type="button" class="botonAccion btn btn-xs"> 
                        <?= $this->Html->link(__('Edit'), ['controller' => 'curso', 'action' => 'edit', $proCurso->PRO_CURSO]) ?>    
                    </button>
                </td>

                <!-- Links the delete button to the course-->
                <td>
                   <button type="button" class="botonAccion btn btn-xs"> 
                       <?= $this->Form->postLink(__('Delete'), ['controller' => 'curso', 'action' => 'delete', $proCurso->PRO_CURSO], ['confirm' => __('Do you want to delete the course {0}?', $proCurso->PRO_CURSO)]) ?>
                    </button>
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
