<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 08.12.2015
 * Time: 22:23
 */

function CanAccessGenericController($params)
{
    $user = GetActiveUser();
    $allowedParams = unserialize(ENABLED_CONTROLLERS);
    return
        in_array($params[0], $allowedParams)
    && $user !== false;
}

function CanAccessApiController($params)
{
    return true;
}

function CanAccessMainController($params)
{
    return true;
}

function AllAccessDenied($params)
{
    header("HTTP/1.1 401 Unauthorized");
    exit;
}