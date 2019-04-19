<?php
    /** 
     * @author Daniel Marín <110100010111h@gmail.com>
     * 
     **/
?>
<div class="container mt-5 mb-5 pb-5 pt-5" style="width:500px">
    <?= $this->Form->create() ?>
    <fieldset>
        <h1><?= __('Restore Password') ?></h1>
        
        <div class="row">
            <div class="col-5"><?= __('Email or username:') ?></div>
            <div class="col-7"><?= $this->Form->text('username')?></div>
        </div>

        <div class="row">
            <div class="col-5"><?= __('Receipt Code:') ?></div>
            <div class="col-7"><?= $this->Form->password('Code'); ?></div>
        </div>

        <div class="row">
            <div class="col-5"><?= __('New password:') ?></div>
            <div class="col-7"><?= $this->Form->password('new_password'); ?></div>
        </div>

        <div class="row">
            <div class="col-5"><?= __('Password confirmation:') ?></div>
            <div class="col-7"><?= $this->Form->password('password_confirmation'); ?></div>
        </div>
    </fieldset>
    <?= $this->Form->button( __('Restore'), ['type' => 'submit', 'class' => '']) ?>
    <?= $this->Form->end() ?>
</div>
