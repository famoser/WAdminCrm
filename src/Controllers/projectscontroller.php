<?php
namespace famoser\crm\Controllers;

use famoser\crm\Controllers\Base\TimeTaskController;
use famoser\crm\Models\Database\Customer;
use famoser\crm\Models\Database\Milestone;
use famoser\crm\Models\Database\Procedure;
use famoser\crm\Models\Database\Project;
use famoser\phpFrame\Controllers\ControllerBase;
use famoser\phpFrame\Controllers\GenericController;
use famoser\phpFrame\Helpers\FormatHelper;
use famoser\phpFrame\Models\Controllers\ControllerConfigModel;
use famoser\phpFrame\Services\GenericDatabaseService;

/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 13.09.2015
 * Time: 14:35
 */
class ProjectsController extends TimeTaskController
{
    public function __construct($request, $params, $files)
    {
        parent::__construct($request, $params, $files, "Project", array(GenericController::CRUD_CREATE => GenericController::CRUD_READ));

        $project = new ControllerConfigModel(new Project(), "Project");
        $project->configureList(null, null, null, "StartDate DESC");
        $project->configureCrud(array("StartDate" => FormatHelper::getInstance()->dateFromString("today")));

        $customer = new ControllerConfigModel(new Customer(), "Customer");
        $project->addOneNParent($customer);

        $milestone = new ControllerConfigModel(new Milestone(), "Milestone");
        $project->addOneNChild($milestone);

        $this->addControllerConfig($project);
    }

    /**
     * Methode zum Anzeigen des Contents.
     *
     * @return String Content der Applikation.
     */
    public function Display()
    {
        return parent::Display();

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