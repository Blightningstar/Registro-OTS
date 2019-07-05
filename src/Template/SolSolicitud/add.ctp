<?php
/**
 * @author Nathan González Herrera
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SolSolicitud $solSolicitud
 */
?>

<div class="solSolicitud form large-9 medium-8 columns content">
    <?= $this->Form->create(false, ['enctype' => 'multipart/form-data']) ?>
    <fieldset>
        <legend class = "titulo"><?= __('Add Application') ?>
            <br>
            <p class = "subtitulo">Fill the questions of the application.</p>
        </legend>

        <br>

        <!-- The format of each possible question type -->
        <?php
            $textoCortoOpcional = ['type' => 'text', 'placeholder' => 'Please write your answer here.', 'label' => false, 'maxlength' => '50'];
            $textoCortoObligatorio = ['type' => 'text', 'placeholder' => 'Please write your answer here.', 'label' => false, 'required', 'maxlength' => '50'];
            $textoMedioOpcional = ['type' => 'textarea', 'placeholder' => 'Please write your answer here.', 'label' => false, 'escape' => false, 'rows' => '6', 'cols' => '10', 'maxlength' => '255', 'style' => 'border-radius: 12px;'];
            $textoMedioObligatorio = ['type' => 'textarea', 'placeholder' => 'Please write your answer here.', 'label' => false, 'required', 'escape' => false, 'rows' => '6', 'cols' => '10', 'maxlength' => '255', 'style' => 'border-radius: 12px;'];
            $textoLargoOpcional = ['type' => 'textarea', 'placeholder' => 'Please write your answer here.', 'label' => false, 'escape' => false, 'rows' => '6', 'cols' => '20', 'maxlength' => '4000', 'style' => 'border-radius: 12px;'];
            $textoLargoObligatorio = ['type' => 'textarea', 'placeholder' => 'Please write your answer here.', 'required', 'label' => false, 'escape' => false, 'rows' => '6', 'cols' => '20', 'maxlength' => '4000', 'style' => 'border-radius: 12px;'];
            $numberOpcional = ['type' => 'number', 'placeholder' => 'Please write the number.', 'label' => false];
            $numberObligatorio = ['type' => 'number', 'placeholder' => 'Please write the number.', 'required', 'label' => false];
            $fechaOpcional = ['class'=>'datepicker', 'placeholder' => 'Please select a date.', 'label' => false];
            $fechaObligatoria = ['class'=>'datepicker', 'placeholder' => 'Please select a date.', 'required', 'label' => false];
            $selectOpcional = ['label' => false, 'empty' => true, 'style' => 'border-radius: 12px;'];
            $selectObligatorio = ['required', 'label' => false, 'empty' => true, 'style' => 'border-radius: 12px;'];
            $emailOpcional = ['type' => 'email', 'placeholder' => 'Please write your answer here.', 'label' => false, 'pattern' => '[0-9A-Za-z^@]+@+[0-9A-Za-z^\.]+\.+[0-9A-Za-z^@]+', 'maxlength' => '50'];
            $emailObligatorio = ['type' => 'email', 'placeholder' => 'Please write your answer here.', 'required', 'label' => false, 'pattern' => '[0-9A-Za-z^@]+@+[0-9A-Za-z^\.]+\.+[0-9A-Za-z^@]+', 'maxlength' => '50'];
            $telefonoOpcional = ['type' => 'tel', 'placeholder' => 'Please write your answer here.', 'label' => false, 'pattern' => "[/+]?[0-9\-\s]+", 'maxlength' => '50'];
            $telefonoObligatorio = ['type' => 'tel', 'placeholder' => 'Please write your answer here.', 'required', 'label' => false, 'pattern' => "[/+]?[0-9\-\s]+", 'maxlength' => '50'];
            $archivoOpcional = ['type' => 'file', 'class' => 'form-control', 'label' => false];
            $archivoObligatorio = ['type' => 'file', 'class' => 'form-control', 'required', 'label' => false];

            $numPregunta = 1;
            // For each question, seek the respetive input according her type
            foreach ($pregSol as $pregunta):        
                if($pregunta['ACTIVO']):
                    $id = $pregunta['NUMERO_PREGUNTA']."_".$pregunta['SOL_PREGUNTA']."_".$pregunta['TIPO'];

                    // Print the question description
                    if($pregunta['REQUERIDO']):
                        echo "<b>".$numPregunta.") ".$pregunta['DESCRIPCION_ING']."<font color='red'> *</font></b>";
                    else:
                        echo "<b>".$numPregunta.") ".$pregunta['DESCRIPCION_ING']."</b>";
                    endif;

                    // According of her type and if her is require or not, print the right input
                    switch($pregunta['TIPO']): 
                        case 0: // Texto Corto
                            if($pregunta['REQUERIDO']):
                                echo $this->Form->control($id, $textoCortoObligatorio);
                            else:
                                echo $this->Form->control($id, $textoCortoOpcional);
                            endif;
                        break; 

                        case 1: // Texto Medio
                            if($pregunta['REQUERIDO']):
                                echo $this->Form->control($id, $textoMedioObligatorio); 
                            else:
                                echo $this->Form->control($id, $textoMedioOpcional);
                            endif;
                            ?><br><?php
                        break;

                        case 2: // Texto Largo
                            if($pregunta['REQUERIDO']):
                                echo $this->Form->control($id, $textoLargoObligatorio); 
                            else:
                                echo $this->Form->control($id, $textoLargoOpcional); 
                            endif;
                            ?><br><?php
                        break;

                        case 3: // Número
                            if($pregunta['REQUERIDO']):
                                echo $this->Form->control($id, $numberObligatorio);
                            else:
                                echo $this->Form->control($id, $numberOpcional);
                            endif;
                        break;

                        case 4: // Fecha
                            if($pregunta['REQUERIDO']):
                                echo $this->Form->control($id, $fechaObligatoria);
                            else:
                                echo $this->Form->control($id, $fechaOpcional);
                            endif;
                        break;

                        case 5: // Select
                            if($pregunta['REQUERIDO']):
                                echo $this->Form->select($id, $opcionPreg[$pregunta['SOL_PREGUNTA']], $selectObligatorio);
                            else:
                                echo $this->Form->select($id, $opcionPreg[$pregunta['SOL_PREGUNTA']], $selectOpcional);
                            endif;
                            ?><br><br><?php
                        break;

                        case 6: // Email
                            if($pregunta['REQUERIDO']):
                                echo $this->Form->control($id, $emailObligatorio);
                            else:
                                echo $this->Form->control($id, $emailOpcional);
                            endif;
                        break;

                        case 7: // Teléfono
                            if($pregunta['REQUERIDO']):
                                echo $this->Form->control($id, $telefonoObligatorio);
                            else:
                                echo $this->Form->control($id, $telefonoOpcional);
                            endif;
                        break;

                        case 8: // Archivo
                            if($pregunta['REQUERIDO']):
                                echo $this->Form->input($id, $archivoObligatorio);
                            else:
                                echo $this->Form->input($id, $archivoOpcional);
                            endif;
                        break;
                    endswitch;
                    ++$numPregunta;
                endif;
            endforeach; ?>
    </fieldset>

    <!-- Dont create the application -->
    <a href="."> <button type="button" class="botonCancelar">Cancel</button> </a>

    <!-- Create the application -->
    <?= $this->Form->button(__('Confirm'), ['class' => 'botonAceptar']) ?>
    <br><br><br>
    <?= $this->Form->end() ?>
</div>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<?= $this->Html->script('js.solicitud.js'); ?>