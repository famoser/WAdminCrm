<?php
namespace famoser\crm\Controllers;
use famoser\crm\Models\Database\CustomerModel;
use famoser\crm\Models\Database\ProcedureModel;
use famoser\crm\Models\Database\ProjectModel;
use famoser\phpFrame\Controllers\ControllerBase;
use famoser\phpFrame\Controllers\Generic1nController;
use famoser\phpFrame\Services\GenericDatabaseService;

/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 13.09.2015
 * Time: 14:35
 */
class ProjectsController extends Generic1nController
{
    public function __construct($request, $params, $files)
    {
        parent::__construct($request, $params, $files, new ProjectModel(), array(Generic1nController::CRUD_CREATE => Generic1nController::CRUD_READ));
    }

    /**
     * Methode zum Anzeigen des Contents.
     *
     * @return String Content der Applikation.
     */
    public function Display()
    {

        if (count($this->params) > 0) {
            if ($this->params[0] == "archived") {
                return parent::Display(array(), array("IsArchived" => true), "StartDate DESC");
            }
        }

        return parent::Display(array("IsArchived" => false), "StartDate DESC", new CustomerModel(), "Customer");

/*
        $view = $this->NotFound();
        if (count($this->params) == 0) {
            $view = new GenericView("projects", $this->getMenu());
            $customers = GetAllByCondition("customers", array(), true, "Company, LastName, FirstName");
            foreach ($customers as $customer) {
                $customer->Projects = GetAllByCondition("projects", array("CustomerId" => $customer->Id), false, "StartDate");
            }
            $view->assign("customers", $customers);
        } else if (count($this->params) > 0 && is_numeric($this->params[0])) {
            $proj = GetCompleteProject($this->params[0]);
            if ($proj != null) {
                $view = new GenericCrudView("details", null, "projects", null, $this->getMenu(), $proj->GetIdentification());
                $view->assign("project", $proj);
            } else {
                $view = new MessageView("project not found", LOG_LEVEL_USER_ERROR);
            }
        } else if (count($this->params) > 1 && $this->params[0] == "bycustomer" && is_numeric($this->params[1])) {
            $cust = GetById("customers", $this->params[1]);
            if ($cust != null) {
                $view = new GenericView("projects", $this->getMenu(), "projects of " . $cust->GetIdentification());
                $cust->Projects = GetAllByCondition("projects", array("CustomerId" => $cust->Id), false, "StartDate");
                $view->assign("customers", array($cust));
            } else {
                $view = new GenericView("projects", $this->getMenu());
                DoLog("customer not found", LOG_LEVEL_USER_ERROR);
                $view->assign("customers", array());
            }
        } else {
            if ($this->params[0] == "add") {
                $pm = new ProjectModel();
                $pm->StartDate = date(DATE_FORMAT_DATABASE, strtotime("today"));
                if (isset($this->params[1]) && is_numeric($this->params[1])) {
                    $cust = GetById("customers", $this->params[1]);
                    if ($cust != null) {
                        $lastProj = GetSingleByCondition("projects", array("CustomerId" => $this->params[1]), false, "StartDate DESC");
                        if ($lastProj != null)
                            $pm->PaymentPerHour = $lastProj->PaymentPerHour;
                        $pm->CustomerId = $cust->Id;
                    }
                }
                return $this->genericController->Display($pm);
            } else if ($this->params[0] == "edit" && isset($this->params[1]) && is_numeric($this->params[1])) {
                return $this->genericController->Display();
            } else if ($this->params[0] == "delete" && isset($this->params[1]) && is_numeric($this->params[1])) {
                return $this->genericController->Display();
            } else if ($this->params[0] == "active") {
                $view = new GenericView("customers", $this->getMenu());
                $view->assign("customers", GetActiveCustomers());
            }
        }

        return $view->loadTemplate();
*/
    }
}