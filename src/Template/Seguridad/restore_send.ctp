<?php
    /** 
     * @author Daniel Marín <110100010111h@gmail.com>
     * 
     **/
    $userData_pattern = '([a-zA-Z0-9.!#$%&*+\/?^_{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*)|(\w+)'
?>
<div class="container mt-5 mb-5 pb-5 pt-5 card">
    <h1 class = "titulo"><?= __('Restore Password') ?></h1>
    <p class = "subtitulo"> <?= __('Type your username or email and we will send a recovery code to your email account.') ?> </p>    
    <?= $this->Form->create() ?>
    <fieldset>
        <div ><?= __('Email or username:') ?></div>
        <div ><?= $this->Form->text('username', [
                'pattern' => $userData_pattern,
                'placeholder'=> 'Your email or username'
            ]); ?>
        </div>
    </fieldset>
    <?= $this->Form->button( __('Send Code'), ['type' => 'submit', 'class' => 'botonAceptar']) ?>
    <?= $this->Form->end() ?>
</div>
