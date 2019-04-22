<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProCurso $proCurso
 */
?>

<div class="proCurso view large-9 medium-8 columns content">
    <?= $this->Form->create($proCurso) ?>
    <?=$this->Form->create('ProCurso',['type' => 'get']);?>
    <fieldset>
    <legend class = "titulo"><?= __('View Course') ?>
        <br></br>
        <p class = "subtitulo"><?=__('View the information of a course')?></p>
    </legend>
    <?php
    
            echo $this->Form->control('PRO_CURSO', ['label' => _('Course ID'), 'disabled', 'value' => $proCurso['PRO_CURSO']]);
            echo $this->Form->control('NOMBRE', ['label' => _('Course Name'), 'disabled','value' => $proCurso['NOMBRE']]);
            echo $this->Form->control('FECHA_INICIO', ['label' => _('Start date'), 'disabled','value' => $proCurso['FECHA_INICIO']]);
            echo $this->Form->control('FECHA_FINALIZACION', ['label' => _('Final date'), 'disabled','value' => $proCurso['FECHA_FINALIZACION']]);
            echo $this->Form->control('FECHA_LIMITE', ['label' => _('Last enrollment date'), 'disabled','value' => $proCurso['FECHA_LIMITE']]);
            echo $this->Form->control('CREDITOS', ['label' => _('Academic charge'),'type' => 'number', 'disabled','value' => $proCurso['CREDITOS']]);
            echo $this->Form->control('IDIOMA', ['label' => _('Language'), 'disabled','value' => $proCurso['IDIOMA']]);
            echo $this->Form->control('LOCACION', ['label' => _('Location'), 'disabled','value' => $proCurso['LOCACION']]);
            //echo $this->Form->control('ACTIVO', ['label' => _(' Active'), 'type' => 'checkbox']);
            /*echo $this->Form->input('PRO_PROGRAMA', ['label' => _('Program'), 'type' => 'select', 'options' => array($vlc_DsPrograma)]);
            echo $this->Form->control('SEG_USUARIO', ['label' => _('Username')]);
            echo $this->Form->control('SOL_FORMULARIO', ['label' => _('Form')]);*/
    ?>
 </fieldset>
    <a href=".."> <button type="button" class="botonCancelar"><?=__('Return')?></button> </a>
    <?= $this->Form->end() ?>
</div>
