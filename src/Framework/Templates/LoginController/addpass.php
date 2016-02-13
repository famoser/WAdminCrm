<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 25.05.2015
 * Time: 15:03
 */

use famoser\phpFrame\Helpers\PartHelper;
use famoser\phpFrame\Models\Database\LoginModel;
use famoser\phpFrame\Services\LocaleService;
use famoser\phpFrame\Views\ViewBase;

if ($this instanceof ViewBase) {
    $model = $this->retrieve("model");
    if ($model instanceof LoginModel) { ?>

        <?= PartHelper::getInstance()->getFormStart(); ?>

        <p><?= LocaleService::getInstance()->translate("Willkommen") ?> <?= $model->getPersonalIdentification() ?>
            , <?= LocaleService::getInstance()->translate("bitte legen Sie ihr
        Passwort fest") ?></p>

        <?= PartHelper::getInstance()->getHiddenInput("AuthHash", $model->getAuthHash()); ?>

        <?= PartHelper::getInstance()->getInput($model, "Password", "password", "password"); ?><br/>
        <?= PartHelper::getInstance()->getInput($model, "ConfirmPassword", "confirm password", "password"); ?><br/>

        <?= PartHelper::getInstance()->getFormEnd(); ?>

        <?php
    }
}
?>