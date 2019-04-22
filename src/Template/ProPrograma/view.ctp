<?php
/**
 * @author Anyelo Mijael Lobo Cheloukhin
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProPrograma $proPrograma
 */
?>

<fieldset>
    <legend class = "titulo">Program Administration<br></br>
    <p class = "subtitulo">Showing program: <?= h($proPrograma->NOMBRE) ?></p>
    </legend>
</fieldset>

<div class="proPrograma form large-9 medium-8 columns content">
    <?= $this->Form->create($proPrograma) ?>
    <fieldset>
        <?php
            echo $this->Form->control('NOMBRE', ['label' => 'Name']);
            echo $this->Form->control('ACTIVO', ['label' => 'Active / Inactive']);
        ?>
    </fieldset>
    <a href=".."> <button type="button" class="botonCancelar">Cancel</button> </a>
    <?= $this->Form->end() ?>
</div>