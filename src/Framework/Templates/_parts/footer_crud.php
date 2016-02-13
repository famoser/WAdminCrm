<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 04.09.2015
 * Time: 10:51
 */
use famoser\phpFrame\Helpers\PartHelper;
use famoser\phpFrame\Helpers\RequestHelper; ?>
    </div>
<?php if (!RequestHelper::getInstance()->isAjaxRequest())
    echo PartHelper::getInstance()->getPart(PartHelper::PART_FOOTER_CONTENT);
?>