<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SolSolicitud $solSolicitud
 */
?>

<div class="solSolicitud form large-9 medium-8 columns content">
    <fieldset>
        <legend class = "titulo"><?= __('Upload student\'s grades') ?>
            <br>
            <p class = "subtitulo">Upload student's grades PDF file.</p>
        </legend>

        <br>

        <?php echo $this->Form->create(false, ['type' => 'file']); ?>
            <?php echo $this->Form->input('file', ['type' => 'file', 'class' => 'form-control']); ?>
            <?php echo $this->Form->submit('Upload PDF'); ?>
        <?= $this->Form->end(); ?>
    </fieldset>
</div>
