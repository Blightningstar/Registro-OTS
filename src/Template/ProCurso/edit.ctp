<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProCurso $proCurso
 */
?>

<div class="proCurso form large-9 medium-8 columns content">
    <?= $this->Form->create($proCurso) ?>
    <fieldset>
        <legend><?= __('Edit Pro Curso') ?></legend>
        <?php
            echo $this->Form->control('NOMBRE');
            echo $this->Form->control('FECHA_INICIO');
            echo $this->Form->control('FECHA_FINALIZACION');
            echo $this->Form->control('FECHA_LIMITE');
            echo $this->Form->control('CREDITOS');
            echo $this->Form->control('IDIOMA');
            echo $this->Form->control('LOCACION');
            echo $this->Form->control('ACTIVO');
            echo $this->Form->control('PRO_PROGRAMA');
            echo $this->Form->control('SEG_USUARIO');
            echo $this->Form->control('SOL_FORMULARIO');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
