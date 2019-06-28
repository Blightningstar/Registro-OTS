<?php
/**
 * @author Joel Chaves
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SegUsuario $solPreguntum
 */
?>

<div class="solPreguntum form large-9 medium-8 columns content">
    <?= $this->Form->create($solPreguntum) ?>
    <fieldset>
        <legend class = "titulo"><?= __('Add Question') ?>
        <br></br>
        <p class = "subtitulo">Adds a new question data.</p>
    </legend>

          <?php
              echo $this->Form->control('DESCRIPCION_ING', [
                  'label' => 'Description in english',
                  'pattern' => '^[A-Za-z0-9 _,.\/ ?¿]*$', 
                  'placeholder' => 'Only alphanumeric characters'
              ]);

          ?>
              <select id="typeSelect" onchange="multipleSelect()" name="tipo">
                <option value="Short Text">Short Text</option>
                <option value="Medium Text">MediumText</option>
                <option value="Large Text">Large Text</option>
                <option value="Number">Number</option>
                <option value="Date">Date</option>
                <option value="Select">Select</option>
                <option value="Large text">Large text</option>
                <option value="Upload document">Upload document</option>
                <option value="Email">Email</option>
                <option value="Phone number">Phone Number</option>
                <option value="URL">URL</option>
              </select>

              <script type="text/template" id="myHtml">
                   TEST
              </script>
        <div id="addinput">
        <p id="demo">
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
    <br>
    <a href="."> <button type="button" class="botonCancelar">Cancel</button> </a>
    <?= $this->Form->button(__('Confirm'), ['class' => 'botonAceptar'], ['label' => 'ACCEPT']) ?>
    <?= $this->Form->end() ?>
</div>

<!-- For Hidding the functionality for "Adding Options Dinamically"-->
<script>
  document.getElementById("demo").style.display = "none";

  /**
   * If the question type is SELECT, add multiple options to it
   * @author Anyelo Mijael Lobo Cheloukhin
   *
   */
  function multipleSelect() {
    var x = document.getElementById("typeSelect").value;
    
    if(x == "Select"){
      document.getElementById("demo").style.display = "block";
    }
    else {
      //Remove Add Option Button
      document.getElementById("demo").style.display = "none";
    };
  }
</script>

<!-- For Adding Options Dinamically to a select-type Questions -->
<script type="text/javascript">
    var optNumber = 1;
    $(function() {
        var addDiv = $('#addinput');
        var i = $('#addinput p').size() + 1;
        // var optNumber = 1;
        $('#addNew').live('click', function() {

            $('<p id="p_new" size="40" name="p_new_' + i +'" value=""> Insert Option  ' + optNumber + ' <br> <input type="text" name="options[]"><a href="#" id="remNew"><input type="button" style="background-color:rgb(242, 102, 49);color:white;width:150px;height:40px;border-radius: 5px;" value="Remove"></a>').appendTo(addDiv);
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