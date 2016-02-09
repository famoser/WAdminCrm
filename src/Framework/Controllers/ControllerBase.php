<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 09.02.2016
 * Time: 11:03
 */

namespace famoser\phpFrame\Controllers;


class ControllerBase
{
    protected $request;
    protected $params;
    protected $files;

    public function __construct($request, $files, $params)
    {
        $this->request = $request;
        $this->params = $params;
        $this->files = $files;
    }
}