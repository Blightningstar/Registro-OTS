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
        <legend class = "titulo"><?= __('View User') ?>
        <br></br>
        <p class = "subtitulo"> <?= __('View the user information') ?></p>
    </legend>
        <?php
             echo $this->Form->control('NOMBRE', ['label' => __('Name'), 'disabled']);
             echo $this->Form->control('APELLIDO_1', ['label' => __('Lastname 1'), 'disabled']); 
             echo $this->Form->control('APELLIDO_2', ['label' => __('Lastname 2'), 'disabled'] );
             echo $this->Form->control('NOMBRE_USUARIO' ,  ['label' => __('Username'), 'disabled']);
             echo $this->Form->control('CORREO', ['label' => __('E-mail'), 'disabled']);
             echo $this->Form->control('NUMERO_TELEFONO', ['label' => __('Telephone'), 'disabled']);
             echo $this->Form->control('NACIONALIDAD',  ['label' => __('Country'), 'disabled']);


            $rol = "";

            switch($segUsuario["SEG_ROL"])
            {
                case "1":
                    $rol = __("Student");
                    break;
                case "2":
                    $rol = __("Administrator");
                    break;
                case "3":
                    $rol = __("Superuser");
                    break;
            }

             echo $this->Form->label(__("Rol: ") . $rol);
             
        ?>
    </fieldset>
    <a href=".."> <button type="button" class="botonCancelar"><?= __('Cancel') ?></button> </a>
    <?= $this->Form->end() ?>
</div>