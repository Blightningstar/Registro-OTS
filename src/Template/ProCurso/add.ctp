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
            echo $this->Form->control('PRO_CURSO', ['label' => _('Course ID')]);
            echo $this->Form->control('NOMBRE', ['label' => _('Course Name')]);
            echo $this->Form->control('FECHA_INICIO', ['label' => _('Start date'), 'class'=>'datepicker']);
            echo $this->Form->control('FECHA_FINALIZACION', ['label' => _('Final date'), 'class'=>'datepicker']);
            echo $this->Form->control('FECHA_LIMITE', ['label' => _('Last enrollment date'), 'class'=>'datepicker']);
            echo $this->Form->control('CREDITOS', ['label' => _('Academic charge'),'type' => 'number','value' => 0 ,'min'=> 0, 'max'=> 20]);
            echo $this->Form->control('IDIOMA', ['label' => _('Language')]);
            echo $this->Form->control('LOCACION', ['label' => _('Location')]);
            /*echo $this->Form->control('ACTIVO', ['label' => _(' Active'), 'type' => 'checkbox']);*/
            /*echo $this->Form->input('PRO_PROGRAMA', ['label' => _('Program'), 'type' => 'select', 'options' => $vlc_DsPrograma]);
            echo $this->Form->control('SEG_USUARIO', ['label' => _('Username')]);
            echo $this->Form->control('SOL_FORMULARIO', ['label' => _('Form')]);*/
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
    $( ".datepicker" ).datepicker({'dateFormat':'dd/mm/yy', changeMonth: true, changeYear: true});
  } );
</script>