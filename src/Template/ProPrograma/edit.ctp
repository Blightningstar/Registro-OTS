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
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $proPrograma->PRO_PROGRAMA],
                ['confirm' => __('Are you sure you want to delete # {0}?', $proPrograma->PRO_PROGRAMA)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Pro Programa'), ['action' => 'index']) ?></li>
    </ul>
</nav>
 -->
    <fieldset>
        <legend class = "titulo">Administración de Programas<br></br>
        <legend class = "subtitulo">Modificando programa: <?= h($proPrograma->PRO_PROGRAMA) ?><br></br></legend>
    </fieldset>

<div class="proPrograma form large-9 medium-8 columns content">
    <?= $this->Form->create($proPrograma) ?>
    <fieldset>
        <?php
            echo $this->Form->control('NOMBRE', ['label' => 'Nombre']);
            echo $this->Form->control('ACTIVO', ['label' => 'Activo']);
        ?>
    </fieldset>
    <a href="/Registro-OTS/programa/"> <button type="button" class="botonCancelar">Cancelar</button> </a>
    <?= $this->Form->button(__('Aceptar'), ['class' => 'botonAceptar'], ['label' => 'Aceptar']) ?>
    <?= $this->Form->end() ?>
</div>
