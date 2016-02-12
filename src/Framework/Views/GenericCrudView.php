<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 01.07.2015
 * Time: 18:50
 */

namespace famoser\phpFrame\Views;

use Famoser\phpFrame\Core\Logging\LogHelper;
use famoser\phpFrame\Helpers\PartHelper;

class GenericCrudView extends ViewBase
{
    private $controller;
    private $mode;
    private $fromFramework;

    /**
     * GenericCrudView constructor.
     * @param string $controller
     * @param string $mode
     * @param bool $fromFramework
     */
    public function __construct(string $controller, string $mode, $fromFramework = false)
    {
        parent::__construct();
    }

    public function loadTemplate()
    {
        $content = PartHelper::getInstance()->getPart(PartHelper::PART_HEADER_CRUD);
        if ($this->fromFramework){
            $content .= $this->loadFile($_SERVER['DOCUMENT_ROOT'] . "/Framework/Templates/" . $this->controller . "/_crud/" . $this->mode . ".php");
        } else {
            $content .= $this->loadFile($_SERVER['DOCUMENT_ROOT'] . "/Templates/" . $this->controller . "/_crud/" .  $this->mode . ".php");
        }
        $content .= PartHelper::getInstance()->getPart(PartHelper::PART_FOOTER_CRUD);
        return $content;
    }
}