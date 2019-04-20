<?php
/**
 * @author Anyelo Mijael Lobo Cheloukhin
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProPrograma $proPrograma
 */
?>
<!-- <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Pro Programa'), ['action' => 'index']) ?></li>
    </ul>
</nav> -->

<div class="proPrograma form large-9 medium-8 columns content">
    <?= $this->Form->create($proPrograma) ?>
    <fieldset>
        <legend class = "titulo">Administración de Programas<br></br>
        <legend class = "subtitulo">Agragar programa<br></br></legend>
    </fieldset> 
        <?php
            // echo $this->Form->control('PRO_PROGRAMA', array('type' => 'text'));
            echo $this->Form->control('PRO_PROGRAMA', ['label' => 'Nombre']);
            echo $this->Form->control('NOMBRE',  ['label' => 'Nombre']);
            echo $this->Form->control('ACTIVO',  ['label' => 'Activo']);
        ?>

    <a href="."> <button type="button" class="botonCancelar">Cancelar</button> </a>
    <?= $this->Form->button(__('Aceptar'), ['class' => 'botonAceptar'], ['label' => 'Aceptar']) ?>
    <?= $this->Form->end() ?>
</div>