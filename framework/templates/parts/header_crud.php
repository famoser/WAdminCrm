<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 04.09.2015
 * Time: 10:50
 */ ?>
<?php if (!IsAjaxRequest()) {
    include $_SERVER['DOCUMENT_ROOT'] . "/framework/templates/parts/header_content.php"; ?>
    <div class="row content">
    <?php
} else { ?>
    <div class="row no-gutters content clearfix">
    <?php
}
include $_SERVER['DOCUMENT_ROOT'] . "/framework/templates/parts/messagetemplate.php";
include $_SERVER['DOCUMENT_ROOT'] . "/framework/templates/parts/loading-replacement.php" ?>