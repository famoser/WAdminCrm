<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 29.01.2016
 * Time: 13:09
 */

namespace famoser\phpFrame\Controllers;


use famoser\phpFrame\Views\RawView;

class ApiControllerBase extends ControllerBase
{
    public function Display()
    {
        if ($this->params[0] == "log") {
            if (isset($request) && isset($request["message"]) && isset($request["loglevel"]))
                DoLog($request["message"], $request["loglevel"]);
            $view = new RawView("/Framework/Templates/_parts/messages.php");
            return $this->returnView($view);
        }
        return $this->returnFailure(ControllerBase::FAILURE_NOT_FOUND);
    }

}