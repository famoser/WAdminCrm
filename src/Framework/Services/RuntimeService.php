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
     * @return array $params
     */
    public function getRouteUrl()
    {
        return implode("/", $this->routeParams);
    }
}