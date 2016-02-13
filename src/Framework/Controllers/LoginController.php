<?php
/**
 * Created by PhpStorm.
 * User: famoser
 * Date: 12.02.2016
 * Time: 14:33
 */

namespace famoser\phpFrame\Controllers;


use famoser\phpFrame\Core\Logging\LogHelper;
use famoser\phpFrame\Helpers\PasswordHelper;
use famoser\phpFrame\Helpers\ReflectionHelper;
use famoser\phpFrame\Models\Database\LoginModel;
use famoser\phpFrame\Services\AuthenticationService;
use famoser\phpFrame\Views\GenericCenterView;

class LoginController extends ControllerBase
{
    private $instance;
    private $authService;
    private $loggedInRedirect;

    public function __construct($request, $params, $files, LoginModel $implementation, AuthenticationService $authService, $loggedInRedirect)
    {
        parent::__construct($request, $params, $files);
        $this->instance = $implementation;
        $this->authService = $authService;
        $this->loggedInRedirect = $loggedInRedirect;
    }

    public function Display()
    {
        $user = $this->authService->getUser();
        if ($user !== false) {
            $this->exitWithControllerRedirect("customers");
        }

        if (count($this->params) == 0) {
            $view = new GenericCenterView("LoginController", "login", null, true);
            return $this->returnView($view);
        } else if (count($this->params) > 0) {
            if ($this->params[0] == "login" && isset($this->request["login"]) && $this->request["login"] == "true") {

                //fill object
                ReflectionHelper::getInstance()->writeFromPostArrayToObjectProperties($this->request, $this->instance);

                $admin = $this->authService->authenticate($this->instance->getUsername(), $this->instance->getPassword());
                if ($admin !== false) {
                    $this->authService->setUser($admin);
                    $this->exitWithControllerRedirect($this->loggedInRedirect);
                } else {
                    $view = new GenericCenterView("LoginController", "login", null, true);
                    $this->instance->setPassword("");
                    $view->assign("model", $this->instance);
                    LogHelper::getInstance()->logUserInfo("login was not successful");
                    return $this->returnView($view);
                }
            }
            else if ($this->params[0] == "logout") {
                $this->authService->setUser(null);
                $this->exitWithControllerRedirect("/");
            } else {
                return parent::Display();
            }
        } else if (count($this->params) > 1) {
            if ($this->params[0] == "activateAccount" && PasswordHelper::getInstance()->checkIfHashIsValid($this->params[1])) {
                $admin = $this->authService->authenticateWithHash($this->params[1]);

                if ($admin === false) {
                    LogHelper::getInstance()->logUserInfo("link not valid anymore");
                    $view = new GenericCenterView("LoginController", "login", null, true);
                    return $this->returnView($view);
                } else {
                    if (isset($this->request["activateAccount"]) && $this->request["activateAccount"] == true) {
                        ReflectionHelper::getInstance()->writeFromPostArrayToObjectProperties($this->request, $admin);

                        if ($this->canSetPassword($admin)) {
                            $admin->setPasswordHash(PasswordHelper::getInstance()->convertToPasswordHash($admin->getPassword()));
                            $admin->setAuthHash("");
                            $this->authService->updateModel($admin);
                        }
                    }

                    $view = new GenericCenterView("LoginController", "addpass", null, true);
                    return $this->returnView($view);
                }
            } else if ($this->params[0] == "forgotpass") {
                if (isset($this->request["forgotpass"]) && $this->request["forgotpass"] == "true") {
                    $this->authService->resetPassword($this->request["Username"]);
                    LogHelper::getInstance()->logUserInfo("you will be contacted by us on how to reset your password.");
                }

                $view = new GenericCenterView("LoginController", "forgotpass", null, true);
                return $this->returnView($view);
            }
        }
        return parent::Display();
    }

    protected function isParamReserved()
    {
        if (count($this->params) > 0) {
            if ($this->params[0] == "login") {
                return true;
            }
            if ($this->params[0] == "logout") {
                return true;
            }
        } else if (count($this->params) > 1) {
            if ($this->params[0] == "activateAccount" && PasswordHelper::getInstance()->checkIfHashIsValid($this->params[1])) {
                return true;
            } else if ($this->params[0] == "forgotpass") {
                return true;
            }
        }
        return false;
    }

    private function canSetPassword(LoginModel $model)
    {
        if ($model->getPassword() != $model->getConfirmPassword()) {
            LogHelper::getInstance()->logUserError("passwords do not match");
            return false;
        }

        $failure = PasswordHelper::getInstance()->checkPassword($model->getPassword());
        if ($failure !== true) {
            LogHelper::getInstance()->logUserError(PasswordHelper::getInstance()->evaluateFailure($failure));
            return false;
        }

        return true;
    }
}