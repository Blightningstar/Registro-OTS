<?php
    /** 
     * @author Daniel Marín <110100010111h@gmail.com>
     * 
     **/

    $password_pattern = '(?=.*\d.*)(?=.*[a-z].*)(?=.*[A-Z].*).{8,20}';
    //$password_pattern = '(?=.*\d.*)(?=.*[a-z].*)(?=.*[A-Z].*)(?=.*..*).{8,16}';
    $userData_pattern = '([a-zA-Z0-9.!#$%&*+\/?^_{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*)|(\w+)'
?>
<div class="container mt-5 mb-5 pb-5 pt-5" style="width:500px">
    <h1  class = "titulo" ><?= __('Log In') ?></h1>
    <p class = "subtitulo"> <?= __('Use your email or username to log in.') ?> </p>
    <?= $this->Form->create() ?>
    <fieldset>
        <div class="row">
            <div class="col-5"><?= __('Email or username:') ?></div>
            <div class="col-7">
                <?= $this->Form->text('email', [
                    'pattern' => $userData_pattern,
                    'title' => __("Error: invalid email or username"),
                    'placeholder'=> 'Your email or username'
                ]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-5"><?= __('Password:') ?></div>
            <div class="col-7"><?= $this->Form->password('password', [
                    'pattern' => $password_pattern,
                    'title' => __("Error: invalid password"),
                    'placeholder'=> 'Your Actual Password'
                ]); ?>
            </div>
        </div>
    </fieldset>
    <?= $this->Form->button( __('Log In'), ['type' => 'submit', 'class' => 'botonAceptar']) ?>
    <?= $this->Form->end() ?>
    <?= $this->Html->link( __('Restore Password'),['controller'=>'Seguridad','action'=>'restoreSend']) ?><br>
    <?= $this->Html->link(__('Create an acount'),['controller'=>'SegUsuario','action'=>'add'])?>
</div>
