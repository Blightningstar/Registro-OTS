<?php
    /** 
     * @author Daniel Marín <110100010111h@gmail.com>
     * 
     **/
    $password_pattern = '(?=.*\d.*)(?=.*[a-z].*)(?=.*[A-Z].*).{8,20}';
    //$password_pattern = '(?=.*\d.*)(?=.*[a-z].*)(?=.*[A-Z].*)(?=.*..*).{8,16}';
?>
<div class="container mt-5 mb-5 pb-5 pt-5" style="width:500px">
    <?= $this->Form->create() ?>
    <fieldset>
        <h1 class = "titulo"><?= __('Change Password') ?></h1>
        <p class = "subtitulo"> 
            <?= __('Password  must contain between 8 or 16 that are of at least one number, and one uppercase and lowercase letter.') ?> 
        </p>
        
        <div class="row">
            <div class="col-5"><?= __('Old password:') ?></div>
            <div class="col-7">
                <?= $this->Form->password('old_password', [
                    'pattern' => $password_pattern,
                    'title' => __("Error: invalid password"),
                    'placeholder'=> 'Your Actual Password'
                ]); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-5"><?= __('New password:') ?></div>
            <div class="col-7">
                <?= $this->Form->password('new_password', [
                    'pattern' => $password_pattern,
                    'title' => __("Error: invalid password"),
                    'placeholder'=> 'PaSs3xample'
                ]); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-5"><?= __('New password confirmation:') ?></div>
            <div class="col-7">
                <?= $this->Form->password('new_password_confirmation', [
                    'pattern' => $password_pattern,
                    'title' => __("Error: invalid password"),
                    'placeholder'=> 'PaSs3xample'
                ]); ?>
            </div>
        </div>
    </fieldset>
    <?= $this->Form->button( __('Change'), ['type' => 'submit', 'class' => 'botonAceptar']) ?>
    <?= $this->Form->end() ?>
</div>
