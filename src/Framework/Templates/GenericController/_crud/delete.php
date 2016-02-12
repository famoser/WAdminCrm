<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 25.05.2015
 * Time: 10:08
 */
use famoser\phpFrame\Helpers\PartHelper;
use famoser\phpFrame\Interfaces\Models\IModel;
use famoser\phpFrame\Services\LocaleService;

$model = $this->_["model"];
if ($model instanceof IModel) {
    ?>

    <?= PartHelper::getInstance()->getFormStart(); ?>

    <p><?= LocaleService::getInstance()->translate("Are you sure you want to delete") ?>
        <b><?= $model->getIdentification() ?></b></p>

    <?= PartHelper::getInstance()->getSubmit("delete") ?>
    <?= PartHelper::getInstance()->getFormEnd(false); ?>

<?php } ?>