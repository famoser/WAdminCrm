<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 23.05.2015
 * Time: 10:00
 */

use famoser\phpFrame\Controllers\ControllerBase;
use famoser\phpFrame\Controllers\FrameworkController;
use famoser\phpFrame\Core\Logging\LogHelper;
use Famoser\phpFrame\Helpers\RequestHelper;
use Famoser\phpFrame\Models\Services\ControllerModel;
use famoser\phpFrame\Services\AuthenticationService;
use famoser\phpFrame\Services\DatabaseService;
use famoser\phpFrame\Services\GenericDatabaseService;
use famoser\phpFrame\Services\RouteService;
use famoser\phpFrame\Services\RuntimeService;
use function famoser\phpSLWrapper\Framework\Hook\bye_framework;
use function Famoser\phpSLWrapper\Framework\Hook\hi_framework;

session_start();

// $_GET und $_POST zusammenfasen
$request = array_merge($_GET, $_POST);
$files = $_FILES;

include_once $_SERVER['DOCUMENT_ROOT'] . "/src/Framework/hook.php";

try {
    try {
        hi_framework();

        $controllerModel = RouteService::getInstance()->getController($_SERVER['REQUEST_URI']);
        RuntimeService::getInstance()->setParams($_SERVER['REQUEST_URI'], $controllerModel);

        if ($controllerModel instanceof ControllerModel) {
            $controllerName = $controllerModel->getController();
            $controller = new $controllerName($request, RuntimeService::getInstance()->getControllerParams(), $files);
            $output = $controller->Display();
            echo $output;
            bye_framework();
        } else {
            $controller = new FrameworkController($request, RuntimeService::getInstance()->getControllerParams(), $files);
            $output = $controller->Display(FrameworkController::CONTROLLER_NOT_FOUND);
            echo $output;
            bye_framework();
        }
    } catch (Exception $ex) {
        LogHelper::getInstance()->logException($ex);
        $controller = new FrameworkController($request, RuntimeService::getInstance()->getControllerParams(), $files);
        $output = $controller->Display(FrameworkController::SHOW_MESSAGE);
        echo $output;
        bye_framework();
    }
} catch (Exception $ex) {
    //this will never ever happen!
    echo $ex;
    bye_framework();
}