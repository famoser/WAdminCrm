<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 09.02.2016
 * Time: 11:03
 */

namespace famoser\phpFrame\Controllers;


use famoser\phpFrame\Framework\Views\MessageView;
use famoser\phpFrame\Framework\Views\ViewBase;

class ControllerBase
{
    protected $request;
    protected $params;
    protected $files;

    const FAILURE_ACCESS_DENIED = 10;
    const FAILURE_NOT_FOUND = 11;

    const REDIRECTION_TEMPORARY = 20;
    const REDIRECTION_PERMANENTLY = 21;
    const REDIRECTION_FOUND = 22;

    public function __construct($request, $params, $files)
    {
        $this->request = $request;
        $this->params = $params;
        $this->files = $files;
    }

    public function returnFailure($code)
    {
        if ($code >= 10 && $code < 20) {
            if ($code == ControllerBase::FAILURE_ACCESS_DENIED) {
                header("HTTP/1.1 401 Unauthorized");
                return new MessageView("Sie haben kein Zugriff auf diese Seite", LOG_LEVEL_USER_ERROR);
            }
            else if ($code == ControllerBase::FAILURE_NOT_FOUND) {
                header("HTTP/1.0 404 Not Found");
                return new MessageView("Seite nicht gefunden", LOG_LEVEL_USER_ERROR);
            }
        }
    }

    public function returnRedirection($code)
    {

    }

    public function returnServerError($code)
    {

    }

    public function returnView(ViewBase $view)
    {

    }

    public function getMenu()
    {
        $res = array();
        return $res;
    }
}