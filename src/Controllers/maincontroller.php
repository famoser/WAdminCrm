<?php
namespace famoser\crm\Controllers;
use famoser\phpFrame\Controllers\ControllerBase;
use famoser\phpFrame\Helpers\PasswordHelper;
use famoser\phpFrame\Services\IoCService;

/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 23.05.2015
 * Time: 13:51
 */
class MainController extends ControllerBase
{
    public function Display()
    {
        $authService = IoCService::getInstance()->getAuthenticationService();
        $user = $authService->getUser();
        if (count($this->params[0]) < 2) {
            if ($user !== false) {
                $this->exitWithControllerRedirect("customers");
            }

            if (isset($this->request["email"]) && isset($this->request["password"])) {
                $res = TryLogin($this->request["email"], $this->request["password"]);
                if ($res !== false) {
                    SetActiveUser($res);
                    $personal = $res->GetPersonalIdentification();
                    if ($personal != "")
                        $personal = ", " . $personal;
                    DoLog('Willkommen' . $personal . '!');
                    header("Location: " . BASEURL . AFTER_LOGIN_PAGE . "/");
                    exit;
                } else {
                    DoLog("Login fehlgeschlagen", LOG_LEVEL_USER_ERROR);
                    $view = new GenericCrudView("Login", array(), "main", "Login");
                    $view->assign("save", array("email" => $this->request["email"]));
                }
            } else {
                $view = new GenericCrudView("Login", array(), "main", "Login");
                $view->assign("save", null);
            }
        } else if ($this->params[0] == "activateAccount" && isset($this->params[1])) {
            if (isset($this->request["Password"]) && isset($this->request["Password1"])) {
                if ($this->request["Password"] == $this->request["Password1"]) {
                    if (CheckPassword($this->request["Password"])) {
                        $admin = GetSingleByCondition("admins", array("Id" => $this->request["Id"], "AuthHash" => $this->request["AuthHash"]));
                        if ($admin !== false) {
                            $params = array();
                            $params["Id"] = $this->request["Id"];
                            $params["PasswordHash"] = $this->request["Password"];
                            $params["AuthHash"] = "";
                            if (AddOrUpdate("admins", $params)) {
                                DoLog("Das Passwort wurde erfolgreich geändert");
                                SetActiveUser(GetById("admins", $admin->Id));
                                header("Location: " . BASEURL . AFTER_LOGIN_PAGE . "/");
                                exit;
                            } else
                                DoLog("Das Passwort konnte nicht geändert werden", LOG_LEVEL_SYSTEM_ERROR);
                        } else {
                            DoLog("Dieser Authetifizierungslink ist nicht mehr gültig", LOG_LEVEL_USER_ERROR);
                        }
                    } else {
                        //log was done by CheckAdminPass
                    }
                } else {
                    DoLog("Die beiden Passwörter stimmen nicht überein", LOG_LEVEL_USER_ERROR);
                }
            }

            if (PasswordHelper::getInstance()->checkIfHashIsValid($this->params[1]))
                $view = new MessageView("Dieser Authentifizierungslink ist ungültig.", LOG_LEVEL_USER_ERROR);
            else {
                $res = GetSingleByCondition("admins", array("AuthHash" => $this->params[1]));
                if ($res !== false) {
                    $view = new GenericCrudView("addpass", array(), "main", "Login");
                    $view->assign("Admin", $res);
                } else {
                    $view = new MessageView("Dieser Authentifizierungslink ist ungültig. Wurde er schon benützt?", LOG_LEVEL_USER_ERROR);
                }
            }
        } else if ($this->params[0] == "forgotpass") {
            $view = new GenericCrudView("forgotpass", array(), "main", "Login");
            if (isset($this->request["email"])) {
                DoLog("Ihnen wird eine E-Mail gesendet, falls die eingebene E-Mail mit der eines Admin Accounts übereinstimmt.", LOG_LEVEL_INFO);
                ResetAdminPassByEmail($this->request["email"]);
            }
        } else if ($this->params[0] == "logout") {
            RemoveActiveUser();
            DoLog("Logout erfolgreich", LOG_LEVEL_INFO);
            header("Location: " . BASEURL);
            exit;
        } else {
            $cust = GetSingleByCondition("customers", array("Url" => $this->params[0]));
            if ($cust != null) {
                if (!IsLoggedInCustomer($cust->Url)) {
                    if (isset($this->request["password"])) {
                        if ($cust->UrlPassword == $this->request["password"])
                            LoginCustomer($cust->Url);
                        else
                            DoLog("Password ist leider ungültig");
                    }
                    $view = new GenericCrudView("Login", null, "main", "CustomerAccess");
                    $view->assign("customer", $cust);
                }

                if (IsLoggedInCustomer($cust->Url)) {
                    if (!isset($this->params[1])) {
                        $view = new GenericCrudView("projects", null, "main", "CustomerAccess");
                        $view->assign("customer", $cust);
                        $view->assign("projects", GetAllByCondition("projects", array("CustomerId" => $cust->Id)));
                    } else {
                        if (is_numeric($this->params[1])) {
                            $proj = GetSingleByCondition("projects", array("CustomerId" => $cust->Id, "Id" => $this->params[1]));
                            if ($proj !== false) {
                                $view = new GenericCrudView("project", null, "main", "CustomerAccess");
                                $proj = GetCompleteProject($this->params[1]);
                                $view->assign("customer", $cust);
                                $view->assign("project", $proj);
                            }
                        }
                    }
                }
            }
        }

        return parent::Display();
    }
}