<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 01.07.2015
 * Time: 19:21
 */
use famoser\phpFrame\Helpers\PartHelper;
use famoser\phpFrame\Views\ViewBase;

if ($this instanceof ViewBase) { ?>

    <?php echo PartHelper::getInstance()->getPart(PartHelper::PART_HEAD); ?>

    <body>
<div class="mobile-container">
    <div id="loadingbar"></div>
    <header class="no-menu">
        <div class="container">
            <div class="clearfix">
                <div class="col-md-6">
                    <a href="/">
                        <img class="brand" width="111" height="33" alt="Admin Logo" src="/images/Logo.png">
                    </a>
                </div>
                <div class="col-md-6">
                    <h2 class="application"><?= $this->getApplicationName() ?></h2>
                </div>
            </div>
        </div>
    </header>

    <div class="center-content-wrapper">
    <div class="container">
    <?php echo PartHelper::getInstance()->getPart(PartHelper::PART_MESSAGES); ?>
    <div class="center-content content">


<?php } ?>