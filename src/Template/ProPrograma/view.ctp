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

    <div>
        <p class= "field"> <?= __('ID:') ?></p>
        <p class= "value"> <?= $proPrograma["PRO_PROGRAMA"] ?></p>
        <hr class= "separator">
    </div>

    <div>
        <p class= "field"> <?= __('Program Name:') ?></p>
        <p class= "value"> <?= $proPrograma["NOMBRE"] ?></p>
        <hr class= "separator">
    </div>

    <a href=".."> <button type="button" class="botonCancelar">Cancel</button> </a>
    <?= $this->Form->end() ?>

</div>