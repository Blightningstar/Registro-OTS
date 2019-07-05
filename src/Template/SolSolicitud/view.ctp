<?php
/**
 * @author Nathan González Herrera
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SolSolicitud $solSolicitud
 */
?>

<div class="solSolicitud form large-9 medium-8 columns content">
    <fieldset>
        <legend class = "titulo"><?= __('Review Application') ?>
            <br>
            <p class = "subtitulo">This is the application made by the student for the course.</p>
        </legend>

        <br>

        <!-- For each question in the application print it and her answer -->
        <?php
            $numPregunta = 1;
            foreach ($pregSol as $pregunta):        
                if($pregunta['ACTIVO']):
                    echo "<label><b>".$numPregunta.") ".$pregunta['DESCRIPCION_ING']."</b></label><br>";
                    echo "<label>".$respSol[$pregunta['NUMERO_PREGUNTA']]."</label><br>";
                    echo "<hr class= 'separator'><br>";
                    ++$numPregunta;
                endif;
            endforeach; ?>
    </fieldset>
    <a href="/Registro-OTS/dashboard/curso-view-dashboard/<?php echo $cursoId ?>"> <button type="button" class="botonCancelar"><?=__('Return')?></button> </a> 
</div>
