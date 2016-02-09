<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 08.12.2015
 * Time: 22:23
 */

function CanAccessGenericControllerParams($params)
{
    $user = GetActiveUser();
    if ($user == false)
        return false;

    $allowedParams = json_decode(CONTROLLERS);

    foreach ($allowedParams as $controller) {
        if ($controller->url == $params[0])
            return true;
    }

    return false;
}

function CanAccessAnyMenu()
{
    $user = GetActiveUser();
    if ($user == false)
        return false;

    return true;
}

function CanAccessGenericController($controller)
{
    $user = GetActiveUser();
    if ($user == false)
        return false;

    return true;
}

function CanAccessApiController($params)
{
    return true;
}

function CanAccessMainController($params)
{
    return true;
}

function CanAccessSpecificGenericController($controller)
{
    return true;
}

function AllAccessDenied($params)
{
    header("HTTP/1.1 401 Unauthorized");
    exit;
}