<?php
/**
 * @author Anyelo Mijael Lobo Cheloukhin
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SolFormulario $solFormulario
 */
?>
<div class="solFormulario index large-9 medium-8 columns content container-fluid">
    <fieldset>
        <legend class = "titulo">Form Administration<br></br>
        <p class = "subtitulo">Editing form</p>
        </legend>
    </fieldset>

    <div class="solFormulario form large-9 medium-8 columns content">
        <div id="addinput">

            <p>
                <button type="button" class="botonAgregar">
                    <a href="#" id="addNew" style="color:white;">Add Question</a>
                </button>                   
            </p>

            <br>


            <fieldset>
                <?php
                    echo $this->Form->control('NOMBRE', [
                        'label' => 'Form Name',
                        'pattern' => '^[A-Za-z0-9 _,.\/ ?¿]*$', 
                        // 'placeholder' => 'Only alphanumeric characters'
                        'placeholder' => $solFormulario->NOMBRE 
                    ]);
                    
                ?>
                            
            </fieldset>

            <?php $questNumber = 0; ?>
            <?php 
                foreach ($result as $questCount){
            ?>
                <!-- Select Box with the available questions -->
                <p id="p_new" size="40" name="p_new_" + $questNumber +"" value="">
                <select name="questions[]"> 
                    <!-- <option selected> -- Choose a Question -- </option> -->
                    <option selected> <?php echo $result[$questNumber]['DESCRIPCION_ING']; ?> </option>

        <!--             <?php 
                        foreach ($contiene as $data){
                    ?> -->
                   <!-- <option value="<?php echo $data->SOL_PREGUNTA;?>"><?php echo $data->SOL_FORMULARIO; ?></option><?php } ?> -->

                    <?php 
                        foreach ($pregunta as $data){
                    ?>
                   <option value="<?php echo $data->SOL_PREGUNTA;?>"><?php echo $data->DESCRIPCION_ING; ?></option><?php } ?>
                </select>
                <a href="#" id="remNew"><input type="button" style="background-color:rgb(242, 102, 49);color:white;width:150px;height:40px;border-radius: 5px;" value="Remove"></a>
                <br>
                <br>
                <br>
            <?php
                $questNumber++; 
                 } ?>
        </div>


        <a href="/Registro-OTS/sol-formulario/"> <button type="button" class="botonCancelar">Cancel</button> </a>
        <?= $this->Form->button(__('Confirm'), ['class' => 'botonAceptar']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        var addDiv = $('#addinput');
        var i = $('#addinput p').size() + 1;
        
        $('#addNew').live('click', function() {
            $('<p id="p_new" size="40" name="p_new_' + i +'" value=""> <select  name="questions[]" "><option selected> -- Choose a Question -- </option><?php foreach ($pregunta as $data){?><option value="<?php echo $data->SOL_PREGUNTA;?>"><?php echo $data->DESCRIPCION_ING; ?></option><?php } ?></select><a href="#" id="remNew"><input type="button" style="background-color:rgb(242, 102, 49);color:white;width:150px;height:40px;border-radius: 5px;" value="Remove"></a> <br><br>').appendTo(addDiv);
            i++;
            return false;
        });

        $('#remNew').live('click', function() {
            if( i > 2 ) {
                $(this).parents('p').remove();
                i--;
            }
            return false;
        });
    });
</script>

<script  src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>      <!--   // Calling jQuery Library hosted on Google's CDN -->