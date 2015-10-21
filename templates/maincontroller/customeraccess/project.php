<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 13.09.2015
 * Time: 19:38
 */ ?>
<?php if (!IsAjaxRequest())
    include $_SERVER['DOCUMENT_ROOT'] . "/templates/parts/nomenuheader.php";

include $_SERVER['DOCUMENT_ROOT'] . "/templates/parts/project/details.php";

if (!IsAjaxRequest())
    include $_SERVER['DOCUMENT_ROOT'] . "/templates/parts/footer.php";
?>
