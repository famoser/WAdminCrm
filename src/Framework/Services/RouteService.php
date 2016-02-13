<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 12.02.2016
 * Time: 19:31
 */

namespace famoser\phpFrame\Services;


use famoser\phpFrame\Controllers\ControllerBase;
use famoser\phpFrame\Models\Services\ControllerModel;
use famoser\phpFrame\Models\View\IconMenuItem;

class RouteService extends ServiceBase
{
    private $controllers = array();
    private $menus = array();

    public function __construct()
    {
        parent::__construct();

        $routes = SettingsService::getInstance()->getValueFor("Routes");
        foreach ($routes as $route) {
            $this->controllers[$route["Controller"]] = new ControllerModel($route["Url"], $route["Controller"]);
        }

        $menuInfo = $this->getConfig("Menus");
        foreach ($menuInfo as $item) {
            $this->getControllers()[$item["Controller"]]->setProperties($item["Name"], $item["Icon"]);
        }
    }

    /**
     * @return ControllerModel[]
     */
    public function getControllers()
    {
        return $this->controllers;
    }

    /**
     * @param string $url
     * @return ControllerModel|false
     */
    public function getController(string $url)
    {
        $favController = null;
        foreach ($this->getControllers() as $controller) {
            if (strlen($url) > $controller->getUrl() && str_starts_with($url, $controller->getUrl())) {
                if ($favController == null || strlen($favController->getUrl()) < strlen($controller->getUrl()))
                    $favController = $controller->getUrl();
            }
        }
        return $favController;
    }

    public function getMenu($key)
    {
        $menu = array();
        if (isset($this->menus[$key])) {
            foreach ($this->menus[$key]["Controllers"] as $item) {
                if (isset($this->getControllers()[$item]))
                    $menu[] = new IconMenuItem($this->getControllers()[$item]->getName(), $this->getControllers()[$item]->getUrl(), $this->getControllers()[$item]->getIcon());
            }
        }
        return $menu;
    }

    public function getAbsoluteLink($relative)
    {
        return RuntimeService::getInstance()->getRouteUrl() . "/" . $relative;
    }
}