<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProCurso $proCurso
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $proCurso->PRO_CURSO],
                ['confirm' => __('Are you sure you want to delete # {0}?', $proCurso->PRO_CURSO)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Pro Curso'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="proCurso form large-9 medium-8 columns content">
    <?= $this->Form->create($proCurso) ?>
    <fieldset>
        <legend><?= __('Edit Pro Curso') ?></legend>
        <?php
            echo $this->Form->control('NOMBRE');
            echo $this->Form->control('FECHA_INICIO', ['empty' => true]);
            echo $this->Form->control('FECHA_FINALIZACION', ['empty' => true]);
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
