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
        <legend class = "titulo"><?= __('Create a Course') ?>
        <br></br>
        <p class = "subtitulo"><?=__('Add a course to the system.')?></p>
    </legend>
    
        <br>
        <?php
            echo $this->Form->control('NOMBRE', ['label' => _('Course Name')]);
            echo $this->Form->control('FECHA_INICIO', ['label' => _('Start date'), 'class'=>'datepicker']);
            echo $this->Form->control('FECHA_FINALIZACION', ['label' => _('Final date'), 'class'=>'datepicker']);
            echo $this->Form->control('FECHA_LIMITE', ['label' => _('Last enrollment date'), 'class'=>'datepicker']);
            echo $this->Form->control('CREDITOS', [
               'label' => _('Academic charge'),
               'type' => 'number',
               'min' => 0,
               'value' => 0 ,
               'pattern'=> '^(?:[0-9]|0[0-9]|10)$', 
               'placeholder'=> 'number from 1 to 10'
            ]);
            echo $this->Form->control('IDIOMA', ['label' => _('Language'), 'placeholder'=> 'Language of the course','pattern' => '^[a-zA-Z]*$']);
            echo $this->Form->control('LOCACION', ['label' => _('Location'), 'placeholder'=> 'Location of the course','options' => array('Costa Rica', __('South Africa'))]);
            echo $this->Form->control('PRO_PROGRAMA', ['label' => _('Parent Program'), 'options' => $lo_vector_Programa]);
        ?>
    </fieldset>
    <br>
    <a href="."> <button type="button" class="botonCancelar"> <?= __('Cancel') ?> </button> </a>
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


