<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 09.02.2016
 * Time: 15:21
 */

namespace famoser\phpFrame\Services;


use famoser\phpFrame\Models\Services\ControllerModel;

class RuntimeService extends ServiceBase
{
    private $totalParams;
    private $routeParams;
    private $controllerParams;

    private $frameworkDirectory;

    /**
     * @param string $uri
     * @param ControllerModel $controller
     */
    public function setParams(string $uri, ControllerModel $controller)
    {
        $this->routeParams = remove_empty_entries(explode("/", $controller->getUrl()));

        $controllerParams = remove_empty_entries(explode("/", substr($uri, strlen($controller->getUrl()))));

        if (count($controllerParams) > 0) {
            $paramnumber = count($controllerParams) - 1;
            $lastparam = $controllerParams[$paramnumber];
            if (($index = strpos($lastparam, "?_=")) !== false)
                $controllerParams[$paramnumber] = substr($lastparam, 0, $index);
        }
        $this->controllerParams = $controllerParams;
        $this->totalParams = array_merge($this->routeParams, $this->controllerParams);
    }


    /**
     * @return array $params
     */
    public function getTotalParams()
    {
        return $this->totalParams;
    }


    /**
     * @return array $params
     */
    public function getRouteParams()
    {
        return $this->routeParams;
    }

    /**
     * @return string $params
     */
    public function getRouteUrl()
    {
        return implode("/", $this->getRouteParams());
    }


    /**
     * @return string $params
     */
    public function getTotalUrl()
    {
        return implode("/", $this->getTotalParams());
    }

    /**
     * @return mixed
     */
    public function getFrameworkDirectory()
    {
        return $this->frameworkDirectory;
    }

    /**
     * @param mixed $frameworkPath
     */
    public function setFrameworkDirectory($frameworkDirectory)
    {
        $this->frameworkDirectory = $frameworkDirectory;
    }

    /**
     * @return mixed
     */
    public function getControllerParams()
    {
        return $this->controllerParams;
    }
}