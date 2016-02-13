<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 04.09.2015
 * Time: 10:50
 */
use famoser\phpFrame\Helpers\PartHelper;
use famoser\phpFrame\Helpers\RequestHelper; ?>
<?php if (RequestHelper::getInstance()->isAjaxRequest()) { ?>
    <div class="row no-gutters content clearfix">
    <?php
} else {
    echo PartHelper::getInstance()->getPart(PartHelper::PART_HEADER_CONTENT); ?>
    <div class="row content">
    <?php
}
echo PartHelper::getInstance()->getPart(PartHelper::PART_MESSAGES);
echo PartHelper::getInstance()->getPart(PartHelper::PART_LOADING_PLACEHOLDER);?>