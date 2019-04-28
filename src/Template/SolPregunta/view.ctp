<?php
/**
 * @author Joel Chaves
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SolPreguntum $solPreguntum
 */
?>

<div class="solPregunta view large-9 medium-8 columns content">
   
<fieldset>
        <legend class = "titulo"><?= __('View Question') ?>
        <br></br>
        <p class = "subtitulo"> <?= __('Info about this question') ?></p>
    </legend>
    <br>



<!-- 
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
    </table> -->


<br>
        <div>
            <p class= "field"> <?= __('ID:') ?></p>
            <p class= "value"> <?= $solPreguntum["SOL_PREGUNTA"] ?></p>
            <hr class= "separator">
        </div>

        <div>
            <p class= "field"> <?= __('Description in spanish:') ?></p>
            <p class= "value"> <?= $solPreguntum["DESCRIPCION_ESP"] ?></p>
            <hr class= "separator">
        </div>

        <div>
            <p class= "field"> <?= __('Description in english:') ?></p>
            <p class= "value"> <?= $solPreguntum["DESCRIPCION_ING"] ?></p>
            <hr class= "separator">
        </div>

       <div>
            <p class= "field"> <?= __('Type:') ?></p>
            <?php if($solPreguntum->REQUERIDO ==0):?>
                <p class= "value"> <?= __('Text')  ?></p>
            <?php elseif($solPreguntum->REQUERIDO ==1):?>
               <p class= "value"> <?= __('Number') ?></p>
            <?php elseif($solPreguntum->REQUERIDO ==2):?>
               <p class= "value"> <?= __('Date') ?></p>
            <?php elseif($solPreguntum->REQUERIDO ==3):?>
               <p class= "value"> <?= __('Select') ?></p>
            <?php endif ?>
            <hr class= "separator">
        </div>

        <div>
            <p class= "field"> <?= __('Required:') ?></p>
            <?php if($solPreguntum->REQUERIDO ==0):?>
                <p class= "value"> <?= __('Not required')  ?></p>
               
            <?php else: ?>
               <p class= "value"> <?= __('Required') ?></p>
            <?php endif ?>
            <hr class= "separator">
        </div>

        <div>
            <p class= "field"> <?= __('State:') ?></p>
            <?php if($solPreguntum->REQUERIDO ==0):?>
                <p class= "value"> <?= __('Inactive')  ?></p>
              
            <?php else: ?>
               <p class= "value"> <?= __('Active') ?></p>
            <?php endif ?>
           <hr class= "separator">
        </div>

</fieldset>

<a href=".."> <button type="button" class="botonCancelar"><?= __('GO BACK') ?></button> </a>
</div>




