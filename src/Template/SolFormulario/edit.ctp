<?php
/**
 * @author Anyelo Mijael Lobo Cheloukhin
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SolFormulario $solFormulario
 */
?>
<div class="solFormulario index large-9 medium-8 columns content container-fluid">
    <?= $this->Form->create($solFormulario) ?>
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
                        'placeholder' => 'Only alphanumeric characters'
                    ]);
                    
                ?>
                            
            </fieldset>

            <?php 
                $questNumber = 0; 
                $counter = 1;
            ?>
            <?php 
                foreach ($result as $questCount){
            ?>
                <!-- Select Box with the available questions -->
                <p id="p_new" size="40" name="p_new_" + $questNumber +"" value="">
                <p class= "field"> <?= __('Question '.$counter.':') ?></p>
                <select name="questions[]"> 
                    <?php echo $questCount['SOL_PREGUNTA']; ?>
                    <!-- <option selected> -- Choose a Question -- </option> -->
                    <option selected value="<?php echo $questCount['SOL_PREGUNTA'];?>" > <?php echo $result[$questNumber]['DESCRIPCION_ING']; ?> </option>

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
                $counter++;
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
                count++;
            }
            window.alert(count);
            return false;
        });
    });
</script>

<script  src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>      <!--   // Calling jQuery Library hosted on Google's CDN -->