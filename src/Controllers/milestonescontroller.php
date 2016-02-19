<?php
namespace famoser\crm\Controllers;

use famoser\crm\Models\Database\MilestoneModel;
use famoser\crm\Models\Database\ProcedureModel;
use famoser\crm\Models\Database\ProjectModel;
use famoser\phpFrame\Controllers\ControllerBase;
use famoser\phpFrame\Controllers\GenericController;
use famoser\phpFrame\Helpers\FormatHelper;
use famoser\phpFrame\Models\Controllers\ControllerConfigModel;
use famoser\phpFrame\Models\Database\BaseDatabaseModel;
use famoser\phpFrame\Models\View\MenuItem;
use famoser\phpFrame\Services\DatabaseService;
use famoser\phpFrame\Services\GenericDatabaseService;
use famoser\phpFrame\Views\GenericView;

/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 13.09.2015
 * Time: 16:03
 */
class MilestonesController extends GenericController
{
    /*
    /**
     * Konstruktor, erstellt den Controllers.
     *
     * @param Array $request Array aus $_GET & $_POST.
     *
    public function __construct($request, $requestFiles, $params)
    {
        $this->request = $request;
        $this->params = $params;
        $this->genericController = new GenericController($this->request, $this->params, "milestones", "milestone", "StartDate", array("add" => "edit"), null, $this->getMenu(), $this->getNRelations());
    }*/

    public function __construct($request, $params, $files)
    {
        parent::__construct($request,
            $params,
            $files,
            array(GenericController::CRUD_CREATE => GenericController::CRUD_UPDATE));

        $this->addMenuItem(new MenuItem("active", ""));
        $this->addMenuItem(new MenuItem("archived", "archived"));

        $milestone = new ControllerConfigModel(new MilestoneModel(), "Milestone");
        $milestone->configureList(null, null, null, "StartDate DESC");
        $milestone->configureCrud(array("StartDate" => FormatHelper::getInstance()->dateFromString("today")));

        $project = new ControllerConfigModel(new ProjectModel(), "Project");
        $milestone->addOneNParent($project);

        $procedure = new ControllerConfigModel(new ProcedureModel(), "Procedure");
        $milestone->addOneNChild($procedure);

        $this->addControllerConfig($milestone);
    }
}