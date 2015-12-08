<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 23.05.2015
 * Time: 10:00
 */

session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . "/common/configuration.php";

foreach (glob($_SERVER['DOCUMENT_ROOT'] . "/framework/*", GLOB_ONLYDIR) as $folder) {
    foreach (glob($folder . "/*.php") as $filename) {
        include_once $filename;
    }
}

$includedFolders = unserialize(INCLUDED_FOLDERS);
$excludedFiles = unserialize(EXCLUDED_FILES);

foreach ($includedFolders as $folder) {
    foreach (glob($_SERVER['DOCUMENT_ROOT'] . "/" . $folder . "/*.php") as $filename) {
        if (in_array($filename, $excludedFiles) === false) {
            include_once $filename;
        }
    }
}

// $_GET und $_POST zusammenfasen
$request = array_merge($_GET, $_POST);
$requestFiles = $_FILES;

// params prepare
$params = formatParams($_SERVER['REQUEST_URI']);
define("ACTIVE_PARAMS", serialize($params));

if (CanAccessGenericController($params)) {
    $controllerName = strtoupper(substr($params[0], 0, 1)) . substr($params[0], 1) . "Controller";
    $params = RemoveFirstEntryInArray($params);

    // Controller erstellen
    $controller = new $controllerName($request, $requestFiles, $params);
    // Inhalt der Webanwendung ausgeben.
    echo $controller->Display();
} else {
    if ($params[0] == "api" && CanAccessApiController($params)) {
        $params = RemoveFirstEntryInArray($params);
        $controller = new ApiController($request, $requestFiles, $params);
        echo $controller->Display();
    } else if (CanAccessMainController($params)) {
        $controller = new MainController($request, $requestFiles, $params);
        // Inhalt der Webanwendung ausgeben.
        echo $controller->Display();
    } else {
        AllAccessDenied($params);
    }
}
?>
