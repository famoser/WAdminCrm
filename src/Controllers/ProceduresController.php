<?php
namespace famoser\crm\Controllers;

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
 * Time: 16:03
 */
class ProceduresController extends GenericController
{
    public function __construct($request, $params, $files)
    {
        parent::__construct($request, $params, $files, array(GenericController::CRUD_CREATE => GenericController::CRUD_READ));

        $procedure = new ControllerConfigModel(new Procedure(), "Procedure");
        $procedure->configureList(null, null, null, "StartDateTime");
        $procedure->configureCrud(array("EndDateTime" => FormatHelper::getInstance()->dateTimeFromString("now"),
            "StartDateTime" => FormatHelper::getInstance()->dateTimeFromString("now - 1 hour")));

        $milestone = new ControllerConfigModel(new Milestone(), "Milestone");
        $procedure->addOneNParent($milestone);

        $this->addControllerConfig($procedure);
    }
}