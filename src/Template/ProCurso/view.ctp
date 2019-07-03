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
    <br>
        <div>
            <p class= "field"> <?= __('Course ID:') ?></p>
            <p class= "value"> <?= $proCurso['SIGLA'] ?></p>
            <hr class= "separator">
        </div>
        
        <div>
            <p class= "field"> <?= __('Course Name:') ?></p>
            <p class= "value"> <?= $proCurso['NOMBRE'] ?></p>
            <hr class= "separator">
        </div>
        
        <div>
            <p class= "field"> <?= __('Parent Program:') ?></p>
            <p class= "value"> <?= $proCurso['PRO_PROGRAMA'] ?></p>
            <hr class= "separator">
        </div>
        
        <div>
            <p class= "field"> <?= __('Administrator:') ?></p>
            <p class= "value"> <?= $queryUsuario[0]['NOMBRE_USUARIO'] ?></p>
            <hr class= "separator">
        </div>
        
        <div>
            <p class= "field"> <?= __('Start date:') ?></p>
            <p class= "value"> <?= $proCurso['FECHA_INICIO'] = date("m/d/Y", strtotime($proCurso['FECHA_INICIO'])) ?></p>
            <hr class= "separator">
        </div>
        
        <div>
            <p class= "field"> <?= __('Final date:') ?></p>
            <p class= "value"> <?= $proCurso['FECHA_FINALIZACION'] = date("m/d/Y", strtotime($proCurso['FECHA_FINALIZACION'])); ?></p>
            <hr class= "separator">
        </div>
        
        <div>
            <p class= "field"> <?= __('Last enrollment date:') ?></p>
            <p class= "value"> <?= $proCurso['FECHA_LIMITE'] = date("m/d/Y", strtotime($proCurso['FECHA_LIMITE'])); ?></p>
            <hr class= "separator">
        </div>
        
        <div>
            <p class= "field"> <?= __('Academic Charge:') ?></p>
            <p class= "value"> <?= $proCurso['CREDITOS'] ?></p>
            <hr class= "separator">
        </div>
        
        <div>
            <p class= "field"> <?= __('Language:') ?></p>
            <p class= "value"> <?= $proCurso['IDIOMA'] ?></p>
            <hr class= "separator">
        </div>
        
        <div>
            <p class= "field"> <?= __('Location:') ?></p>
            <p class= "value"> <?= $proCurso['LOCACION'] ?></p>
            <hr class= "separator">
        </div>
        
        <div style="<?php echo $desplegar==0 ? 'display: none' : '' ?>">
            <p class= "field"> <?= __('Form:') ?></p>
            <p class= "value"> <?= $queryFormulario[0]['NOMBRE'] ?></p>
            <hr class= "separator">
        </div>
 </fieldset>
 <a href="/Registro-OTS/curso/<?php echo $program_id ?>"> <button type="button" class="botonCancelar"> <?= __('Return') ?> </button> </a>
    <?= $this->Form->end() ?>
</div>
