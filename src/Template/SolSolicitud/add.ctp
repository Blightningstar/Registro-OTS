<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SolSolicitud $solSolicitud
 */
?>

<div class="solSolicitud form large-9 medium-8 columns content">
    <fieldset>
        <legend class = "titulo"><?= __('Add Request') ?>
            <br>
            <p class = "subtitulo">Fill all the question of the form.</p>
        </legend>

        <br>

        <?php
            $numPregunta = 1;
            foreach ($pregSol as $pregunta):        
                if($pregunta['ACTIVO']):
                    echo "<b>".$numPregunta.") ".$pregunta['DESCRIPCION_ING']."</b>";
                    echo $respSol[$pregunta['NUMERO_PREGUNTA']];
                    ++$numPregunta;
                endif;
            endforeach; ?>
    </fieldset>
</div>