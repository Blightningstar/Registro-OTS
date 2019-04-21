<?php
    /** 
     * @author Daniel Marín <110100010111h@gmail.com>
     * 
     **/
    $password_pattern = '(?=.*\d.*)(?=.*[a-z].*)(?=.*[A-Z].*).{8,20}';
    //$password_pattern = '(?=.*\d.*)(?=.*[a-z].*)(?=.*[A-Z].*)(?=.*..*).{8,16}';
    $code_pattern = '\w{15}';
?>
<div class="container mt-5 mb-5 pb-5 pt-5" style="width:500px">
    <?= $this->Form->create() ?>
    <fieldset>
        <h1 class = "titulo"><?= __('Restore Password') ?></h1>
        <p class = "subtitulo">
            <?= __('Password  must contain between 8 or 16 that are of at least one number, and one uppercase and lowercase letter.') ?>
        </p>

        <div class="row">
            <div class="col-5"><?= __('Receipt Code:') ?></div>
            <div class="col-7"><?= $this->Form->text('code', [
                    'pattern' => $code_pattern,
                    'title' => __("Error: invalid restauration code"),
                    'placeholder'=> 'code of 15 alphanumeric characters'
                ]); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-5"><?= __('New password:') ?></div>
            <div class="col-7"><?= $this->Form->password('new_password', [
                    'pattern' => $password_pattern,
                    'title' => __("Error: invalid password"),
                    'placeholder'=> 'PaSs3xample'
                ]); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-5"><?= __('Password confirmation:') ?></div>
            <div class="col-7"><?= $this->Form->password('password_confirmation', [
                    'pattern' => $password_pattern,
                    'title' => __("Error: invalid password"),
                    'placeholder'=> 'PaSs3xample'
                ]); ?>
            </div>
        </div>
    </fieldset>
    <?= $this->Form->button( __('Restore'), ['type' => 'submit', 'class' => '']) ?>
    <?= $this->Form->end() ?>
</div>
