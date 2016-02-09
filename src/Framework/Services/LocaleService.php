<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 09.02.2016
 * Time: 11:48
 */

namespace famoser\phpFrame\Services;


use Famoser\phpFrame\Core\Logging\Logger;
use Famoser\phpFrame\Models\Locale\Language;

class LocaleService extends ServiceBase
{
    private $languages;
    private $activeLang;
    private $activeLangShort;

    public function __construct()
    {
        parent::__construct();

        //parse language resources
        if (!isset($config["DefaultLanguage"])) {
            Logger::getInstance()->logWarning("Default language not configured, switching to first available language");
            $this->activeLangShort = $config["LanguageResources"][0]["Language"];
        } else
            $this->activeLangShort = $config["DefaultLanguage"];

        foreach ($config["LanguageResources"] as $languageResource) {
            $this->languages[$languageResource["Language"]] = new Language($languageResource, SettingsService::getInstance()->getSourceDir() . "/FrameworkAssets/Locale/");
        }

        if (isset($this->languages[$this->activeLangShort]))
            $this->activeLang = $this->languages[$this->activeLangShort];
        else {
            $this->activeLang = array_values($this->languages)[0];
            Logger::getInstance()->logError("Default language not found");
        }

        setlocale(LC_ALL, $this->activeLangShort . ".utf8");
    }

    /**
     * @return Language
     */
    private function getActiveLang()
    {
        return $this->activeLang;
    }

    public function getFormats()
    {
        return $this->getActiveLang()->getFormats();
    }

    public function getResources()
    {
        return $this->getActiveLang()->getResources();
    }
}