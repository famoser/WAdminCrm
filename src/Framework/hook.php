<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 17.01.2016
 * Time: 23:29
 */


namespace famoser\phpSLWrapper\Framework\Hook;

use famoser\crm\Controllers\MainControllerBase;
use famoser\phpFrame\Base\AutoLoader;
use famoser\phpFrame\Controllers\FrameworkController;
use famoser\phpFrame\Core\Logging\LogHelper;
use famoser\phpFrame\Services\RuntimeService;
use famoser\phpFrame\Services\SettingsService;
use famoser\phpFrame\Views\MessageView;
use famoser\phpSLWrapper\Framework;

function hi_framework()
{
    include_once __DIR__ . DIRECTORY_SEPARATOR . "phplibrary.php";

    spl_autoload_register('spl_autoload_register');

    $nameSpaces = SettingsService::getInstance()->tryGetValueFor(array("Framework", "AutoLoader"));
    if (is_array($nameSpaces)) {
        foreach ($nameSpaces as $nameSpace => $folder) {
            AutoLoader::getInstance()->addNameSpace($nameSpace, $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . $folder);
        }
    }

    $val = SettingsService::getInstance()->tryGetValueFor(array("Framework", "DebugMode"));
    RuntimeService::getInstance()->setFrameworkDirectory(__DIR__);
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

    if (!AutoLoader::getInstance()->includeClass($class))
        bye_framework(false);
});

function bye_framework($successful = true)
{
    if ($successful)
        exit();

    $controller = new FrameworkController();
    $output = $controller->Display(FrameworkController::SHOW_MESSAGE);
    echo $output;
    exit();
}