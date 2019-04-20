<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SegUsuario $segUsuario
 */
?>

<div class="segUsuario form large-9 medium-8 columns content">
    <?= $this->Form->create($segUsuario) ?>
    <fieldset>
        <legend class = "titulo"><?= __('Register') ?>
        <br></br>
        <p class = "subtitulo"> <?= __('Create a new student account.') ?> </p>
    </legend>
        
        <br>
        <?php
            echo $this->Form->control('NOMBRE', ['label' => __('Name') ]);
            echo $this->Form->control('APELLIDO_1', ['label' => __('Lastname 1')]);
            echo $this->Form->control('APELLIDO_2', ['label' => __('Lastname 2')]);
            echo $this->Form->control('NOMBRE_USUARIO', ['label' => __('Username')]);
            echo $this->Form->control('CORREO', ['label' => __('E-mail')]);
            echo $this->Form->control('NUMERO_TELEFONO', ['label' => __('Telephone'), 'pattern' => "[/+]?[0-9\-\s]+", 'title' => 'Error: Put a valid number. You can use + - or spaces']);
            echo $this->Form->control('NACIONALIDAD', ['label' => __('Country')]);


        ?>
    </fieldset>
    <br>
    <a href="."> <button type="button" class="botonCancelar"> <?= __('Cancel') ?> </button> </a>
    <?= $this->Form->button(__('Aceptar'), ['class' => 'botonAceptar'], ['label' => 'Acept']) ?>
    <?= $this->Form->end() ?>
</div>
