<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 12.02.2016
 * Time: 14:35
 */

namespace famoser\phpFrame\Services;


use famoser\phpFrame\Models\Database\LoginModel;

class AuthenticationService extends ServiceBase
{
    public function __construct()
    {
        parent::__construct(false);
    }

    /**
     * @return LoginModel|bool
     */
    public function getUser()
    {
        if (isset($_SESSION["user"]))
            return unserialize($_SESSION["user"]);
        return false;
    }

    /**
     * @param LoginModel $user
     */
    public function setUser(LoginModel $user)
    {
        if ($user == null)
            unset($_SESSION["user"]);
        else
            $_SESSION["user"] = serialize($user);
    }
}