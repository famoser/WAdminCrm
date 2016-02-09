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
    private $params;
    public function setParams(array $params)
    {
        $this->params = $params;
    }

    /**
     * @return array $params
     */
    public function getParams()
    {
        return $this->params;
    }
}