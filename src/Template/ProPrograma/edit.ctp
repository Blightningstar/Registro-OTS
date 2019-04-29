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
        <p class = "subtitulo">Editing program</p>
        </legend>
    </fieldset>

    <div class="proPrograma form large-9 medium-8 columns content">
        <?= $this->Form->create($proPrograma) ?>
        <fieldset>
            <?php
                echo $this->Form->control('NOMBRE', ['label' => 'Nombre']);
            ?>
        </fieldset>
        <a href="/Registro-OTS/programa/"> <button type="button" class="botonCancelar">CANCEL</button> </a>
        <?= $this->Form->button(__('ACCEPT'), ['class' => 'botonAceptar']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>