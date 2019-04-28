<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SegRol[]|\Cake\Collection\CollectionInterface $segRol
 * @author Nathan González Herrera.
 */
?>

<style media="screen">
    tr:nth-child(2n+1) {
        background-color:#EBFFCA;
    }
    tr:nth-child(2n+2) {
        background-color:#FFFFFF;
    }
    #header{
        background-color: #659F31;
    }
</style>

<div class="segRol index large-8 medium-8 columns content text-grid col-lg-offset-4">
    <!-- Etiquetas de titulo y subtitulo de la página -->
    <fieldset>
        <legend class = "titulo"><?= __('Permissions') ?>
            <br>
            <p class = "subtitulo"> Administration of system permissions </p>
        </legend>
        <br><br>
    <fieldset>

    <div class="row">
        <div class="col-xl-12 offset-xl-3">

            <!-- Permission matrix. -->
            <table cellspacing="10" id="rightstable" class="table text-center table-bordered">
                <thead>
                    <tr id = "header">
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
                            <?= h($vgo_DsPermisos->DESCRIPCION_ING) ?>
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
                            <?= $this->Number->format($vgo_DsPermisos->SEG_PERMISO) ?>
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
            // This variables wil be sent to the controller.
            $this->Form->unlockField('segpermiso');
            $this->Form->unlockField('segrol');
            $this->Form->unlockField('tipo');
        ?> 
    <?= $this->Form->end(); ?>
<div>

<?= $this->Html->script('Generic'); ?>

<script>
    $(document).ready( function () {
        /**
         * When a checkbox is click, will send the row (permission id) and the column (rol id)
         * and some action (grant or remove), to the controller. In the controller the action is process with
         * storage procedures in whom a relation between the given rol and the given permission is created or 
         * removed. this will happend in the SEG_POSEE table.
         * 
         * @author Nathan González
         */
        $('#rightstable').on('change', '.checkbox', function (event) { 
             
            // The row and the column of the checkbox click it.
            var $vlo_fila = $(this).parent("td");     
            var vlo_col = $vlo_fila.parent().children().index($vlo_fila);
            var vlo_row = $vlo_fila.parent().parent().children().index($vlo_fila.parent()) + 1;
            // Table seek for its id.
            var vlo_Dttable = document.getElementById('rightstable');

            // The permission id.
            var vln_idPermiso = 0;
            vln_idPermiso = parseFloat(vlo_Dttable.rows[vlo_row].cells[4].innerHTML);
            
            document.getElementById('segpermiso').value = vln_idPermiso;
            document.getElementById('segrol').value = vlo_col; //SuperUser = 1, Administrator = 2, Student = 3.
            
            if($(this).is(":checked")){
                document.getElementById('tipo').value = "1"; // Grant a permission for some rol.
            }
            else{
                document.getElementById('tipo').value = "0"; // Remove a permission granted for some rol.
            }

            document.getElementById('submitRequest').submit(); // Submit the request.
        });
    });
</script>