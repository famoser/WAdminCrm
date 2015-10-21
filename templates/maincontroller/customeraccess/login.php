<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 19.09.2015
 * Time: 01:02
 */?>

<?php if (!IsAjaxRequest())
    include $_SERVER['DOCUMENT_ROOT'] . "/templates/parts/centerheader.php";
?>

<h1>Willkommen! Bitte geben Sie Ihr Passwort ein, um Zugriff zu erhalten</h1>
    <form id="login" class="no-ajax" action="/<?php echo $this->_["customer"]->Url ?>/" method="post">
        <?php echo GetInput(null, "password", "Passwort"); ?><br/>
        <?php echo GetSubmit("Einloggen") ?>
    </form>

<?php if (!IsAjaxRequest())
    include $_SERVER['DOCUMENT_ROOT'] . "/templates/parts/footer.php";
?>