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
    protected $config;

    public function __construct($getConfig = false)
    {
        if ($getConfig) {
            $className = get_called_class();
            $this->config = SettingsService::getInstance()->getFrameworkConfig($className);
        }
    }
}