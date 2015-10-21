<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 19.09.2015
 * Time: 01:09
 */?>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/templates/parts/_headerPart.php"; ?>

<body>
<div class="mobile-container">
    <div id="loadingbar"></div>
    <header class="no-menu">
        <div class="container">
            <div class="clearfix">
                <div class="col-md-6">
                    <a href="<?php echo BASEURL ?>">
                        <img class="brand" width="111" height="33" alt="Admin Logo" src="/images/Logo.png">
                    </a>
                </div>
                <div class="col-md-6">
                    <h2 class="application"><?php echo APPLICATION_TITLE ?></h2>
                </div>
            </div>
        </div>
    </header>


    <div id="tab-content-slider" class="top-margin">
        <div class="container">
            <div id="tab-content" class="clearfix">
<?php include $_SERVER['DOCUMENT_ROOT'] . "/templates/parts/messagetemplate.php"; ?>