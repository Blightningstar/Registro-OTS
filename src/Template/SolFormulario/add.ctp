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
        <script type="text/javascript">
        $(function() {
            var addDiv = $('#addinput');
            var i = $('#addinput p').size() + 1;
            
            $('#addNew').live('click', function() {
                $('<select><option> -- Lista de Preguntas -- </option><?php foreach ($pregunta as $data){?><option><?php echo $data->DESCRIPCION_ESP; ?></option><?php } ?></select><br><br>').appendTo(addDiv);
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
                <button type="button" class="botonAgregar">
                    <a href="#" id="addNew" style="color:white;">Add</a>
                </button>
            </p>

            <br>

            <!-- Select Box with the available questions -->
            <select>
                <option> -- Lista de Preguntas -- </option>
                <?php 
                    foreach ($pregunta as $data){
                ?>
                <option><?php echo $data->DESCRIPCION_ESP; ?></option>
                <?php } ?>
            </select>

            <br>
            <br>
        </div>
    </div>
<!-- 
    <br>
    <br>
    <br>
    <br>
    <?php foreach ($pregunta as $data): ?>
        <ul>
            <li>ID:             <?= h($data->SOL_PREGUNTA) ?></li>

            <li>Descr in Spa:   <?= h($data->DESCRIPCION_ESP) ?></li>

            <li>Descr in Eng:   <?= h($data->DESCRIPCION_ING) ?></li>

            <li>Type:           <?= h($data->TIPO) ?></li>

        </ul>
    <?php endforeach; ?> -->
 
</div>

<script  src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>      <!--   // Calling jQuery Library hosted on Google's CDN -->
    
