<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProCurso $proCurso
 */
?>

<div class="proCurso view large-9 medium-8 columns content">
    <?= $this->Form->create($proCurso) ?>
    <fieldset>
    <legend class = "titulo"><?= __('View Course') ?>
        <br></br>
        <p class = "subtitulo"><?=__('View the information of a course')?></p>
    </legend>
    <?php
            echo $this->Form->control('pro_curso', ['label' => _('Course ID'), 'readonly']);
            echo $this->Form->control('NOMBRE', ['label' => _('Course Name'), 'readonly']);
            echo $this->Form->control('FECHA_INICIO', ['label' => _('Start date'), 'disabled']);
            echo $this->Form->control('FECHA_FINALIZACION', ['label' => _('Final date'), 'disabled']);
            echo $this->Form->control('FECHA_LIMITE', ['label' => _('Last enrollment date'), 'disabled']);
            echo $this->Form->control('CREDITOS', ['label' => _('Academic charge'),'type' => 'number', 'readonly']);
            echo $this->Form->control('IDIOMA', ['label' => _('Language'), 'disabled']);
            echo $this->Form->control('LOCACION', ['label' => _('Location'), 'readonly']);
            //echo $this->Form->control('ACTIVO', ['label' => _(' Active'), 'type' => 'checkbox']);
            /*echo $this->Form->input('PRO_PROGRAMA', ['label' => _('Program'), 'type' => 'select', 'options' => array($vlc_DsPrograma)]);
            echo $this->Form->control('SEG_USUARIO', ['label' => _('Username')]);
            echo $this->Form->control('SOL_FORMULARIO', ['label' => _('Form')]);*/
    ?>
 </fieldset>
    <a href=".."> <button type="button" class="botonCancelar"><?=__('Return')?></button> </a>
    <?= $this->Form->end() ?>
</div>
