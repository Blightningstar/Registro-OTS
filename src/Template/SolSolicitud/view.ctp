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
                    if($pregunta['TIPO'] != 8):
                        echo "<label>".$respSol[$pregunta['NUMERO_PREGUNTA']]."</label><br>";
                    else:
                        $path = $respSol[$pregunta['NUMERO_PREGUNTA']];
                        $path = str_replace("/","|",$path); // Allow send the file path by URL

                        // This is for download the respective file
                        echo $this->Html->link(
                            'Download File',
                            ['controller' => 'SolSolicitud', 'action' => 'downloadFile', $path],
                            ['confirm' => 'Are you sure you wish to download this file?']
                        );
                    endif;
                    echo "<hr class= 'separator'><br>";
                    ++$numPregunta;
                endif;
            endforeach; ?>
    </fieldset>
    <a href="/Registro-OTS/dashboard/studentDashboard"> <button type="button" class="botonCancelar"><?=__('Return')?></button> </a> 
</div>
