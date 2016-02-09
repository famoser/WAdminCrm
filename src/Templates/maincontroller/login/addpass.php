<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 25.05.2015
 * Time: 15:03
 */
?>


<?php include $_SERVER['DOCUMENT_ROOT'] . "/Framework/Templates/_parts/header_crud.php"; ?>
    <form id="login" class="no-ajax" action="activateAccount/<?php echo $this->_["Admin"]->AuthHash; ?>" method="post">
        <p class="lead">Willkommen <b><?php echo $this->_["Admin"]->GetIdentification(); ?></b>, bitte legen Sie ihr Passwort fest</p>

        <?= GetHiddenInput("AuthHash", $this->_["Admin"]->AuthHash) ?>
        <?= GetHiddenInput("Id", $this->_["Admin"]->Id) ?>

        <?= GetInput(null,"passwort1", "Passwort", "password"); ?><br/>
        <?= GetInput(null,"passwort2", "Passwort bestätigen", "password"); ?><br/>

        <?= GetSubmit("Passwort setzten"); ?>
    </form>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/Framework/Templates/_parts/footer_content.php"; ?>