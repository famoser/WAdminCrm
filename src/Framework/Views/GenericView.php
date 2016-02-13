<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 01.07.2015
 * Time: 18:57
 */

namespace famoser\phpFrame\Views;


use famoser\phpFrame\Helpers\PartHelper;

class GenericView extends ViewBase
{
    private $controller = null;
    private $view = null;
    private $folder = null;
    private $fromFramework = null;

    private $useCenter = false;

    public function __construct($controller, $view = "index", $folder = null, $fromFramework = false)
    {
        parent::__construct();
        $this->controller = $controller;
        $this->view = $view;
        $this->fromFramework = $fromFramework;
        if (strlen($folder) > 0)
            $this->folder = $folder . "/";
    }

    protected function useCenter(boolean $val)
    {
        $this->useCenter = $val;
    }

    public function loadTemplate()
    {
        $const = PartHelper::PART_HEADER_CONTENT;
        if ($this->useCenter)
            $const = PartHelper::PART_HEADER_CENTER;

        $content = PartHelper::getInstance()->getPart($const);
        if ($this->fromFramework) {
            $content .= $this->loadFile($_SERVER['DOCUMENT_ROOT'] . "/Framework/Templates/" . $this->controller . "/" . $this->folder . $this->view . ".php");
        } else {
            $content .= $this->loadFile($_SERVER['DOCUMENT_ROOT'] . "/Templates/" . $this->controller . "/" . $this->folder . $this->view . ".php");
        }

        $const = PartHelper::PART_FOOTER_CONTENT;
        if ($this->useCenter)
            $const = PartHelper::PART_FOOTER_CENTER;

        $content .= PartHelper::getInstance()->getPart($const);
        return $content;
    }
}