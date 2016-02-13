<?php
namespace famoser\crm\Controllers;

use famoser\crm\Models\Database\AdminModel;
use famoser\crm\Models\Database\CustomerModel;
use famoser\crm\Services\AdminAuthenticationService;
use famoser\crm\Services\CustomerAuthenticationService;
use famoser\phpFrame\Controllers\ControllerBase;
use famoser\phpFrame\Controllers\LoginController;
use famoser\phpFrame\Core\Logging\LogHelper;
use famoser\phpFrame\Helpers\PasswordHelper;
use famoser\phpFrame\Helpers\ReflectionHelper;
use famoser\phpFrame\Models\Database\LoginModel;
use famoser\phpFrame\Services\AuthenticationService;
use famoser\phpFrame\Services\GenericDatabaseService;
use famoser\phpFrame\Services\IoCService;
use famoser\phpFrame\Views\GenericCenterView;
use famoser\phpFrame\Views\GenericView;

/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 23.05.2015
 * Time: 13:51
 */
class MainController extends LoginController
{
    public function __construct($request, $params, $files)
    {
        parent::__construct($request, $params, $files, new AdminModel(), AdminAuthenticationService::getInstance(), "customers");
    }

    public function Display()
    {
        if (!$this->isParamReserved()) {
            /*
            $cust = GenericDatabaseService::getInstance()->getAll(new CustomerModel(), array("Url" => $this->params[0]));
            if ($cust instanceof CustomerModel) {
                if (!CustomerAuthenticationService::getInstance()->isLoggedIn($cust->getUrl())) {
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
            */
        }
        return parent::Display();
    }
}