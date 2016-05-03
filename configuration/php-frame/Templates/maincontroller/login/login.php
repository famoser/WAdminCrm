<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 24.05.2015
 * Time: 10:15
 */
?>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/Framework/Templates/_parts/header_crud.php"; ?>

    <form id="login" class="no-ajax" action="/" method="post">

        <?php echo GetInput($this->_["save"],"email", "Email", "email", null, "Ihre E-Mail"); ?><br/>
        <?php echo GetInput($this->_["save"],"password", "Passwort", "password", null, "Ihr Passwort"); ?><br/>

        <p><a href="forgotpass">Passwort vergessen</a></p>
        <?php echo GetSubmit("Einloggen") ?>
    </form>


<?php include $_SERVER['DOCUMENT_ROOT'] . "/Framework/Templates/_parts/footer_content.php"; ?>