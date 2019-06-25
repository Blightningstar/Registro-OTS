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
            <p class = "subtitulo">This is the application to the course made by the student.</p>
        </legend>

        <br>

        <?php
			$numPregunta = 1;
            foreach ($pregSol as $pregunta):        
                if($pregunta['ACTIVO']):
                    $id = $pregunta['NUMERO_PREGUNTA']."_".$pregunta['SOL_PREGUNTA']."_".$pregunta['TIPO'];

                    if($pregunta['REQUERIDO']):
                        echo "<b>".$numPregunta.") ".$pregunta['DESCRIPCION_ING']."<font color='red'> *</font></b>";
                    else:
                        echo "<b>".$numPregunta.") ".$pregunta['DESCRIPCION_ING']."</b>";
                    endif;

                    switch($pregunta['TIPO']): 
                        case 0: // Texto Corto
                            //if($pregunta['REQUERIDO']):
                            //  echo $this->Form->input($id, $textoCortoObligatorio);
                            //else:
                                echo $this->Form->input($id, $textoCortoOpcional);
                            //endif;
                        break; 

                        case 1: // Texto Medio
                            //if($pregunta['REQUERIDO']):
                            //    echo $this->Form->input($id, $textoMedioObligatorio); 
                            //else:
                                echo $this->Form->input($id, $textoMedioOpcional);
                            //endif;
                            ?><br><?php
                        break;

                        case 2: // Texto Largo
                            //if($pregunta['REQUERIDO']):
                            //    echo $this->Form->input($id, $textoLargoObligatorio); 
                            //else:
                                echo $this->Form->input($id, $textoLargoOpcional); 
                            //endif;
                            ?><br><?php
                        break;

                        case 3: // Número
                            //if($pregunta['REQUERIDO']):
                            //    echo $this->Form->input($id, $numberObligatorio);
                            //else:
                                echo $this->Form->input($id, $numberOpcional);
                            //endif;
                        break;

                        case 4: // Fecha
                            //if($pregunta['REQUERIDO']):
                            //    echo $this->Form->control($id, $fechaObligatoria);
                            //else:
                                echo $this->Form->control($id, $fechaOpcional);
                            //endif;
                        break;

                        case 5: // Select // Revisar porque parece que no lo hace obligatorio
                            //if($pregunta['REQUERIDO']):
                                echo $this->Form->select($id, array(1, 2, 3, 4, 5), $selectObligatorio);
                            //else:
                            //    echo $this->Form->select($id, array(1, 2, 3, 4, 5), $selectOpcional);
                            //endif;
                            ?><br><br><?php
                        break;

                        case 6: // Email
                            //if($pregunta['REQUERIDO']):
                            //    echo $this->Form->input($id, $emailObligatorio);
                            //else:
                                echo $this->Form->input($id, $emailOpcional);
                            //endif;
                        break;

                        case 7: // Teléfono
                            //if($pregunta['REQUERIDO']):
                            //    echo $this->Form->input($id, $telefonoObligatorio);
                            //else:
                                echo $this->Form->input($id, $telefonoOpcional);
                            //endif;
                        break;

                        case 8: // Archivo
                            //if($pregunta['REQUERIDO']):
                            //    echo $this->Form->input($pregunta['SOL_PREGUNTA']."_".$pregunta['TIPO'], $archivoObligatorio);
                            //else:
                                echo $this->Form->input($id, $archivoOpcional);
                            //endif;
                        break;
                    endswitch;
                    ++$numPregunta;
                endif;
            endforeach; ?>
    </fieldset>

    <a href="."> <button type="button" class="botonCancelar">Cancel</button> </a>
    <?= $this->Form->button(__('Confirm'), ['class' => 'botonAceptar']) ?>
    <br><br><br>
    <?= $this->Form->end() ?>
</div>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<?= $this->Html->script('js.solicitud.js'); ?>