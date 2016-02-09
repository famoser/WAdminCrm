<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 01.07.2015
 * Time: 18:57
 */

namespace famoser\phpFrame\Views;


class GenericView extends MenuView
{
    private $controller = null;
    private $view = null;
    private $folder = null;
    private $fromFramework = null;

    public function __construct($controller, $view = "index", $folder = null, $fromFramework = false)
    {
        parent::__construct();
        $this->controller = $controller;
        $this->view = $view;
        $this->fromFramework = $fromFramework;
        if (strlen($folder) > 0)
            $this->folder = $folder . "/";
    }

    public function loadTemplate()
    {
        if ($this->fromFramework){
            return $this->loadFile($_SERVER['DOCUMENT_ROOT'] . "/Framework/Templates/" . $this->controller . "/" . $this->folder . $this->view . ".php");
        } else {
            return $this->loadFile($_SERVER['DOCUMENT_ROOT'] . "/Templates/" . $this->controller . "/" . $this->folder . $this->view . ".php");
        }
    }
}