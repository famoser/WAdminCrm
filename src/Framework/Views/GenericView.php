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
        $content = PartHelper::getInstance()->getPart(PartHelper::PART_HEADER_CONTENT);
        if ($this->fromFramework){
            $content .= $this->loadFile($_SERVER['DOCUMENT_ROOT'] . "/Framework/Templates/" . $this->controller . "/" . $this->folder . $this->view . ".php");
        } else {
            $content .= $this->loadFile($_SERVER['DOCUMENT_ROOT'] . "/Templates/" . $this->controller . "/" . $this->folder . $this->view . ".php");
        }
        $content .= PartHelper::getInstance()->getPart(PartHelper::PART_FOOTER_CONTENT);
        return $content;
    }
}