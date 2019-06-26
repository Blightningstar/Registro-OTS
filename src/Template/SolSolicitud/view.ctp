<?php
/**
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

        <?php
            $numPregunta = 1;
            foreach ($pregSol as $pregunta):        
                if($pregunta['ACTIVO']):
                    echo "<label><b>".$numPregunta.") ".$pregunta['DESCRIPCION_ING']."</b></label><br>";
                    echo "<lable>".$respSol[$pregunta['NUMERO_PREGUNTA']]."</label><br><br>";
                    ++$numPregunta;
                endif;
            endforeach; ?>
    </fieldset>
</div>
