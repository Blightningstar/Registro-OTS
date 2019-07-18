<?php
/**
 * @author Joel Chaves
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SolPreguntum $solPreguntum
 */
?>

<div class="solPregunta form large-9 medium-8 columns content">
    <?= $this->Form->create($solPreguntum) ?>
    <fieldset>
        <legend class = "titulo"><?= __('Edit Question') ?>
        <br></br>
        <p class = "subtitulo">Edit this question to the question bank.</p>
    </legend>
        <?php
            echo $this->Form->control('DESCRIPCION_ING', [
                'label' => 'Description',
                'pattern' => '^[A-Za-z0-9 _,.\/ ?¿]*$', 
                'placeholder' => 'Only alphanumeric characters'
            ]);
            echo '<label for="TIPO">Type</label>';
            ?>
            <select id="typeSelect" onchange="multipleSelect()" name="tipo">
            <option value=0>Short Text</option>
            <option value=1>Medium Text</option>
            <option value=2>Large Text</option>
            <option value=3>Number</option>
            <option value=4>Date</option>
            <option value=5>Select</option>
            <option value=6>Upload Document</option>
            <option value=7>Email</option>
            <option value=8>Phone Number</option>
            <option value=9>URL</option>
            </select>

            <div id="addinput">
            <p id="addOpt">
                <button type="button" class="botonAgregar">
                    <a href="#" id="addNew" style="color:white;">Add Option</a>
                </button>                   
            </p>
            <br>
            <br>
            </div>

            <?php

            echo '<label for="ACTIVO">State</label>';
            echo $this->Form->select('ACTIVO',$ACTIVO);
            echo '<label for="REQUERIDO">Required</label>';
            echo $this->Form->select('REQUERIDO',$REQUERIDO);
        ?>
    </fieldset>
    </fieldset>
    <br>
    <a href=".."> <button type="button" class="botonCancelar"><?= __('Cancel') ?></button> </a>
    <?= $this->Form->button(__('Confirm'), ['class' => 'botonAceptar'], ['label' => 'ACCEPT']) ?>
    <?= $this->Form->end() ?>

<!-- For Hidding the functionality for "Adding Options Dinamically"-->
<script>
  document.getElementById("addOpt").style.display = "none";

  /**
   * If the question type is SELECT, add multiple options to it
   * @author Anyelo Mijael Lobo Cheloukhin
   *
   */
  function multipleSelect() {
    var x = document.getElementById("typeSelect").value;
    
    if(x == 5){
      document.getElementById("addOpt").style.display = "block";
    }
    else {
      //Remove Add Option Button
      document.getElementById("addOpt").style.display = "none";
    };
  }
</script>

<!-- For Adding Options Dinamically to a select-type Questions -->
<script type="text/javascript">
    $(function() {
        var addDiv = $('#addinput');
        var i = $('#addinput p').size() + 1;
        // var optNumber = 1;
        $('#addNew').live('click', function() {

            $('<p id="p_new" size="40" name="p_new_' + i +'" value=""> Insert Option <br> <input type="text" name="options[]"><a href="#" id="remNew"><input type="button" style="background-color:rgb(242, 102, 49);color:white;width:150px;height:40px;border-radius: 5px;" value="Remove"></a>').appendTo(addDiv);
            i++;
            optNumber++;
            return false;
        });

        $('#remNew').live('click', function() {
            if( i > 2 ) {
                $(this).parents('p').remove();
                i--;
                optNumber--;
            }
            return false;
        });
    });
</script>
<script  src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>      <!--   // Calling jQuery Library hosted on Google's CDN -->