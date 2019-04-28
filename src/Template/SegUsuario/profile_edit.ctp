<?php
/**
 * @author Esteban Rojas
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
            echo $this->Form->control('CORREO', ['label' => __('E-mail'),  'pattern' => '[0-9A-Za-z^@]+@+[0-9A-Za-z^\.]+\.+[0-9A-Za-z^@]+', 'title' => __("Error: E-mail invalid")]);
            echo $this->Form->control('NUMERO_TELEFONO', ['label' => __('Telephone'),'pattern' => "[/+]?[0-9\-\s]+", 'title' => 'Error: Put a valid number. You can use + - or spaces']);
            echo $this->element('countrySelectOptions');
        ?>
    </fieldset>
    <br><br>
    <a href="./profile-view"> <button type="button" class="botonCancelar"> <?= __('Cancel') ?> </button> </a>
    <?= $this->Form->button(__('Accept'), ['class' => 'botonAceptar'], ['label' => 'Acept']) ?>


    
    <?= $this->Form->end() ?>
</div>
