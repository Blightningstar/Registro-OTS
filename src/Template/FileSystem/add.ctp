<?php
/**
 * @author Nathan González Herrera
 * @var \App\View\AppView $this
 */
?>

<div>
    <?php echo $this->Form->create(false, ['type' => 'file']); ?>
    <?php echo $this->Form->input('file', ['type' => 'file', 'class' => 'form-control']); ?>
    <?php echo $this->Form->input('file2', ['type' => 'file', 'class' => 'form-control']); ?>
    <?php echo $this->Form->submit('Click me'); ?>
    <?= $this->Form->end(); ?>
</div>