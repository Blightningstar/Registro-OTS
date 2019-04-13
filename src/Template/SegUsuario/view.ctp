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
            echo $this->Form->control('NOMBRE', ['label' => 'Nombre']);
            echo $this->Form->control('APELLIDO_1', ['label' => 'Apellido 1']); 
            echo $this->Form->control('APELLIDO_2', ['label' => 'Apellido 2'] );
            echo $this->Form->control('NOMBRE_USUARIO' ,  ['label' => 'Nombre de Usuario']);
            echo $this->Form->control('CONTRASEÑA' , ['label' => 'Contraseña']);
            echo $this->Form->control('CORREO', ['label' => 'E-mail']);
            echo $this->Form->control('NUMERO_TELEFONO', ['label' => 'Teléfono']);
            echo $this->Form->control('NACIONALIDAD',  ['label' => 'Nacionalidad']);
            echo $this->Form->control('ACTIVO', ['label' => 'Activo']);
            echo $this->Form->control('ESTUDIANTE' , ['label' => 'Estudiante']);
        ?>
    </fieldset>
    <a href=".."> <button type="button" class="botonCancelar">Cancelar</button> </a>
    <?= $this->Form->end() ?>
</div>