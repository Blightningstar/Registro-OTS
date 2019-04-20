<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SegUsuario $segUsuario
 */
?>


<div class="segUsuario form large-9 medium-8 columns content">
    <?= $this->Form->create($segUsuario) ?>
    <fieldset>
        <legend class = "titulo"><?= __('Edit User') ?>
        <br></br>
        <p class = "subtitulo"> <?=__('Edit a user information') ?> </p>
    </legend>
        <?php
            echo $this->Form->control('NOMBRE', ['label' => __('Name')]);
            echo $this->Form->control('APELLIDO_1', ['label' => __('Lastname 1')]); 
            echo $this->Form->control('APELLIDO_2', ['label' => __('Lastname 2')] );
            echo $this->Form->control('NOMBRE_USUARIO' ,  ['label' => __('Username')]);
            echo $this->Form->control('CORREO', ['label' => __('E-mail'),  'pattern' => '[0-9A-Za-z^@]+@+[0-9A-Za-z^\.]+\.+[0-9A-Za-z^@]+', 'title' => __("Error: E-mail invalid")]);
            echo $this->Form->control('NACIONALIDAD',  ['label' => __('Country')]);


            $segUsuario["SEG_ROL"] -= 1;

            //Administrator can't create superusers
            if($lc_role == "3")
                echo $this->Form->control('SEG_ROL', ['label' => __('Role'), 'type' => 'select', 'options' => array(__('Student'),__('Administrator'),__('Superuser'))]);
            else
            echo $this->Form->control('SEG_ROL', ['label' => __('Role'), 'type' => 'select', 'options' => array(__('Student'),__('Administrator'))]);
           
        ?>
    </fieldset>
    <br><br>
    <a href=".."> <button type="button" class="botonCancelar"> <?= __('Cancel') ?> </button> </a>
    <?= $this->Form->button(__('Acept'), ['class' => 'botonAceptar'], ['label' => 'Acept']) ?>
    <?= $this->Form->end() ?>
</div>
