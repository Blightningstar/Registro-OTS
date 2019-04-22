<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SolPreguntum $solPreguntum
 */
?>

<div class="solPregunta view large-9 medium-8 columns content">
   


<fieldset>
        <legend class = "titulo"><?= __(h($solPreguntum->SOL_PREGUNTA)) ?>
        <br></br>
        <p class = "subtitulo"> <?= __('Info about this question') ?></p>
    </legend>
    <br>




    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Description in spanish') ?></th>
            <td><?= h($solPreguntum->DESCRIPCION_ESP) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description in english') ?></th>
            <td><?= h($solPreguntum->DESCRIPCION_ING) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Required') ?></th>

            <?php if($solPreguntum->REQUERIDO ==0):?>

                <td><?= h('Required') ?></td>
            <?php else: ?>
                <td><?= h('Not required') ?></td>

            <?php endif ?>



        </tr>
        <tr>
            <th scope="row"><?= __('State') ?></th>
            <?php if($solPreguntum->ACTIVO ==0):?>

                <td><?= h('Active') ?></td>
            <?php else: ?>
                <td><?= h('Inactive') ?></td>

            <?php endif ?>
        </tr>
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            
            

            <?php if(($this->Number->format($solPreguntum->TIPO)) ==0):?>

                <td><?= h('Text') ?></td>

            <?php elseif(($this->Number->format($solPreguntum->TIPO)) ==1):?>

                <td><?= h('Number') ?></td>

            <?php elseif(($this->Number->format($solPreguntum->TIPO)) ==2):?>

                <td><?= h('Date') ?></td>

            <?php elseif(($this->Number->format($solPreguntum->TIPO)) ==3):?>

                <td><?= h('Select') ?></td>


            <?php endif ?>

        </tr>
    </table>
<a href=".."> <button type="button" class="botonCancelar"><?= __('Go back') ?></button> </a>
</div>




