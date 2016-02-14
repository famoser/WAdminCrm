<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 23.05.2015
 * Time: 10:00
 */

use famoser\phpFrame\Controllers\ControllerBase;
use famoser\phpFrame\Core\Logging\LogHelper;
use Famoser\phpFrame\Helpers\RequestHelper;
use Famoser\phpFrame\Models\Services\ControllerModel;
use famoser\phpFrame\Services\DatabaseService;
use famoser\phpFrame\Services\GenericDatabaseService;
use famoser\phpFrame\Services\RouteService;
use famoser\phpFrame\Services\RuntimeService;
use function famoser\phpSLWrapper\Framework\Hook\bye_framework;
use function Famoser\phpSLWrapper\Framework\Hook\hi_framework;

session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . "/src/Framework/hook.php";

try {
    hi_framework();

// $_GET und $_POST zusammenfasen
    $request = array_merge($_GET, $_POST);
    $files = $_FILES;


    $controllerModel = RouteService::getInstance()->getController($_SERVER['REQUEST_URI']);
    RuntimeService::getInstance()->setParams($_SERVER['REQUEST_URI'], $controllerModel);

    if ($controllerModel instanceof ControllerModel) {
        $controllerName = $controllerModel->getController();
        $controller = new $controllerName($request, RuntimeService::getInstance()->getControllerParams(), $files);
        $output = $controller->Display();
        echo $output;
        bye_framework(true);
    } else {
        header("404 Not found");
        echo "failure";
    }
} catch (Exception $ex) {
    LogHelper::getInstance()->logException($ex);
}
bye_framework(false);
?>
