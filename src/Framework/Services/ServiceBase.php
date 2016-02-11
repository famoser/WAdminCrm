<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 29.01.2016
 * Time: 09:16
 */

namespace famoser\phpFrame\Services;


use Famoser\phpFrame\Core\Singleton\Singleton;

class ServiceBase extends Singleton
{
    private $config;

    public function __construct($getConfig = false)
    {
        if ($getConfig) {
            $className = get_called_class();
            $this->config = SettingsService::getInstance()->getFrameworkConfig($className);
        }
    }

    protected function getConfig($key)
    {
        if (isset($this->config[$key])) {
            return $this->config[$key];
        }
        return null;
    }
}