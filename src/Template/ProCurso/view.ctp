<?php
/**
 * @author Jason Zamora Trejos
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
            //Converts the format of the dates in one that the database can save it.
            $proCurso->FECHA_INICIO = date("m/d/Y", strtotime($proCurso->FECHA_INICIO)); 
            $proCurso->FECHA_FINALIZACION = date("m/d/Y", strtotime($proCurso->FECHA_FINALIZACION));
            $proCurso->FECHA_LIMITE = date("m/d/Y", strtotime($proCurso->FECHA_LIMITE));          
            
            echo $this->Form->control('PRO_CURSO', ['label' => _('Course ID'), 'disabled', 'value' => $proCurso['PRO_CURSO']]);
            echo $this->Form->control('NOMBRE', ['label' => _('Course Name'), 'disabled','value' => $proCurso['NOMBRE']]);
            echo $this->Form->control('FECHA_INICIO', ['label' => _('Start date'), 'disabled','value' => $proCurso['FECHA_INICIO']]);
            echo $this->Form->control('FECHA_FINALIZACION', ['label' => _('Final date'), 'disabled','value' => $proCurso['FECHA_FINALIZACION']]);
            echo $this->Form->control('FECHA_LIMITE', ['label' => _('Last enrollment date'), 'disabled','value' => $proCurso['FECHA_LIMITE']]);
            echo $this->Form->control('CREDITOS', ['label' => _('Academic charge'),'type' => 'number', 'disabled','value' => $proCurso['CREDITOS']]);
            echo $this->Form->control('IDIOMA', ['label' => _('Language'), 'disabled','value' => $proCurso['IDIOMA']]);
            echo $this->Form->control('LOCACION', ['label' => _('Location'), 'disabled','value' => $proCurso['LOCACION']]);
    ?>
 </fieldset>
    <a href=".."> <button type="button" class="botonCancelar"><?=__('Return')?></button> </a>
    <?= $this->Form->end() ?>
</div>
