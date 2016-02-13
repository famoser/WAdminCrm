<?php

/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 23.05.2015
 * Time: 14:14
 */
namespace famoser\phpFrame\Views;

use famoser\phpFrame\Helpers\OutputHelper;
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
    private $pageAuthorUrl;

    private $applicationTitle;
    private $applicationUrl;

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

    /**
     * @param IconMenuItem[] $mainMenu
     * @param MenuItem[] $subMenu
     */
    public function setMenus($mainMenu, $subMenu)
    {
        $this->mainMenu = $mainMenu;
        $this->subMenu = $subMenu;
    }

    public function setDefaultValues($defaultTitle, $defaultDescription, $defaultAuthor, $defaultAuthorUrl)
    {
        if ($this->pageTitle == "")
            $this->pageTitle = $defaultTitle;
        if ($this->pageDescription == "")
            $this->pageDescription = $defaultDescription;
        if ($this->pageAuthor == "")
            $this->pageAuthor = $defaultAuthor;
        if ($this->pageAuthorUrl == "")
            $this->pageAuthorUrl = $defaultAuthorUrl;
    }

    public function setApplicationValues($applicationTitle, $baseUrl)
    {
        $this->applicationTitle = $applicationTitle;
        $this->applicationUrl = $baseUrl;
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
     * @return null
     */
    public function getPageTitle()
    {
        return $this->pageTitle;
    }

    /**
     * @param null $pageTitle
     */
    public function setPageTitle($pageTitle)
    {
        $this->pageTitle = $pageTitle;
    }

    /**
     * @return null
     */
    public function getPageDescription()
    {
        return $this->pageDescription;
    }

    /**
     * @param null $pageDescription
     */
    public function setPageDescription($pageDescription)
    {
        $this->pageDescription = $pageDescription;
    }

    /**
     * @return string
     */
    public function getPageAuthor()
    {
        return $this->pageAuthor;
    }

    /**
     * @param string $pageAuthor
     */
    public function setPageAuthor($pageAuthor)
    {
        $this->pageAuthor = $pageAuthor;
    }

    /**
     * @return MenuItem[]
     */
    public function getSubMenu()
    {
        return $this->subMenu;
    }

    /**
     * @return IconMenuItem[]
     */
    public function getMainMenu()
    {
        return $this->mainMenu;
    }

    /**
     * @return string[]
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @return string
     */
    public function getApplicationUrl()
    {
        return $this->applicationUrl;
    }

    /**
     * @param string $applicationUrl
     */
    public function setApplicationUrl($applicationUrl)
    {
        $this->applicationUrl = $applicationUrl;
    }

    /**
     * @return string
     */
    public function getPageAuthorUrl()
    {
        return $this->pageAuthorUrl;
    }

    /**
     * @param string $pageAuthorUrl
     */
    public function setPageAuthorUrl($pageAuthorUrl)
    {
        $this->pageAuthorUrl = $pageAuthorUrl;
    }

    /**
     * @return string
     */
    public function getApplicationTitle()
    {
        return $this->applicationTitle;
    }

    /**
     * @param string $applicationTitle
     */
    public function setApplicationTitle($applicationTitle)
    {
        $this->applicationTitle = $applicationTitle;
    }

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