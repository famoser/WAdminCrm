<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 04.09.2015
 * Time: 01:58
 */
use famoser\phpFrame\Core\Logging\LogHelper;
use famoser\phpFrame\Helpers\PartHelper;

$logs = LogHelper::getInstance()->getLogs();
if ($logs != null) {
    foreach ($logs as $log) { ?>
        <div class="col-md-12 content message <?= PartHelper::getInstance()->getLogClass($log); ?>">
            <div class="col-md-11">
                <?= PartHelper::getInstance()->getLogText($log); ?>
            </div>
            <div class="col-md-1">
                <button class="close removebutton" data-remove-parent="2">×</button>
            </div>
        </div>
    <?php
    }
} ?>