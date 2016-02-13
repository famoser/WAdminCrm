<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 24.05.2015
 * Time: 10:15
 */
use famoser\phpFrame\Helpers\PartHelper;

?>

<?php $this->includeFile(PartHelper::getInstance()->getPart(PartHelper::PART_HEADER_CENTER)); ?>
<div class="clearfix">
    <?php $this->includeFile(PartHelper::getInstance()->getPart(PartHelper::PART_MESSAGES)); ?>
</div>
<?php $this->includeFile(PartHelper::getInstance()->getPart(PartHelper::PART_FOOTER_CENTER)); ?>
