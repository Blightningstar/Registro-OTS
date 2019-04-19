<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SegUsuario $segUsuario
 */
?>


<div class="segUsuario form large-9 medium-8 columns content">
    <?= $this->Form->create($segUsuario) ?>
    <fieldset>
        <legend class = "titulo"><?= __('Profile Edit') ?>
        <br></br>
        <p class = "subtitulo"> <?=__('Edit your personal information') ?> </p>
    </legend>
        <?php
            echo $this->Form->control('NOMBRE', ['label' => __('Name')]);
            echo $this->Form->control('APELLIDO_1', ['label' => __('Lastname 1')]); 
            echo $this->Form->control('APELLIDO_2', ['label' => __('Lastname 2')] );
            echo $this->Form->control('CORREO', ['label' => __('E-mail')]);
            echo $this->Form->control('NUMERO_TELEFONO', ['label' => __('Telephone')]);
            echo $this->Form->control('NACIONALIDAD',  ['label' => __('Country')]);
        ?>
    </fieldset>
    <br><br>
    <a href="./profile-view"> <button type="button" class="botonCancelar"> <?= __('Cancel') ?> </button> </a>
    <?= $this->Form->button(__('Aceptar'), ['class' => 'botonAceptar'], ['label' => 'Acept']) ?>


    
    <?= $this->Form->end() ?>
</div>
