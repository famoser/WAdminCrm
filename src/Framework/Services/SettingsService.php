<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 09.02.2016
 * Time: 12:31
 */

namespace famoser\phpFrame\Services;

use Famoser\phpFrame\Core\Logging\Logger;
use famoser\phpFrame\Helpers\FileHelper;

class SettingsService extends ServiceBase
{
    public function __construct()
    {
        parent::__construct();
        $configFilePath = $this->getSourceDir() . "/FrameworkAssets/configuration.json";
        $resp = FileHelper::getInstance()->getJsonArray($configFilePath);
        if ($resp === false)
            Logger::getInstance()->logFatal("could not find configuration file at " . $configFilePath);

        $this->config = $resp;
    }

    public function getSourceDir()
    {
        return dirname(dirname(__DIR__));
    }

    /**
     * @param $name string key from configuration file, or enum from SettingService::ENUM
     * @return array|string returns array for key, and string for SettingService::ENUM
     */
    public function getValueFor($name)
    {
        if (isset($this->config[$name]))
            return $this->config[$name];

        Logger::getInstance()->logError("Unknown Setting: " . $name);
        return "";
    }

    /**
     * @param string $className
     * @return array|string
     */
    public function getFrameworkConfig(string $className)
    {
        $namespace = "Famoser\\phpFrame\\";
        if (strpos($className, $namespace) === 0) {
            $name = str_replace($namespace, "", $className);
            if (isset($this->config["Framework"]["Services"][$name]))
                return $this->config["Framework"]["Services"][$name];
            Logger::getInstance()->logError("Unknown Setting for Framework Service: " . $name);
            return "";
        }
        Logger::getInstance()->logError("Invalid call. Please use the getValueFor method");
        return "";
    }
}