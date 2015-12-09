<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 09.12.2015
 * Time: 21:31
 */

function IsReservedApiAddress($params, $request)
{
    if ($params == "log") {
        return true;
    }
    return false;
}

function GetReservedApiAdressView($params, $request)
{
    if ($params == "log") {
        if (isset($request) && isset($request["message"]) && isset($request["loglevel"]))
            DoLog($request["message"], $request["loglevel"]);
        return new RawView("/templates/parts/messagetemplate.php");
    }
    return null;
}