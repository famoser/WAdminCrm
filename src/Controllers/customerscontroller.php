<?php
namespace famoser\crm\Controllers;

use famoser\WAdminCrm\Framework\Controllers\ControllerBase;
use famoser\WAdminCrm\Framework\Controllers\GenericController;
use famoser\WAdminCrm\Framework\Views\GenericView;

/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 23.05.2015
 * Time: 13:52
 */
class CustomersController extends GenericController
{
    private $request = null;
    private $params = null;

    private $genericController = null;
    private $requestFiles;

    public function __construct($request, $files, $params)
    {
        parent::__construct($request, $files, $params);
        $this->genericController = new GenericController($this->request, $this->params, "customers", "customer", "Company, LastName, FirstName", array("add" => "edit"), null, $this->getMenu());
    }

    function getMenu()
    {
        $res = array();
        $menuItem = array();
        $menuItem["href"] = "";
        $menuItem["content"] = "all";
        $res[] = $menuItem;
        $menuItem2 = array();
        $menuItem2["href"] = "active";
        $menuItem2["content"] = "with active projects";
        $res[] = $menuItem2;
        return $res;
    }

    /**
     * Methode zum Anzeigen des Contents.
     *
     * @return String Content der Applikation.
     */
    public function Display()
    {
        if (count($this->params) == 0) {
            return $this->genericController->Display();
        } else {
            if ($this->params[0] == "add") {
                $pm = new CustomerModel();
                $pm->CustomerSinceDate = date(DATE_FORMAT_DATABASE, strtotime("today"));
                return $this->genericController->Display($pm);
            } else if ($this->params[0] == "edit" && isset($this->params[1]) && is_numeric($this->params[1])) {
                return $this->genericController->Display();
            } else if ($this->params[0] == "delete" && isset($this->params[1]) && is_numeric($this->params[1])) {
                return $this->genericController->Display();
            } else if ($this->params[0] == "active") {
                $view = new GenericView("customers", $this->getMenu());
                $view->assign("customers", GetActiveCustomers());
                $this->setView($view);
            }
        }

        return $this->evaluateView();
    }
}