<?php

/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 23.05.2015
 * Time: 14:14
 */
namespace famoser\phpFrame\Views;

use Famoser\phpFrame\Helpers\OutputHelper;
use famoser\phpFrame\Models\View\IconMenuItem;
use famoser\phpFrame\Models\View\MenuItem;

abstract class ViewBase
{
    /**
     * Enthält die Variablen, die in das Template eingebettet
     * werden sollen.
     */
    private $collection = array();
    private $pageTitle;
    private $pageDescription;
    private $pageAuthor;

    private $subMenu;
    private $mainMenu;

    private $params;

    public function __construct($title = null, $description = null)
    {
        $this->params = unserialize(ACTIVE_PARAMS);

        if ($title != null)
            $this->pageTitle = $title;
        if ($description != null)
            $this->pageDescription = $description;
    }

    public function setPageTitle($title)
    {
        $this->pageTitle = $title;
    }

    public function setPageDescription($description)
    {
        $this->pageDescription = $description;
    }

    public function setPageAuthor($author)
    {
        $this->pageAuthor = $author;
    }

    /**
     * @param IconMenuItem[] $mainMenu
     * @param MenuItem[] $subMenu
     */
    public function setMenus($mainMenu, $subMenu)
    {
        $this->mainMenu= $mainMenu;
        $this->subMenu = $subMenu;
    }

    public function setDefaultValues($defaultTitle, $defaultDescription, $defaultAuthor)
    {
        if ($this->pageTitle == "")
            $this->pageTitle = $defaultTitle;
        if ($this->pageDescription == "")
            $this->pageDescription = $defaultDescription;
        if ($this->pageAuthor == "")
            $this->pageAuthor = $defaultAuthor;
    }

    /**
     * @param string[] $params
     */
    public function setParams(array $params)
    {
        $this->params = $params;
    }


    /**
     * Ordnet eine Variable einem bestimmten Schlüssel zu.
     *
     * @param String $key Schlüssel
     * @param String $value Variable
     */
    public function assign($key, $value)
    {
        $this->collection[$key] = $value;
    }

    /**
     * loads the template
     */
    protected function loadFile($file)
    {
        ob_start();

        include $file;
        $output = ob_get_contents();
        $output = OutputHelper::getInstance()->sanitizeOutput($output);
        ob_end_clean();

        return $output;
    }

    abstract public function loadTemplate();
}