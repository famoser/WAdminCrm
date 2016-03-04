<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 17.01.2016
 * Time: 23:29
 */


namespace famoser\phpSLWrapper\Framework\Hook;

use famoser\crm\Controllers\MainControllerBase;
use famoser\phpFrame\Core\Logging\LogHelper;
use famoser\phpFrame\Services\RuntimeService;
use famoser\phpFrame\Services\SettingsService;
use famoser\phpFrame\Views\MessageView;
use famoser\phpSLWrapper\Framework;

function hi_framework()
{
    include_once __DIR__ . DIRECTORY_SEPARATOR . "phplibrary.php";

    spl_autoload_register('spl_autoload_register');

    $val = SettingsService::getInstance()->tryGetValueFor(array("Framework", "DebugMode"));
    RuntimeService::getInstance()->setFrameworkDirectory(__DIR__);
    RuntimeService::getInstance()->setTemplatesDirectory($_SERVER["DOCUMENT_ROOT"] . "/" . SettingsService::getInstance()->getValueFor(array("Framework", "TemplatesDirectory")));
    if ($val === true) {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
    } else {
        error_reporting(0);
        ini_set('display_errors', 0);
    }
}

spl_autoload_register(function ($class) {
    $frameworkNamespaces = array(
        "famoser\\phpFrame\\" => __DIR__
    );
    foreach ($frameworkNamespaces as $namespace => $folder) {
        if (strpos($class, $namespace) === 0) {
            $newPath = str_replace($namespace, "", $class);
            $newPath = str_replace("\\", "/", $newPath);
            $filePath = $folder . "/" . $newPath . ".php";
            if (!file_exists($filePath)) {
                LogHelper::getInstance()->logFatal("file for class name " . $class . " does not exist at " . $filePath);
                bye_framework(false);
            }
            include_once $filePath;
            return;
        }
    }

    $nameSpaces = SettingsService::getInstance()->tryGetValueFor(array("Framework", "AutoLoader"));
    if (is_array($nameSpaces)) {
        foreach ($nameSpaces as $namespace => $folder) {
            if (strpos($class, $namespace) === 0) {
                $newPath = str_replace($namespace, "", $class);
                $newPath = str_replace("\\", "/", $newPath);
                $filePath = $_SERVER["DOCUMENT_ROOT"] . "/" . $folder . "/" . $newPath . ".php";
                if (!file_exists($filePath)) {
                    LogHelper::getInstance()->logFatal("file for class name " . $class . " does not exist at " . $filePath);
                    bye_framework(false);
                }
                include_once $filePath;
                return;
            }
        }
    }
});

function bye_framework()
{
    exit();
}