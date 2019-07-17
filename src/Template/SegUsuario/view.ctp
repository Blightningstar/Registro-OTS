<?php
/**
 * @author Esteban Rojas
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SegUsuario $segUsuario
 */
?>



<div class="segUsuario form large-9 medium-8 columns content">
    <?= $this->Form->create($segUsuario) ?>
    <fieldset>
        <legend class = "titulo"><?= __('View User') ?>
        <br></br>
        <p class = "subtitulo"> <?= __('View the user information') ?></p>
    </legend>

        <!--Mapping between role id and role anem-->
        <?php $rol = "";
            switch($segUsuario["SEG_ROL"])
            {
                case "3":
                    $rol = __("Student");
                    break;
                case "2":
                    $rol = __("Administrator");
                    break;
                case "1":
                    $rol = __("Superuser");
                    break;
            }?>
        <br>
        <div>
            <p class= "field"> <?= __('Name:') ?></p>
            <p class= "value"> <?= $segUsuario["NOMBRE"] ?></p>
            <hr class= "separator">
        </div>

        <div>
            <p class= "field"> <?= __('Lastname 1:') ?></p>
            <p class= "value"> <?= $segUsuario["APELLIDO_1"] ?></p>
            <hr class= "separator">
        </div>

        <div>
            <p class= "field"> <?= __('Lastname 2:') ?></p>
            <p class= "value"> <?= $segUsuario["APELLIDO_2"] ?></p>
            <hr class= "separator">
        </div>

        <div>
            <p class= "field"> <?= __('Username:') ?></p>
            <p class= "value"> <?= $segUsuario["NOMBRE_USUARIO"] ?></p>
            <hr class= "separator">
        </div>

        <div>
            <p class= "field"> <?= __('E-mail:') ?></p>
            <p class= "value"> <?= $segUsuario["CORREO"] ?></p>
            <hr class= "separator">
        </div>

        <div>
            <p class= "field"> <?= __('Telephone:') ?></p>
            <p class= "value"> <?= $segUsuario["NUMERO_TELEFONO"] ?></p>
            <hr class= "separator">
        </div>

        <div>
            <p class= "field"> <?= __('Country:') ?></p>
            <p class= "value"> <?= $segUsuario["NACIONALIDAD"] ?></p>
            <hr class= "separator">
        </div>

        <div>
            <p class= "field"> <?= __('Role:') ?></p>
            <p class= "value"> <?= $rol ?></p>
            <hr class= "separator">
        </div>

    </fieldset>
    <a href=".."> <button type="button" class="botonCancelar"><?= __('Go Back') ?></button> </a>
    <?= $this->Form->end() ?>
</div>
