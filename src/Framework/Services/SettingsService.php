<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 09.02.2016
 * Time: 12:31
 */

namespace famoser\phpFrame\Services;

use Famoser\phpFrame\Core\Logging\Logger;

class SettingsService extends ServiceBase
{
    public function __construct()
    {
        $configFilePath = dirname(dirname(__DIR__)) . "/FrameworkAssets/configuration.json";
        if (file_exists($configFilePath)) {
            $configJson = file_get_contents($configFilePath);
            if (strlen($configJson) > 0) {
                $this->config = json_decode($configJson, true);
            } else {
                Logger::getInstance()->logFatal("configuration file is empty at " . $configFilePath);
            }
        } else {
            Logger::getInstance()->logFatal("could not find configuration file at " . $configFilePath);
        }
    }

    /**
     * @param $const string key from configuration file, or enum from SettingService::ENUM
     * @return array|string returns array for key, and string for SettingService::ENUM
     */
    public function getValueFor($const)
    {
        if (is_numeric($const)) {
            if ($const >= SettingsService::SOURCE_DIR && $const <= SettingsService::TEMP_DIR)
                return $this->getDirConst($const);
            else if ($const >= SettingsService::DIRECTORY_SEPARATOR && $const <= SettingsService::DIRECTORY_SEPARATOR)
                return $this->getPhpConst($const);
            else {
                Logger::getInstance()->logFatal("Unknown Setting: " . $const);
                return "";
            }
        } else {
            return $this->getConfiguration($const);
        }
    }

    /**
     * @param $const string key from configuration file, or enum from SettingService::ENUM
     * @return array|string returns array for key, and string for SettingService::ENUM
     */
    public function getFrameworkConfig(Singleton $instance)
    {

        if (is_numeric($const)) {
            if ($const >= SettingsService::SOURCE_DIR && $const <= SettingsService::TEMP_DIR)
                return $this->getDirConst($const);
            else if ($const >= SettingsService::DIRECTORY_SEPARATOR && $const <= SettingsService::DIRECTORY_SEPARATOR)
                return $this->getPhpConst($const);
            else {
                Logger::getInstance()->logFatal("Unknown Setting: " . $const);
                return "";
            }
        } else {
            return $this->getConfiguration($const);
        }
    }

    private function getConfiguration($key)
    {
        if (isset($this->config[$key]))
            return $this->config[$key];
        else {
            Logger::getInstance()->logFatal("Unknown Config key: " . $key);
            return array();
        }
    }
}