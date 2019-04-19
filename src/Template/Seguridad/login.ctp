<?php
    /** 
     * @author Daniel Marín <110100010111h@gmail.com>
     * 
     **/
?>
<div class="container mt-5 mb-5 pb-5 pt-5" style="width:400px">
    <?= $this->Form->create() ?>
    <fieldset>
        <h1><?= __('Log In') ?></h1>
        
        <div class="row">
            <div class="col-5"><?= __('Email or username:') ?></div>
            <div class="col-7"><?= $this->Form->text('username')?></div>
        </div>
        <div class="row">
            <div class="col-5"><?= __('Password:') ?></div>
            <div class="col-7"><?= $this->Form->password('password'); ?></div>
        </div>
    </fieldset>
    <?= $this->Form->button( __('Log In'), ['type' => 'submit', 'class' => '']) ?>
    <?= $this->Form->button( __('Restore Password'),['controller'=>'Seguridad','action'=>'restore'], ['type' => 'button', 'class' => '']) ?>
    <?= $this->Form->end() ?>
    
</div>
