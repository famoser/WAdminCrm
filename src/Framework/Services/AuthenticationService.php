<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 12.02.2016
 * Time: 14:35
 */

namespace famoser\phpFrame\Services;


use famoser\phpFrame\Models\Database\LoginModel;

abstract class AuthenticationService extends ServiceBase
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
     * @param $username
     * @param $password
     * @return LoginModel
     */
    abstract public function authenticate($username, $password);

    /**
     * @param $hash
     * @return LoginModel
     */
    abstract public function authenticateWithHash($hash);

    /**
     * @param LoginModel $model
     * @return bool
     */
    abstract public function updateModel(LoginModel $model);

    abstract public function resetPassword($username);

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