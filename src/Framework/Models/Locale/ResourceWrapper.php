<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 10.02.2016
 * Time: 00:36
 */

namespace Famoser\phpFrame\Models\Locale;


class ResourceWrapper
{
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function getKey($key)
    {
        if (!isset($key))
            return $key;
        return $this->config[$key];
    }
}