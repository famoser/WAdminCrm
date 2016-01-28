<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 25.05.2015
 * Time: 15:03
 */
?>


<?php include $_SERVER['DOCUMENT_ROOT'] . "/Framework/Templates/Parts/header_crud.php"; ?>
    <form id="login" class="no-ajax" action="activateAccount/<?php echo $this->_["Admin"]->AuthHash; ?>" method="post">
        <p class="lead">Willkommen <b><?php echo $this->_["Admin"]->GetIdentification(); ?></b>, bitte legen Sie ihr Passwort fest</p>
        <input type="hidden" name="AuthHash" value="<?php echo $this->_["Admin"]->AuthHash; ?>">
        <input type="hidden" name="Id" value="<?php echo $this->_["Admin"]->Id; ?>">

        <?php echo GetInput(null,"passwort1", "Passwort", "password"); ?><br/>
        <?php echo GetInput(null,"passwort2", "Passwort bestätigen", "password"); ?><br/>

        <?php echo GetSubmit("Passwort setzten"); ?>
    </form>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/Framework/Templates/Parts/footer_content.php"; ?>