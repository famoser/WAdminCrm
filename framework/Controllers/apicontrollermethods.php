<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 09.12.2015
 * Time: 21:31
 */

function IsReservedApiAddress($params, $request)
{
    if ($params[0] == "log") {
        return true;
    }
    return false;
}

function GetReservedApiAdressView($params, $request)
{

    return null;
}