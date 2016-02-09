<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 09.02.2016
 * Time: 17:49
 */

namespace Famoser\phpFrame\Models\Locale;


use Famoser\phpFrame\Core\Logging\Logger;
use famoser\phpFrame\Helpers\FileHelper;

class Language
{
    private $config;
    private $folder;

    private $resources = array();
    private $resourcesLoaded = false;
    private $formats = array();
    private $formatsLoaded = false;

    public function __construct($config, $folder)
    {
        $this->config = $config;
        $this->folder = $folder;
    }

    public function getResources()
    {
        if (!$this->resourcesLoaded) {
            foreach ($this->config["ResourceFiles"] as $resourceFile) {
                $configFilePath = $this->folder . DIRECTORY_SEPARATOR . $resourceFile;
                $resp = FileHelper::getInstance()->getJsonArray($configFilePath);
                if ($resp === false)
                    Logger::getInstance()->logFatal("could not find resource file at " . $configFilePath);
                else
                    $this->resources = array_merge($resp, $this->resources);
            }
            $this->resourcesLoaded = true;
        }
        return $this->resources;
    }

    public function getFormats()
    {
        if (!$this->formatsLoaded) {
            foreach ($this->config["FormatFiles"] as $formatFile) {
                $configFilePath = $this->folder . DIRECTORY_SEPARATOR . $formatFile;
                $resp = FileHelper::getInstance()->getJsonArray($configFilePath);
                if ($resp === false)
                    Logger::getInstance()->logFatal("could not find format file at " . $configFilePath);
                else
                    $this->formats = array_merge($resp, $this->formats);
            }
            $this->formatsLoaded = true;
        }
        return $this->formats;
    }
}