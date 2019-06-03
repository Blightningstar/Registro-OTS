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
        <legend class = "titulo"><?= __('Sign Up') ?>
        <br></br>
        <p class = "subtitulo"> <?= __('Password  must contain between 8 or 16 characters that are of at least one number, one uppercase letter and one lowercase letter.') ?>  </p>
    </legend>
        
        <br>
        <?php
            echo $this->Form->control('NOMBRE', ['label' => __('Name'),'pattern' => '^[áÁéÉíÍóÓúÚA-Za-z0-9A-Za-z0-9 _,.\/ ?¿\s]*$','placeholder' => __('Only alphanumeric characters') ]);
            echo $this->Form->control('APELLIDO_1', ['label' => __('Lastname 1'),'pattern' => '^[áÁéÉíÍóÓúÚA-Za-z0-9 _,.\/ ?¿\s]*$','placeholder' => __('Only alphanumeric characters')]);
            echo $this->Form->control('APELLIDO_2', ['label' => __('Lastname 2'),'pattern' => '^[áÁéÉíÍóÓúÚA-Za-z0-9A-Za-z0-9 _,.\/ ?¿\s]*$','placeholder' => __('Only alphanumeric characters')]);
            echo $this->Form->control('NOMBRE_USUARIO', ['label' => __('Username'), 'pattern' => '^[A-Za-z0-9 _,.\/ ?¿\s]*$','placeholder' => __('Only alphanumeric characters')]);
            echo $this->Form->control('CORREO', ['label' => __('E-mail'),  'pattern' => '[0-9A-Za-z^@]+@+[0-9A-Za-z^\.]+\.+[0-9A-Za-z^@]+', 'placeholder' => __('Only email valid formats')]);
            echo $this->Form->control('NUMERO_TELEFONO', ['label' => __('Telephone'), 'pattern' => "[/+]?[0-9\-\s]+", 'title' => 'Put a valid number. You can use + - or spaces' , 'placeholder' => __('Only number valid formats')]);
            //Located at src/template/element/countrSelectOptions.ctp
            echo $this->element('countrySelectOptions');

        ?>
            
            <div><?= __('Password:') ?></div>
        <div><?= $this->Form->password('new_password', [
                'id' => 'NewPassword',
                'pattern' => $password_pattern,
                'placeholder'=> 'PaSs3xample',
                'required'
            ]);?>
        </div>
        <span toggle="#NewPassword" class="fa fa-fw fa-eye field-icon password"></span>
        <div><?= __('Password confirmation:') ?></div>
        <div ><?= $this->Form->password('password_confirmation', [
                'id' => 'PasswordConfirmation',
                'pattern' => $password_pattern,
                'placeholder'=> 'PaSs3xample',
                'required'
            ]);?>
        </div>
        <span toggle="#PasswordConfirmation" class="fa fa-fw fa-eye field-icon password"></span>
    </fieldset>
    <br>
    <a href="."> <button type="button" class="botonCancelar"> <?= __('Cancel') ?> </button> </a>
    <?= $this->Form->button(__('Accept'), ['class' => 'botonAceptar'], ['label' => 'Accept']) ?>
    <?= $this->Form->end() ?>
</div>

<?= $this->Html->script('togglePassword'); ?>