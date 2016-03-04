<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 13.02.2016
 * Time: 01:00
 */

namespace famoser\crm\Services;


use famoser\crm\Models\Database\UserModel;
use famoser\crm\Models\Database\PersonModel;
use famoser\phpFrame\Helpers\PasswordHelper;
use famoser\phpFrame\Models\Database\LoginDatabaseModel;
use famoser\phpFrame\Services\AuthenticationService;
use famoser\phpFrame\Services\DatabaseService;
use famoser\phpFrame\Services\EmailService;
use famoser\phpFrame\Services\GenericDatabaseService;
use famoser\phpFrame\Services\LocaleService;

class AdminAuthenticationService extends AuthenticationService
{

    /**
     * @param $username
     * @param $password
     * @return LoginDatabaseModel
     */
    public function authenticate($username, $password)
    {
        $admin = GenericDatabaseService::getInstance()->getSingle(new UserModel(), array("Username" => $username), true);
        if ($admin instanceof UserModel && PasswordHelper::getInstance()->validatePasswort($password, $admin->getPasswordHash())) {
            return $admin;
        }
        return false;
    }

    /**
     * @param $hash
     * @return LoginDatabaseModel
     */
    public function authenticateWithHash($hash)
    {
        $admin = GenericDatabaseService::getInstance()->getSingle(new UserModel(), array("AuthHash" => $hash), true);
        if ($admin instanceof UserModel) {
            return $admin;
        }
        return false;
    }

    /**
     * @param LoginDatabaseModel $model
     * @return bool
     */
    public function updateModel(LoginDatabaseModel $model)
    {
        // TODO: Implement updateModel() method.
    }

    public function resetPassword($username, $link)
    {
        $newHash = PasswordHelper::getInstance()->createUniqueHash();
        $admin = GenericDatabaseService::getInstance()->getSingle(new UserModel(), array("Username" => $username));
        if ($admin instanceof UserModel) {
            $admin->setAuthHash($newHash);
            GenericDatabaseService::getInstance()->update($admin, array("Id", "AuthHash"));
            return EmailService::getInstance()->sendEmailFromServer(
                LocaleService::getInstance()->translate("password reset"),
                LocaleService::getInstance()->translate("your password was reset. click following link to set a new one: "),
                LocaleService::getInstance()->translate("your password "));
        }
        return false;
    }
}