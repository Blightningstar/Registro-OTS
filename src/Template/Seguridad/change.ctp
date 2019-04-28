<?php
    /** 
     * @author Daniel Marín <110100010111h@gmail.com>
     * 
     **/
    $password_pattern = '(?=.*\d.*)(?=.*[a-z].*)(?=.*[A-Z].*).{8,20}';
    //$password_pattern = '(?=.*\d.*)(?=.*[a-z].*)(?=.*[A-Z].*)(?=.*..*).{8,16}';
?>
<div class="container mt-5 mb-5 pb-5 pt-5 class card ">
    <h1 class = "titulo"><?= __('Change Password') ?></h1>
    <p class = "subtitulo"> 
        <?= __('Password  must contain between 8 or 16 characters that are of at least one number, one uppercase letter and one lowercase letter.') ?> 
    </p>    
    <?= $this->Form->create() ?>    
    <fieldset>
        <div><?= __('Old password:') ?></div>
        <div>
            <?= $this->Form->password('old_password', [
                'id' => 'OldPassword',
                'pattern' => $password_pattern,
                'placeholder'=> 'Your Actual Password'
            ]); ?>
        </div>
        <span toggle="#OldPassword" class="fa fa-fw fa-eye field-icon password"></span>
        <div><?= __('New password:') ?></div>
        <div>
            <?= $this->Form->password('new_password', [
                'id' => 'NewPassword',
                'pattern' => $password_pattern,
                'placeholder'=> 'PaSs3xample'
            ]); ?>
        </div>
        <span toggle="#NewPassword" class="fa fa-fw fa-eye field-icon password"></span>
        <div><?= __('New password confirmation:') ?></div>
        <div>
            <?= $this->Form->password('new_password_confirmation', [
                'id' => 'PasswordConfirmation',
                'pattern' => $password_pattern,
                'placeholder'=> 'PaSs3xample'
            ]); ?>
        </div>
        <span toggle="#PasswordConfirmation" class="fa fa-fw fa-eye field-icon password"></span>
    </fieldset>
    <?= $this->Form->button( __('Change'), ['type' => 'submit', 'class' => 'botonAceptar']) ?>
    <?= $this->Form->end() ?>
</div>

<?= $this->Html->script('togglePassword'); ?>