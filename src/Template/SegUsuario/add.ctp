<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SegUsuario $segUsuario
 */
?>

<div class="segUsuario form large-9 medium-8 columns content">
    <?= $this->Form->create($segUsuario) ?>
    <fieldset>
        <legend class = "titulo"><?= __('Agregar Usuario') ?>
        <br></br>
        <p class = "subtitulo"> <?= __('Agrega un usuario al sistema.') ?> </p>
    </legend>
        
        <br>
        <?php
            echo $this->Form->control('NOMBRE', ['label' => __('Nombre') ]);
            echo $this->Form->control('APELLIDO_1', ['label' => __('Apellido 1')]);
            echo $this->Form->control('APELLIDO_2', ['label' => __('Apellido 2')]);
            echo $this->Form->control('NOMBRE_USUARIO', ['label' => __('Nombre de usuario')]);
            //echo $this->Form->control('CONTRASEÑA', ['label' => __('Contraseña')]);
            echo $this->Form->control('CORREO', ['label' => __('E-mail')]);
            echo $this->Form->control('NUMERO_TELEFONO', ['label' => __('Teléfono')]);
            echo $this->Form->control('NACIONALIDAD', ['label' => __('Nacionalidad')]);
            echo $this->Form->control('SEG_ROL', ['label' => __('Rol'), 'type' => 'select', 'options' => array(__('Estudiante'),__('Administrador'),__('Superusuario'))]);
            
        ?>
    </fieldset>
    <br>
    <a href="."> <button type="button" class="botonCancelar"> <?= __('Cancelar') ?> </button> </a>
    <?= $this->Form->button(__('Aceptar'), ['class' => 'botonAceptar'], ['label' => 'Aceptar']) ?>
    <?= $this->Form->end() ?>
</div>
