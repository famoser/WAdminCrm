<?php

/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 09.09.2015
 * Time: 23:43
 */
namespace famoser\WAdminCrm\Controllers;

use famoser\WAdminCrm\Framework\Controllers\ControllerBase;
use famoser\WAdminCrm\Framework\Views\RawView;

class ApiController extends ControllerBase
{
    public function Display()
    {
        if ($this->params[0] == "log") {
            if (isset($request) && isset($request["message"]) && isset($request["loglevel"]))
                DoLog($request["message"], $request["loglevel"]);
            $this->setView(new RawView("/Framework/Templates/Parts/message_template.php"));
        }

        return $this->evaluateView();
    }
}