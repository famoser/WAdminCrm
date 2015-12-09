<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 09.12.2015
 * Time: 18:18
 */

define("LOG_LEVEL_INFO", 1);
define("LOG_LEVEL_USER_ERROR", 2);
define("LOG_LEVEL_SYSTEM_ERROR", 3);

function DoLog($message, $loglevel = LOG_LEVEL_INFO)
{
    if (!isset($_SESSION["log"]))
        $_SESSION["log"] = array();

    $arr = array();
    $arr["message"] = $message;
    $arr["loglevel"] = $loglevel;
    if ($loglevel == LOG_LEVEL_INFO)
        $arr["class"] = "info";
    else if ($loglevel == LOG_LEVEL_USER_ERROR)
        $arr["class"] = "user-error";
    else if ($loglevel == LOG_LEVEL_SYSTEM_ERROR)
        $arr["class"] = "system-error";
    $_SESSION["log"][] = $arr;
}

function GetLog()
{
    if (isset($_SESSION["log"])) {
        $temp = $_SESSION["log"];
        unset($_SESSION["log"]);
        return $temp;
    }
    return null;
}