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
        <p class = "subtitulo">Add New Form</p>
        </legend>
    </fieldset>

<!--     <div class="proPrograma form large-9 medium-8 columns content">
        <?= $this->Form->create($solFormulario) ?>
            <?php
                echo $this->Form->control('SOL_FORMULARIO', array('type' => 'text'), [
                    'label' => 'Name of the form',
                    'pattern' => '[a-zA-Z]+(\w)*', 
                    'placeholder' => 'Letters and then alphanumeric characters if needed. Ex: Pregrado_01'
                    ]);
            ?>

        <a href="."> <button type="button" class="botonCancelar">Cancel</button> </a>
        <?= $this->Form->button(__('Confirm'), ['class' => 'botonAceptar']) ?>
        <?= $this->Form->end() ?>
    </div> -->

    <div>
                <script type="text/javascript">
    $(function() {
    var addDiv = $('#addinput');
    var i = $('#addinput p').size() + 1;
    $('#addNew').live('click', function() {
    $('<p><input type="text" id="p_new" size="40" name="p_new_' + i +'" value="" placeholder="I am New" /><a href="#" id="remNew">Remove</a> </p>').appendTo(addDiv);
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

        <div id="addinput">
    <p>
    <input type="text" id="p_new" size="20" name="p_new" value="" placeholder="Input Value" /><a href="#" id="addNew">Add</a>
    </p>
    </div>
    </div>

</div>

<script  src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>      <!--   // Calling jQuery Library hosted on Google's CDN -->
    
