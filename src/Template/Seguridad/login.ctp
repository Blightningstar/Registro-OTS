<?php
    /** 
     * @author Daniel Marín <110100010111h@gmail.com>
     **/

    $password_pattern = '(?=.*\d.*)(?=.*[a-z].*)(?=.*[A-Z].*).{8,20}';
    //$password_pattern = '(?=.*\d.*)(?=.*[a-z].*)(?=.*[A-Z].*)(?=.*..*).{8,16}';
    $userData_pattern = '([a-zA-Z0-9.!#$%&*+\/?^_{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*)|(\w+)'
?>
<div class="container col mt-5 mb-5 pb-5 pt-5 card">
    <h1  class = "titulo" ><?= __('Sign In to OTS') ?></h1>
    <?= $this->Form->create() ?>
    <fieldset>
        <div ><?= __('Email or username:') ?></div>
        <div >
            <?= $this->Form->text('email', [
                'pattern' => $userData_pattern,
                'title' => __("Error: invalid email or username"),
                'placeholder'=> 'Your email or username'
            ]); ?>
        </div>
        <div ><?= __('Password:') ?></div>
        <div ><?= $this->Form->password('password', [
                'pattern' => $password_pattern,
                'title' => __("Error: invalid password"),
                'placeholder'=> 'Your Actual Password'
            ]); ?>
        </div>
    </fieldset>
    <div>
        <?= $this->Html->link( __('¿Forgot your password?'),['controller'=>'Seguridad','action'=>'restoreSend'],['id'=>'forgotPassword']) ?><br>
    </div>
    <div>
        <?= $this->Form->button( __('Sign In'), ['id'=>'SignInButton', 'type' => 'submit', 'class' => 'botonAceptar']) ?>
    </div>
    <?= $this->Form->end() ?>
    
</div>
