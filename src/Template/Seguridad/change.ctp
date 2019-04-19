<?php
    /** 
     * @author Daniel Marín <110100010111h@gmail.com>
     * 
     **/
?>
<div class="container mt-5 mb-5 pb-5 pt-5" style="width:500px">
    <?= $this->Form->create() ?>
    <fieldset>
        <h1><?= __('Change Password') ?></h1>
        
        <div class="row">
            <div class="col-5"><?= __('Old password:') ?></div>
            <div class="col-7"><?= $this->Form->password('old_password'); ?></div>
        </div>

        <div class="row">
            <div class="col-5"><?= __('New password:') ?></div>
            <div class="col-7"><?= $this->Form->password('new_password'); ?></div>
        </div>

        <div class="row">
            <div class="col-5"><?= __('New password confirmation:') ?></div>
            <div class="col-7"><?= $this->Form->password('new_password_confirmation'); ?></div>
        </div>
    </fieldset>
    <?= $this->Form->button( __('Change'), ['type' => 'submit', 'class' => '']) ?>
    <?= $this->Form->end() ?>
</div>
