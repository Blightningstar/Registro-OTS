<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SegUsuario $segUsuario
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $segUsuario->SEG_USUARIO],
                ['confirm' => __('Are you sure you want to delete # {0}?', $segUsuario->SEG_USUARIO)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Seg Usuario'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="segUsuario form large-9 medium-8 columns content">
    <?= $this->Form->create($segUsuario) ?>
    <fieldset>
        <legend><?= __('Edit Seg Usuario') ?></legend>
        <?php
            echo $this->Form->control('NOMBRE');
            echo $this->Form->control('APELLIDO_1');
            echo $this->Form->control('APELLIDO_2');
            echo $this->Form->control('NOMBRE_USUARIO');
            echo $this->Form->control('CONTRASEÑA');
            echo $this->Form->control('CORREO');
            echo $this->Form->control('NUMERO_TELEFONO');
            echo $this->Form->control('NACIONALIDAD');
            echo $this->Form->control('ACTIVO');
            echo $this->Form->control('ESTUDIANTE');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
