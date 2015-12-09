<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 24.05.2015
 * Time: 10:10
 */

function GetActiveUser()
{
    if (isset($_SESSION["admin"]))
        return unserialize($_SESSION["admin"]);
    else
        return false;
}

function IsLoggedInCustomer($customer)
{
    if (isset($_SESSION["customer_".$customer]) && $_SESSION["customer_".$customer] == true)
        return true;
    return false;
}

function LoginCustomer($customer) {
    $_SESSION["customer_".$customer] = true;
}

function SetActiveUser($usr)
{
    $_SESSION["admin"] = serialize($usr);
}

function RemoveActiveUser()
{
    if (isset($_SESSION["admin"]))
        unset($_SESSION["admin"]);
}