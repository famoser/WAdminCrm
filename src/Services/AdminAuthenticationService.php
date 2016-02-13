<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 13.02.2016
 * Time: 01:00
 */

namespace famoser\crm\Services;


use famoser\phpFrame\Models\Database\LoginModel;
use famoser\phpFrame\Services\AuthenticationService;

class AdminAuthenticationService extends AuthenticationService
{

    /**
     * @param $username
     * @param $password
     * @return LoginModel
     */
    public function authenticate($username, $password)
    {
        // TODO: Implement authenticate() method.
    }

    /**
     * @param $hash
     * @return LoginModel
     */
    public function authenticateWithHash($hash)
    {
        // TODO: Implement authenticateWithHash() method.
    }

    /**
     * @param LoginModel $model
     * @return bool
     */
    public function updateModel(LoginModel $model)
    {
        // TODO: Implement updateModel() method.
    }

    public function resetPassword($username)
    {
        // TODO: Implement resetPassword() method.
    }
}