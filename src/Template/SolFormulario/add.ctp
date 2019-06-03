<?php
/**
 * @author Anyelo Mijael Lobo Cheloukhin
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SolFormulario $solFormulario
 */
?>

<div class="solFormulario form large-9 medium-8 columns content">
    <fieldset>
        <legend class = "titulo">Form Administration<br></br>
        <p class = "subtitulo">Select and add questions</p>
        </legend>
    </fieldset>

    <?= $this->Form->create($solFormulario) ?>
    <?= $this->Form->create($solContiene) ?>    
    
        <!-- Add questions to the form Dinamically -->
        <div class="solFormulario index large-9 medium-8 columns content container-fluid">
            <div id="addinput">
                <p>
                    <button type="button" class="botonAgregar">
                        <a href="#" id="addNew" style="color:white;">Add Question</a>
                    </button>                   
                </p>

                <br>
                <!-- <form action="#" method="POST"> -->
                <?= $this->Form->create($solFormulario) ?>
                     <?php

                        echo $this->Form->control('NOMBRE', [
                            'label' => 'Form Name',
                            'pattern' => '^[A-Za-z0-9 _,.\/ ?¿]*$', 
                            'placeholder' => 'Only alphanumeric characters'
                        ]);
                        
                    ?>

                    <!-- Select Box with the available questions -->
                    <h5 style="color:rgb(242, 102, 49);">1</h5>
                    
                    <select name="questions[]">
                        1
                        <option selected> -- Choose a Question -- </option>
                        <?php 
                            foreach ($pregunta as $data){
                        ?>
                        <option value="<?php echo $data->SOL_PREGUNTA;?>"><?php echo $data->DESCRIPCION_ING; ?></option><?php } ?>
                    </select>
                    <br>
                    <br>
                    <br>
                
            </div>
            <a href="."> <button type="button" class="botonCancelar">Cancel</button> </a>
            <?= $this->Form->button(__('Confirm'), ['class' => 'botonAceptar'], ['label' => 'ACCEPT']) ?>
            <?= $this->Form->end() ?>
        </div>    
</div>

<script type="text/javascript">
    $(function() {
        var addDiv = $('#addinput');
        var i = $('#addinput p').size() + 1;
        
        $('#addNew').live('click', function() {
            $('<p id="p_new" size="40" name="p_new_' + i +'" value=""> <h5 style="color:rgb(242, 102, 49);">'+i+'</h5> <select  name="questions[]" "><option selected> -- Choose a Question -- </option><?php foreach ($pregunta as $data){?><option value="<?php echo $data->SOL_PREGUNTA;?>"><?php echo $data->DESCRIPCION_ING; ?></option><?php } ?></select><a href="#" id="remNew"><input type="button" style="background-color:rgb(242, 102, 49);color:white;width:150px;height:40px;border-radius: 5px;" value="Remove"></a> <br><br>').appendTo(addDiv);
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