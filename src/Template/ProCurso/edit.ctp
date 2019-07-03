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
           //Displays the data of a course.    
            //This is needed so the date is display in the same format as the rest
            $proCurso['FECHA_LIMITE'] = date("m/d/Y", strtotime($proCurso['FECHA_LIMITE']));
            $proCurso['FECHA_INICIO'] = date("m/d/Y", strtotime($proCurso['FECHA_INICIO']));
            $proCurso['FECHA_FINALIZACION'] = date("m/d/Y", strtotime($proCurso['FECHA_FINALIZACION'])); 
                  
            echo $this->Form->control('NOMBRE', ['label' => _('Course Name'),'value' => $proCurso ['NOMBRE']]);
            echo $this->Form->control('FECHA_INICIO', ['label' => _('Start date'), 'class'=>'datepicker','value' => $proCurso ['FECHA_INICIO']]);
            echo $this->Form->control('FECHA_FINALIZACION', ['label' => _('Final date'), 'class'=>'datepicker', 'value' => $proCurso ['FECHA_FINALIZACION']]);
            echo $this->Form->control('FECHA_LIMITE', ['label' => _('Last enrollment date'), 'class'=>'datepicker','value' => $proCurso ['FECHA_LIMITE']]);
            echo $this->Form->control('CREDITOS', [
               'label' => _('Academic charge'),
               'type' => 'number',
               'min' => 0,
               'value' => $proCurso ['CREDITOS'] ,
               'pattern'=> '^(?:[0-9]|0[0-9]|10)$', 
               'placeholder'=> 'number from 1 to 10'
            ]);
            echo $this->Form->control('IDIOMA', ['label' => _('Language'), 'value' => $proCurso ['IDIOMA'], 'placeholder'=> 'Language of the course','pattern' => '^[a-zA-Z]*$']);
            echo $this->Form->control('LOCACION', ['label' => _('Location'), 'value' => $proCurso ['LOCACION'], 'placeholder'=> 'Location of the course', 'options' => array('Costa Rica', __('South Africa'))]);
            echo $this->Form->control('PRO_PROGRAMA', ['label' => _('Parent Program'), 'options' => $lo_vector_Programa]);
            echo $this->Form->control('SOL_FORMULARIO', ['label' => _('Form'), 'options' => $lo_vector_Formulario]);
        ?>
    </fieldset>
    <br>
    <a href="/Registro-OTS/curso/<?php echo $program_id ?>"> <button type="button" class="botonCancelar"> <?= __('Cancel') ?> </button> </a>
    <?= $this->Form->button(__('Confirm'), ['class' => 'botonAceptar'], ['label' => __('Confirm')]) ?>
    <?= $this->Form->end() ?>
</div>

<!-- Everything necessary to implement datepicker in the add view -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$( function() {
    $( ".datepicker" ).datepicker({'dateFormat':'mm/dd/yy', changeMonth: true, changeYear: true});
  } );
</script>
