<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 04.03.2016
 * Time: 16:41
 */

namespace famoser\phpFrame\Controllers;


use famoser\phpFrame\Core\Logging\LogHelper;
use famoser\phpFrame\Helpers\ControllerHelper;
use famoser\phpFrame\Services\GenericDatabaseService;
use famoser\phpFrame\Views\GenericCenterView;

abstract class InstallationControllerBase extends ControllerBase
{
    public function Display()
    {
        if (count($this->params) == 0) {
        } else if (count($this->params) > 0) {
            if ($this->params[0] == "setup") {
                if (ControllerHelper::getInstance()->isPostRequest($this->request, "setup")) {
                    
                }
                $view = new GenericCenterView("InstallationController", "setup", null, true);
                return $this->returnView($view);
            }
        }
        return parent::Display();
    }
}