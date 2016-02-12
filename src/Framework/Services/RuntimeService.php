<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 09.02.2016
 * Time: 15:21
 */

namespace famoser\phpFrame\Services;


class RuntimeService extends ServiceBase
{
    private $totalParams;
    private $routeParams;
    private $controllerParams;

    private $frameworkDirectory;

    /**
     * @param array $params
     */
    public function setTotalParams(array $params)
    {
        $this->totalParams = $params;
    }

    /**
     * @return array $params
     */
    public function getTotalParams()
    {
        return $this->totalParams;
    }

    /**
     * @param array $params
     */
    public function setRouteParams(array $params)
    {
        $this->routeParams = $params;
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

    /**
     * @param mixed $controllerParams
     */
    public function setControllerParams($controllerParams)
    {
        $this->controllerParams = $controllerParams;
    }
}