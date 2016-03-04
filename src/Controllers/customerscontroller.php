<?php
namespace famoser\crm\Controllers;

use famoser\crm\Models\Database\CustomerModel;
use famoser\crm\Models\Database\PersonModel;
use famoser\crm\Services\CustomerDatabaseService;
use famoser\phpFrame\Controllers\ControllerBase;
use famoser\phpFrame\Controllers\GenericControllerBase;
use famoser\phpFrame\Helpers\FormatHelper;
use famoser\phpFrame\Models\Controllers\ControllerConfigModel;
use famoser\phpFrame\Models\View\MenuItem;
use famoser\phpFrame\Services\DatabaseService;
use famoser\phpFrame\Services\GenericDatabaseService;
use famoser\phpFrame\Views\GenericView;

/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 23.05.2015
 * Time: 13:52
 */
class CustomersController extends GenericControllerBase
{
    public function __construct($request, $params, $files)
    {
        parent::__construct($request, $params, $files, "Customer", array(GenericControllerBase::CRUD_CREATE => GenericControllerBase::CRUD_UPDATE));

        $this->addMenuItem(new MenuItem("all", ""));
        $this->addMenuItem(new MenuItem("with active projects", "active"));

        $person = new ControllerConfigModel(new PersonModel(), "Person");
        $person->configureList(false);
        $this->addControllerConfig($person);

        $customer = new ControllerConfigModel(new CustomerModel(), "Customer");
        $customer->configureCrud(array("CustomerSinceDate" => FormatHelper::getInstance()->dateFromString("today")));
        $customer->configureList(null, null, null, "CustomerSinceDate DESC");
        $customer->addOneNChild($person);
        $this->addControllerConfig($customer);
    }

    /**
     * Methode zum Anzeigen des Contents.
     *
     * @return String Content der Applikation.
     */
    public function Display()
    {
        if (count($this->params) > 0) {
            if ($this->params[0] == "active") {
                $view = new GenericView("CustomersController");
                $view->assign("customers", CustomerDatabaseService::getInstance()->getActive());
                return $this->returnView($view);
            }
        }
        return parent::Display();
    }
}