<?php
/**
 * @author Esteban Rojas
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SegUsuario $segUsuario
 */

$password_pattern = '(?=.*\d.*)(?=.*[a-z].*)(?=.*[A-Z].*).{8,20}';
?>

<div class="segUsuario form large-9 medium-8 columns content">
    <?= $this->Form->create($segUsuario) ?>
    <fieldset>
        <legend class = "titulo"><?= __('Register') ?>
        <br></br>
        <p class = "subtitulo"> <?= __('Password  must contain between 8 or 16 characters that are of at least one number, one uppercase letter and one lowercase letter.') ?>  </p>
    </legend>
        
        <br>
        <?php
            echo $this->Form->control('NOMBRE', ['label' => __('Name') ]);
            echo $this->Form->control('APELLIDO_1', ['label' => __('Lastname 1')]);
            echo $this->Form->control('APELLIDO_2', ['label' => __('Lastname 2')]);
            echo $this->Form->control('NOMBRE_USUARIO', ['label' => __('Username'),'pattern' => '\w+', 'title' => __('Username invalid')]);
            echo $this->Form->control('CORREO', ['label' => __('E-mail'),  'pattern' => '[0-9A-Za-z^@]+@+[0-9A-Za-z^\.]+\.+[0-9A-Za-z^@]+', 'title' => __("Error: E-mail invalid")]);
            echo $this->Form->control('NUMERO_TELEFONO', ['label' => __('Telephone'), 'pattern' => "[/+]?[0-9\-\s]+", 'title' => 'Error: Put a valid number. You can use + - or spaces']);
            echo $this->Form->control('NACIONALIDAD', ['label' => __('Country')]);
           
            echo $this->Form->control('new_password', [
                'pattern' => $password_pattern,
                'title' => __("Error: invalid password"),
                'placeholder'=> 'PaSs3xample', 'label' => __('New password'), 'type' => 'password'
            ]);    

            echo $this->Form->control('new_password_confirmation', [
                'pattern' => $password_pattern,
                'title' => __("Error: invalid password"),
                'placeholder'=> 'PaSs3xample', 'label' => __('New password confirmation'), 'type' => 'password'
            ]);    
           
           ?>

  


        
    </fieldset>
    <br>
    <a href="."> <button type="button" class="botonCancelar"> <?= __('Cancel') ?> </button> </a>
    <?= $this->Form->button(__('Accept'), ['class' => 'botonAceptar'], ['label' => 'Acept']) ?>
    <?= $this->Form->end() ?>
</div>
