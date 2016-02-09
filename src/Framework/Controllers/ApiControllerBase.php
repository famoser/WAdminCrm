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
            $this->setView(new RawView("/Framework/Templates/_parts/message_template.php"));
        }

        return $this->evaluateView();
    }

}