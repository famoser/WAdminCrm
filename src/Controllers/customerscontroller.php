<?php
namespace famoser\crm\Controllers;

use famoser\crm\Models\Database\CustomerModel;
use famoser\crm\Services\CustomerDatabaseService;
use famoser\phpFrame\Controllers\ControllerBase;
use famoser\phpFrame\Controllers\Generic1nController;
use famoser\phpFrame\Helpers\FormatHelper;
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
class CustomersController extends Generic1nController
{
    public function __construct($request, $params, $files)
    {
        $defaultObj = new CustomerModel();
        $defaultObj->setCustomerSinceDate(FormatHelper::getInstance()->dateFromString("today"));
        parent::__construct($request, $params, $files, $defaultObj, array(Generic1nController::CRUD_CREATE => Generic1nController::CRUD_UPDATE));

        $this->addMenuItem(new MenuItem("all", ""));
        $this->addMenuItem(new MenuItem("with active projects", "active"));
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