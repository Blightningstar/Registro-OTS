<?php
    /** 
     * @author Daniel Marín <110100010111h@gmail.com>
     **/

    $password_pattern = '(?=.*\d+.*)(?=.*[a-z]+.*)(?=.*[A-Z]+.*).{8,20}';
    $userData_pattern = '([a-zA-Z0-9.!#$%&*+\/?^_{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*)|(\w+)';
?>
<div class="container col mt-5 mb-5 pb-5 pt-5 card background">
    <h1  class = "titulo" ><?= __('Sign In to OTS') ?></h1>
    <?= $this->Form->create() ?>
    <fieldset>
        <div ><?= __('Email or username:') ?></div>
        <div >
            <?= $this->Form->text('email', [
                'pattern' => $userData_pattern,
                'placeholder'=> 'Your email or username',
            ]); ?>
        </div>
        <div ><?= __('Password:') ?></div>
        <div ><?= $this->Form->password('password', [
                'id' => 'password',
                'pattern' => $password_pattern,
                'placeholder'=> 'Your Actual Password',
                'required'
            ]); ?>
        </div>
            <span toggle="#password" class="fa fa-fw fa-eye field-icon password"></span>
    </fieldset>
    <div>
        <?= $this->Html->link( __('¿Forgot your password?'),['controller'=>'Seguridad','action'=>'restoreSend'],['class' => 'securityLink Colored']) ?><br>
    </div>
    <div>
        <?= $this->Form->button( __('Sign In'), ['id'=>'SignInButton', 'type' => 'submit', 'class' => 'botonAceptar']) ?>
    </div>
    <?= $this->Form->end() ?>

</div>

<?= $this->Html->script('togglePassword'); ?>