<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 09.02.2016
 * Time: 17:11
 */

namespace famoser\phpFrame\Services;


class IoCService extends ServiceBase
{
    private $instances = array();

    /**
     * @param $interface
     * @param $implementation
     */
    public function register($interface, $implementation)
    {
        $this->instances[$interface] = $implementation;
    }

    /**
     * @param $interface
     * @return $interface
     */
    public function resolve($interface)
    {
        return $this->instances[$interface];
    }
}