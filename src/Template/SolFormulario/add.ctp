<?php
/**
 * @author Anyelo Mijael Lobo Cheloukhin
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SolFormulario $solFormulario
 */
?>

<div class="proPrograma index large-9 medium-8 columns content container-fluid">
    <fieldset>
        <legend class = "titulo">Form Administration<br></br>
        <p class = "subtitulo">Dinamically select and add questions</p>
        </legend>
    </fieldset>

    <!-- Add questions to the form Dinamically -->
    <div>
        

        <div id="addinput">
            <p>
                <button type="button" class="botonAgregar">
                    <a href="#" id="addNew" style="color:white;">Add</a>
                </button>

                
            </p>

            <br>
            <form action="#" method="POST">
                <!-- Select Box with the available questions -->
                <select class="questions-dropdown" name="QuestList">
                    <?php 
                        foreach ($pregunta as $data){
                    ?>

                    <option><?php echo $data->DESCRIPCION_ING; ?></option><?php } ?>
                </select>
                <br>
                <br>
            </form>
        </div>
        <a href="."> <button type="button" class="botonCancelar">Cancel</button> </a>
        <?= $this->Form->button(__('Confirm'), ['class' => 'botonAceptar'], ['label' => 'ACCEPT']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>

<script  src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>      <!--   // Calling jQuery Library hosted on Google's CDN -->
    
<script type="text/javascript">
    $(function() {
        var addDiv = $('#addinput');
        var i = $('#addinput p').size() + 1;
        
        $('#addNew').live('click', function() {
            $('<select class="questions-dropdown"><?php foreach ($pregunta as $data){?><option><?php echo $data->DESCRIPCION_ING; ?></option><?php } ?></select><a href="#" id="remNew">Remove</a> <br><br>').appendTo(addDiv);
            i++;
            return false;
        });

    // $('#addNew').live('click', function() {
    // $('<p><input type="text" id="p_new" size="40" name="p_new_' + i +'" value="" placeholder="I am New" /><a href="#" id="remNew">Remove</a> </p>').appendTo(addDiv);
    // i++;
    // return false;
    // });

        $('#remNew').live('click', function() {
            if( i > 2 ) {
                $(this).parents('p').remove();
                i--;
            }
            return false;
        });
    });
</script>

<script type="text/javascript">

    $('.questions-dropdown').change(function() {
     $val = $(this).val(); 
     alert($val);
     // return
    });

</script>