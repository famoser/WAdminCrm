<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 13.02.2016
 * Time: 01:03
 */

namespace famoser\crm\Services;


use famoser\phpFrame\Services\ServiceBase;

class CustomerAuthenticationService extends ServiceBase
{
    public function isLoggedIn($customer)
    {
        return isset($_SESSION["customer_".$customer]);
    }
}