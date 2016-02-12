<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 12.02.2016
 * Time: 16:32
 */
use famoser\phpFrame\Helpers\PartHelper;
use famoser\phpFrame\Models\Database\LoginModel;
use famoser\phpFrame\Services\LocaleService;
use famoser\phpFrame\Services\RouteService;

$model = $this->_["model"];
if ($model instanceof LoginModel) { ?>

    <?= PartHelper::getInstance()->getFormStart(); ?>
    
    <?= PartHelper::getInstance()->getInput($model, "Username", "Email", "email"); ?><br/>
    <?= PartHelper::getInstance()->getInput($model, "Password", "Password", "password"); ?><br/>

    <p><a href="<?= RouteService::getInstance()->getAbsoluteLink("forgotpass"); ?>"><?= LocaleService::getInstance()->translate("forgot password") ?></a></p>
    <?= PartHelper::getInstance()->getSubmit("Login") ?>

    <?= PartHelper::getInstance()->getFormEnd(false); ?>

    <?php
}
?>