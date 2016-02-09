<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 09.09.2015
 * Time: 23:44
 */
namespace famoser\phpFrame\Views;

class RawView extends ViewBase
{
    protected $path = null;
    public function __construct($path)
    {
        parent::__construct();
        $this->path = $path;
    }

    public function loadTemplate()
    {
        return $this->loadFile($_SERVER['DOCUMENT_ROOT'] . $this->path);
    }
}