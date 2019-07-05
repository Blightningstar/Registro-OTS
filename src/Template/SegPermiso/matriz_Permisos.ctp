<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SegRol[]|\Cake\Collection\CollectionInterface $segRol
 * @author Nathan González Herrera.
 */
?>

<div class="segRol index large-8 medium-8 columns content text-grid col-lg-offset-4">
    <!-- Labels of the title and subtitle of the page -->
    <fieldset>
        <legend class = "titulo"><?= __('Permissions') ?>
            <br><br>
            <p class = "subtitulo"> Administration of system permissions </p>
        </legend>
        <br><br>
    <fieldset>

    <!-- Shows/hide rows by user input -->
    <div class="row">
    <label style="margin-left:30px;" ><?= __('Search Permisions ') ?></label>
        <input type="text" id="queryTextbox" style="width:50%;margin-left:20px;"> 
    </div>

    <div class="row">
        <div class="col-xl-12 offset-xl-3">

            <!-- Permission matrix. -->
            <table cellspacing="10" id="rightstable" class="gridIndex table table-bordered">
                <thead>
                    <tr id = "headTr">
                        <th colspan="2" scope="col" style="text-align:center;">Permission description</th>
                        <th scope="col" style="text-align:center;">SuperUser</th>
                        <th scope="col" style="text-align:center;">Administrator</th>
                        <th scope="col" style="text-align:center;">Student</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vgo_DsPermisos as $vgo_DsPermisos): ?>
                    <tr>
                        <!-- Permision Description. -->
                        <td colspan="2">
                            <?= h($vgo_DsPermisos['DESCRIPCION_ING']) ?>
                        </td>

                        <!-- SuperUser checkbox. -->
                        <td class="actions" style="text-align:center;">
                            <input type="checkbox" id="checkbox" name="checkbox" class='checkbox' style="zoom:2;">
                        </td>

                        <!-- Administrator checkbox. -->
                        <td class="actions" style="text-align:center;">
                            <input type="checkbox" id="checkbox" name="checkbox" class='checkbox' style="zoom:2;">
                        </td>
                
                        <!-- Student checkbox. -->
                        <td class="actions" style="text-align:center;">
                            <input type="checkbox" id="checkbox" name="checkbox" class='checkbox' style="zoom:2;">
                        </td>

                        <!-- Permission Id, is hidden, work just for the submit process. -->
                        <td hidden='true'>
                            <?= $this->Number->format($vgo_DsPermisos['SEG_PERMISO']) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Load permissions granted. -->
    <?php foreach ($vgo_DsPermisosDeRol as $vgo_DsPermisosDeRol): ?>
        <script type="text/javascript">
            (function() {
                var row = "<?php echo $vgo_DsPermisosDeRol[0] ?>";
                ++row;
                var col = "<?php echo $vgo_DsPermisosDeRol[1] ?>";
                
                var table = document.getElementById('rightstable');

                table.rows[row].cells[col].firstElementChild.checked = true;
            })();
        </script>
    <?php endforeach; ?>

    <!-- Form send to the submit process. -->
    <?= $this->Form->create(false,['id'=>'submitRequest'] ); ?>
        <?php 
            // Id of the submited permission.
            echo $this->Form->input('segpermiso', ['type'=>'hidden'] ); 
            // Id of the submited rol.
            echo $this->Form->input('segrol', ['type'=>'hidden'] );
            // Action to do, grant a permission to some rol or remove it. 0 remove, 1 grant.
            echo $this->Form->input('tipo', ['type'=>'hidden'] );
            // Description of the permission.
            echo $this->Form->input('descripcion', ['type'=>'hidden'] );
            // Rol who will be granted or removed the permission.
            echo $this->Form->input('rol', ['type'=>'hidden'] );
            // This variables wil be sent to the controller.
            $this->Form->unlockField('segpermiso');
            $this->Form->unlockField('segrol');
            $this->Form->unlockField('tipo');
            $this->Form->unlockField('descripcion');
            $this->Form->unlockField('rol');
        ?> 
    <?= $this->Form->end(); ?>
<div>

<?= $this->Html->script('js.permisos.js'); ?>