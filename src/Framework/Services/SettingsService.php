<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 09.02.2016
 * Time: 12:31
 */

namespace famoser\phpFrame\Services;

use Famoser\phpFrame\Core\Logging\LogHelper;
use famoser\phpFrame\Helpers\FileHelper;

class SettingsService extends ServiceBase
{
    public function __construct()
    {
        parent::__construct();
        $configFilePath = $this->getSourceDir() . "/FrameworkAssets/configuration.json";
        $resp = FileHelper::getInstance()->getJsonArray($configFilePath);
        if ($resp === false)
            LogHelper::getInstance()->logFatal("could not find configuration file at " . $configFilePath);

        $this->setConfig($resp);
    }

    public function getSourceDir()
    {
        return dirname(dirname(__DIR__));
    }

    /**
     * Throws error if key not found
     * @param array|string $key string key from configuration file, or enum from SettingService::ENUM
     * @return array|string returns array for key, and string for SettingService::ENUM
     */
    public function getValueFor($key)
    {
        return $this->getConfig($key);
    }

    /**
     * Silently fails if key not found
     * @param array|string $key key from configuration file, or enum from SettingService::ENUM
     * @return array|string returns array for key, and string for SettingService::ENUM
     */
    public function tryGetValueFor($key)
    {
        return $this->tryGetConfig($key);
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
            return $this->getConfig(array("Framework","Services",$name));
        }
        LogHelper::getInstance()->logError("Invalid call. Please use the getValueFor method");
        return "";
    }
}