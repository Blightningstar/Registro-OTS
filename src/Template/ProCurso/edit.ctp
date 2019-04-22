<?php
/**
 * @author Jason Zamora Trejos
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProCurso $proCurso
 */
?>

<div class="proCurso form large-9 medium-8 columns content">
    <?= $this->Form->create($proCurso) ?>
    <?=$this->Form->create('ProCurso',['type' => 'get']);?>
<fieldset>
   <legend class = "titulo"><?= __('Edit Course') ?>
        <br></br>
        <p class = "subtitulo"> <?=__('Edit the information of a course') ?> </p>
   </legend>
   <br>
        <?php
           //Converts the format of the dates in one that the database can save it.
           $proCurso->FECHA_INICIO = date("Y-m-d", strtotime($proCurso->FECHA_INICIO)); 
           $proCurso->FECHA_FINALIZACION = date("Y-m-d", strtotime($proCurso->FECHA_FINALIZACION));
           $proCurso->FECHA_LIMITE = date("Y-m-d", strtotime($proCurso->FECHA_LIMITE));
                 
           //Displays the data of a course.    
           echo $this->Form->control('PRO_CURSO', [
               'label' => _('Course ID'),
               'value' => $proCurso ['PRO_CURSO'],
               'pattern' => '[a-zA-Z]{2}\-[0-9]{4}', 
               'placeholder' => 'e.g. "CI-2020"'
            ]);
            echo $this->Form->control('NOMBRE', ['label' => _('Course Name'),'value' => $proCurso ['NOMBRE']]);
            echo $this->Form->control('FECHA_INICIO', ['label' => _('Start date'), 'class'=>'datepicker','value' => $proCurso ['FECHA_INICIO']]);
            echo $this->Form->control('FECHA_FINALIZACION', ['label' => _('Final date'), 'class'=>'datepicker', 'value' => $proCurso ['FECHA_FINALIZACION']]);
            echo $this->Form->control('FECHA_LIMITE', ['label' => _('Last enrollment date'), 'class'=>'datepicker','value' => $proCurso ['FECHA_LIMITE']]);
            echo $this->Form->control('CREDITOS', [
               'label' => _('Academic charge'),
               'type' => 'number',
               'value' => $proCurso ['CREDITOS'] ,
               'pattern'=> '^(?:[0-9]|0[0-9]|1[0-9]|20)$', 
               'placeholder'=> 'number from 1 to 20'
            ]);
            echo $this->Form->control('IDIOMA', ['label' => _('Language'), 'value' => $proCurso ['IDIOMA'], 'placeholder'=> 'Language of the course']);
            echo $this->Form->control('LOCACION', ['label' => _('Location'), 'value' => $proCurso ['LOCACION'], 'placeholder'=> 'Location of the course']);
            /*echo $this->Form->input('PRO_PROGRAMA', ['label' => _('Program'), 'type' => 'select', 'options' => array($vlc_DsPrograma)]);
            echo $this->Form->control('SEG_USUARIO', ['label' => _('Username')]);*/
        ?>
    </fieldset>
    <br>
    <a href="."> <button type="button" class="botonCancelar"> <?= __('Cancel') ?> </button> </a>
    <?= $this->Form->button(__('Submit'), ['class' => 'botonAceptar'], ['label' => __('Submit')]) ?>
    <?= $this->Form->end() ?>
</div>

<!-- Everything necessary to implement datepicker in the add view -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$( function() {
    $( ".datepicker" ).datepicker({'dateFormat':'yy-mm-dd', changeMonth: true, changeYear: true});
  } );
</script>