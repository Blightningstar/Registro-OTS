<?php
/**
 * @author Anyelo Mijael Lobo Cheloukhin
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProPrograma $proPrograma
 */
?>
<div class="proPrograma index large-9 medium-8 columns content container-fluid">
    <fieldset>
        <legend class = "titulo">Program Administration<br></br>
        <p class = "subtitulo">Showing program</p>
        </legend>
    </fieldset>

    <div class="proPrograma form large-9 medium-8 columns content">
        <?= $this->Form->create($proPrograma) ?>
        <fieldset>
            <?php
                echo $this->Form->control('NOMBRE', ['label' => _('Program Name'), 'disabled']);
            ?>
        </fieldset>
        <a href=".."> <button type="button" class="botonCancelar">Cancel</button> </a>
        <?= $this->Form->end() ?>
    </div>
</div>