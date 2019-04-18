<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SegUsuario $segUsuario
 */
?>


<div class="segUsuario form large-9 medium-8 columns content">
    <!--La acción del formulario debe coincidir con el nombre del metodo de la controladora-->
    <?= $this->Form->create('POST',['action' => 'PasswordChange']) ?>
    <fieldset>
        <legend class = "titulo"><?= __('Editar Contraseña') ?>
        <br></br>
        <p class = "subtitulo"> <?=__('Ingrese su contraseña anterior 2 veces y luego su nueva contraseña') ?> </p>
    </legend>
        <br>
        <?php
            //Los primeros strings del input van a ser las llaves del diccionario 
            echo $this->Form->input('anterior', ['label' => __('Contraseña anterior'), 'type' => 'password']);
            echo $this->Form->input('nueva', ['label' => __('Nueva contraseña anterior') , 'type' => 'password']);
            echo $this->Form->input('confirmacion', ['label' => __('Confirme su nueva contraseña ') , 'type' => 'password']);
        ?>
    </fieldset>
    <br><br>
    <a href="./profile-view"> <button type="button" class="botonCancelar"> <?= __('Cancelar') ?> </button> </a>
    
    <!--Cake por defecto agarra los botones con esta sintaxis como botones de submit !!-->
    <?= $this->Form->button(__('Aceptar'), ['class' => 'botonAceptar'], ['label' => 'Aceptar']) ?>


    
    <?= $this->Form->end() ?>
</div>
