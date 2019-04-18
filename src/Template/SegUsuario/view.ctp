<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SegUsuario $segUsuario
 */
?>



<div class="segUsuario form large-9 medium-8 columns content">
    <?= $this->Form->create($segUsuario) ?>
    <fieldset>
        <legend class = "titulo"><?= __('Consultar Usuario') ?>
        <br></br>
        <p class = "subtitulo">Muestra la información de un usuario.</p>
    </legend>
        <?php
             echo $this->Form->control('NOMBRE', ['label' => __('Nombre'), 'disabled']);
             echo $this->Form->control('APELLIDO_1', ['label' => __('Apellido 1'), 'disabled']); 
             echo $this->Form->control('APELLIDO_2', ['label' => __('Apellido 2'), 'disabled'] );
             echo $this->Form->control('NOMBRE_USUARIO' ,  ['label' => __('Nombre de Usuario'), 'disabled']);
             echo $this->Form->control('CORREO', ['label' => __('E-mail'), 'disabled']);
             echo $this->Form->control('NUMERO_TELEFONO', ['label' => __('Teléfono'), 'disabled']);
             echo $this->Form->control('NACIONALIDAD',  ['label' => __('Nacionalidad'), 'disabled']);


            $rol = "";

            switch($segUsuario["SEG_ROL"])
            {
                case "1":
                    $rol = __("Estudiante");
                    break;
                case "2":
                    $rol = __("Administrador");
                    break;
                case "3":
                    $rol = __("Superusuario");
                    break;
            }

             echo $this->Form->label(__("Rol: ") . $rol);
             
        ?>
    </fieldset>
    <a href=".."> <button type="button" class="botonCancelar">Cancelar</button> </a>
    <?= $this->Form->end() ?>
</div>