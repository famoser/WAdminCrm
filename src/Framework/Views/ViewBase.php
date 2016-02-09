<?php

/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 23.05.2015
 * Time: 14:14
 */
namespace famoser\phpFrame\Framework\Views;

class ViewBase
{
    /**
     * Enthält die Variablen, die in das Template eingebettet
     * werden sollen.
     */
    protected $_ = array();
    protected $page_title = DEFAULTTITLE;
    protected $page_description = DEFAULTDESCRIPTION;
    protected $subMenu = array();

    public function __construct($subMenu = null, $title = null, $description = null)
    {
        $this->params = unserialize(ACTIVE_PARAMS);

        if ($title != null)
            $this->page_title = $title;
        if ($description != null)
            $this->page_description = $description;
        if ($subMenu != null)
            $this->subMenu = $subMenu;
    }

    public function addSubMenuEntry($href, $content, $appendAtStart = false)
    {
        $arr = array();
        $arr["href"] = $href;
        $arr["content"] = $content;
        if ($appendAtStart) {
            $mainArr = array();
            $mainArr[] = $arr;
            array_push($mainArr, $this->subMenu);
        } else {
            $this->subMenu[] = $arr;
        }
    }

    /**
     * Ordnet eine Variable einem bestimmten Schl&uuml;ssel zu.
     *
     * @param String $key Schlüssel
     * @param String $value Variable
     */
    public function assign($key, $value)
    {
        $this->_[$key] = $value;
    }
}