<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 12.02.2016
 * Time: 14:35
 */

namespace famoser\phpFrame\Services;


class AuthenticationService extends ServiceBase
{
    public function getUser()
    {
        return unserialize($_SESSION["user"]);
    }

    public function setUser()
    {
        return serialize($_SESSION["user"]);
    }
}